<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AmbassadorController extends Controller
{
    public function index():JsonResponse 
    {
        // $users = User::where('is_admin', 0)->get();
        // $users = User::whereIsAdmin(0)->get();
        $users = User::ambassadors()->get();
        return response()->json($users);
    }
}
