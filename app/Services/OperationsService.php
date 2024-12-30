<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class OperationsService
{
    public static function decryptId($encryptedValue) {
        try {
            $decryptedValue = Crypt::decrypt($encryptedValue);
        } catch (DecryptException $error) {
            return redirect()->back();
        }
        return $decryptedValue;
    }
}