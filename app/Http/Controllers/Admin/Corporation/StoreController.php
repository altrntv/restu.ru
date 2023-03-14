<?php

namespace App\Http\Controllers\Admin\Corporation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Corporation\StoreRequest;
use App\Models\Corporation;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = sha1($data['password']);

        Corporation::firstOrCreate($data);

        return redirect()->route('admin.corporation.index');
    }
}
