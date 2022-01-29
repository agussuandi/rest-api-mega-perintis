<?php

namespace App\Http\Controllers\API\Auth;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use AuthHelper;
use VerifyPerintis;

use App\User;
use App\Models\AccessKey\MAccessKey;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try
        {
            AuthHelper::perintisLogin($request);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try
        {
            $userData = VerifyPerintis::decodePerintisKey($request->header('perintis-key'));

            $mAccessKey = MAccessKey::where('key', $request->header('perintis-key'))
                ->where('created_by', $userData->userId)
            ->first();

            $mAccessKey->updated_by  = date('Y-m-d H:i:s');
            $mAccessKey->updated_by  = $userData->userId;
            $mAccessKey->flag_active = 0;
            $mAccessKey->save();

            return response()->json([
                'status'  => true,
                'message' => 'Berhasil Logout'
            ]);

        }
        catch (Exception $e)
        {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}