<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $guards = User::where('role', 'guard')->get();

        return view('admin.guards.index', compact('guards'));
    }
}
