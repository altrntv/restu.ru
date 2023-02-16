<?php

namespace App\Http\Controllers\Admin\User\Menuboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menuboard\UpdateRequest;
use App\Models\Menuboard;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Menuboard $menuboard): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $menuboard->update($data);
        return back()
            ->with(['menuboard' => $menuboard])
            ->with('status', 'menuboard-updated');
    }
}
