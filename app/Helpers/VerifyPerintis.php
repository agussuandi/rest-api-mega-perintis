<?php

namespace App\Helpers;

use Crypt; 
use Exception;

use App\Models\AccessKey\MAccessKey;

class VerifyPerintis
{
    public static function checkPerintisKey($perintisKey)
    {
        try
        {
            $accessKey = MAccessKey::select('id', 'key', 'expired_at')
                ->where('key', $perintisKey)
                ->where('flag_active', 1)
            ->first();

            if ($accessKey) return true;
            else return false;
        }
        catch (Exception $e)
        {
            $response = [
                'status'  => false,
                'message' => 'Invalid checkPerintisKey'
            ];
            self::apiResponse($response);
        }
    }

    public function decodePerintisKey($key)
    {
        try
        {
            $decodeKey = Crypt::decryptString($key);
            $arrDecodeKey = explode('.', $decodeKey);
            return json_decode(base64_decode($arrDecodeKey[0]));
        }
        catch (Exception $e)
        {
            $response = [
                'status'  => false,
                'message' => 'Invalid decodePerintisKey'
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