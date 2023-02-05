<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;

class ShowController extends Controller
{
    public function __invoke(User $user): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $organizations = Organization::all();
        $roles = User::getRoles();
        return view("admin.user.show", compact('user', 'organizations', 'roles'));
    }
}
