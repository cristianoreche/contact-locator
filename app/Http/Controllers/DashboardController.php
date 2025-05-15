<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\AuditLog;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); 
    }

    public function index()
    {
        $userId = auth()->id();

        $totalContacts = Contact::where('user_id', $userId)->count();

        $lastLog = AuditLog::where('user_id', $userId)
            ->latest()
            ->first();

        return view('dashboard.index', [
            'totalContacts' => $totalContacts,
            'lastLog' => optional($lastLog?->created_at)->diffForHumans() ?? '—',
        ]);
    }
}
