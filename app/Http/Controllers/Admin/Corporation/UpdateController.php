<?php

namespace App\Http\Controllers\Admin\Corporation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Corporation\UpdateRequest;
use App\Models\Corporation;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Corporation $corporation): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $corporation->update($data);
        return back()
            ->with(['corporation' => $corporation])
            ->with('status', 'corporation-updated');
    }

    public function update(Request $request, Corporation $corporation): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $data['password'] = sha1($data['password']);
        $corporation->update([
            'password' => $data['password'],
        ]);

        return back()
            ->with(['corporation' => $corporation])
            ->with('status', 'corporation-password-updated');
    }
}
