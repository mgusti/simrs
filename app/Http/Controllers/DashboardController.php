<?php

namespace App\Http\Controllers;

use App\Models\TempatTidur;
use App\Models\Pengaduan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Beds not updated today
        $unupdatedBeds = TempatTidur::whereDate('ts', '<', $today)
            ->orderBy('ts', 'asc')
            ->get();

        // Complaints today
        $complaintsToday = Pengaduan::whereDate('created_at', $today)
            ->count();

        // Total complaints
        $totalComplaints = Pengaduan::count();

        return view('pages.dashboard.ecommerce', [
            'title' => 'Dashboard',
            'unupdatedBeds' => $unupdatedBeds,
            'complaintsToday' => $complaintsToday,
            'totalComplaints' => $totalComplaints
        ]);
    }
}
