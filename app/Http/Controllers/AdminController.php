<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class AdminController extends Controller
{
    protected function authorizeAdmin(Request $request): void
    {
        $user = $request->user();

        if (! $user || $user->role !== 'admin') {
            abort(403, 'Akses admin diperlukan.');
        }
    }

    protected function authorizePanelManager(Request $request): void
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, ['admin', 'pembina-ekstra'], true)) {
            abort(403, 'Akses panel pembina diperlukan.');
        }
    }
}
