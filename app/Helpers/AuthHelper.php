<?php

namespace App\Helpers;

use DB;
use Hash;
use Crypt;
use Exception;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\AccessKey\MAccessKey;

class AuthHelper
{
    public static function perintisLogin($request)
    {
        try
        {
            $user = self::checkUser($request->username, $request->password);
            self::generatePerintisKey($user);
        }
        catch (Exception $e)
        {
            $response = [
                'status'  => false,
                'message' => 'Invalid perintisLogin'
            ];
            self::apiResponse($response);
        }
    }
 
    protected static function checkUser($username, $password)
    {
        try
        {
            $user = User::select('id', 'name', 'username', 'email', 'password', 'flag_active')
                ->where('username', $username)
            ->first();

            if (!$user)
            {
                $response = [
                    'status'  => false,
                    'message' => 'Username tidak ada'
                ];
                self::apiResponse($response);
            }
            else if ((int)$user->flag_active !== 1)
            {
                $response = [
                    'status'  => false,
                    'message' => 'User tidak aktif'
                ];
                self::apiResponse($response);
            }
            else if (!(Hash::check($password, $user->password)))
            {
                $response = [
                    'status'  => false,
                    'message' => 'Username atau Passoword salah'
                ];
                self::apiResponse($response);
            }
            else
            {
                $isAnyActiveKey = self::checkAnyPerintisKey($user->id);
                if ($isAnyActiveKey)
                {
                    self::apiResponse($isAnyActiveKey);
                }
            }
            return $user;
        }
        catch (Exception $e)
        {
            $response = [
                'status'  => false,
                'message' => 'Invalid checkUser'
            ];
            self::apiResponse($response);
        }
    }

    protected static function checkAnyPerintisKey($userId)
    {
        try
        {
            $dateTime = date('Y-m-d H:i:s');
            $mAccessKey = MAccessKey::where('created_by', $userId)
                ->where('flag_active', 1)
                ->whereRaw("expired_at > '{$dateTime}'")
                ->orderBy('id', 'DESC')
            ->first();

            return [
                'status'        => true,
                'token'         => $mAccessKey->key,
                'expiredAt'     => $mAccessKey->expired_at,
                'data'          => [
                    'name'     => $mAccessKey->user->name,
                    'email'    => $mAccessKey->user->email,
                    'username' => $mAccessKey->user->username
                ]
            ];
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    protected static function generatePerintisKey($user)
    {
        try
        {
            $userData = [
                'userId'   => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'username' => $user->username
            ];
            $decode  = base64_encode(json_encode($userData));
            $encrypt = Str::random(10);

            DB::beginTransaction();
            $mAccessKey              = new MAccessKey;
            $mAccessKey->key         = Crypt::encryptString("{$decode}.$encrypt");
            $mAccessKey->expired_at  = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') .' +1 day'));
            $mAccessKey->flag_active = 1;
            $mAccessKey->created_by  = $user->id;
            $mAccessKey->created_at  = date('Y-m-d H:i:s');
            $mAccessKey->save();
            DB::commit();

            $response = [
                'status'        => true,
                'token'         => $mAccessKey->key,
                'expiredAt'     => $mAccessKey->expired_at,
                'data'          => $userData
            ];
            
            self::apiResponse($response);

        }
        catch (Exception $e)
        {
            DB::rollBack();
            $response = [
                'status'    => false,
                'message'   => 'Invalid generatePerintisKey'
            ];
            self::apiResponse($response);
        }
    }

    protected static function apiResponse($response)
    {
        header('Content-Type: application/json');
        die(json_encode($response));
    }
}