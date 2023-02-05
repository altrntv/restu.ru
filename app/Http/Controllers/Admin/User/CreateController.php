<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;

class CreateController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $organizations = Organization::all();
        $roles = User::getRoles();
        return view("admin.user.create", compact('organizations', 'roles'));
    }
}
