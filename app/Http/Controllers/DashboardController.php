<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập!');
        }

        $data = [
            'user'       => Auth::user(),
            'totalUsers' => User::count(),
            'newToday'   => User::whereDate('created_at', today())->count(),
            'newThisWeek'=> User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'allUsers'   => User::latest()->get(),
            'dbStatus'   => $this->checkDbConnection(),
            'dbName'     => DB::connection()->getDatabaseName(),
        ];

        return view('dashboard.index', $data);
    }

    private function checkDbConnection()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
