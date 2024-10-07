<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function acceptTerms(Request $request)
{
    $user = auth()->user();
    $user->terms_accepted = true;
    $user->save();

    return response()->json(['message' => 'Terms accepted successfully']);
}
}
