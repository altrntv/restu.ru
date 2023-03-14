<?php

namespace App\Http\Controllers\Admin\Corporation;

use App\Http\Controllers\Controller;
use App\Models\Corporation;

class DeleteController extends Controller
{
    public function __invoke(Corporation $corporation): \Illuminate\Http\RedirectResponse
    {
        $corporation->delete();
        return redirect()->route('admin.corporation.index');
    }
}
