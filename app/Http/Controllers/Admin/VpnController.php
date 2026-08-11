<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class VpnController extends Controller
{
    public function index()
    {
        return view('admin.vpn.index');
    }
}