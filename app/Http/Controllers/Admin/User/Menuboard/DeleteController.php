<?php

namespace App\Http\Controllers\Admin\User\Menuboard;

use App\Http\Controllers\Controller;
use App\Models\Menuboard;

class DeleteController extends Controller
{
    public function __invoke(Menuboard $menuboard): \Illuminate\Http\RedirectResponse
    {
        $menuboard->delete();
        return redirect()->route('admin.user.menuboard.index');
    }
}
