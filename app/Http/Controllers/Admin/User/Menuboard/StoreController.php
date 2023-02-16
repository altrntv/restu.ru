<?php

namespace App\Http\Controllers\Admin\User\Menuboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menuboard\StoreRequest;
use App\Models\Menuboard;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        Menuboard::firstOrCreate($data);
        return redirect()->route('admin.user.menuboard.index');
    }
}
