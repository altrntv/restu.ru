<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $user->update($data);
        return back()
            ->with(['user' => $user])
            ->with('status', 'user-updated');
    }

    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user->update([
            'password' => $data['password'],
        ]);

        return back()
            ->with(['user' => $user])
            ->with('status', 'user-password-updated');
    }
}
