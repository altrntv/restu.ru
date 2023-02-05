<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Organization\StoreRequest;
use App\Models\Organization;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = sha1($data['password']);

        Organization::firstOrCreate($data);

        return redirect()->route('admin.organization.index');
    }
}
