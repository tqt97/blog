<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class SocialiteAuthProviderException extends Exception
{
    // public function render(Request $request)
    // {
    //     if (app()->environment('production')) {
    //         return back();
    //     }
    //     return back()->with('error', $this->getMessage());
    // }
}
