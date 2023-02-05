<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organization\UpdateRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Organization $organization): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $organization->update($data);
        return back()
            ->with(['organization' => $organization])
            ->with('status', 'organization-updated');
    }

    public function update(Request $request, Organization $organization): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $data['password'] = sha1($data['password']);
        $organization->update([
            'password' => $data['password'],
        ]);

        return back()
            ->with(['organization' => $organization])
            ->with('status', 'organization-password-updated');
    }
}
