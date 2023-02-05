<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;

class DeleteController extends Controller
{
    public function __invoke(Organization $organization): \Illuminate\Http\RedirectResponse
    {
        $organization->delete();
        return redirect()->route('admin.organization.index');
    }
}
