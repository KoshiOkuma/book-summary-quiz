<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();

        return view('admin.index', compact('users'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.index')
        ->with([
            'message' => "ユーザーを削除しました",
            'status' => 'info'
        ]);
    }
}
