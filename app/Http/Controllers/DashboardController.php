<?php

namespace App\Http\Controllers;

use App\Services\Loggers\AuditLogger;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\AuditLog;

class DashboardController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        $totalContacts = Contact::where('user_id', $userId)->count();

        $lastLog = AuditLog::where('user_id', $userId)
            ->latest()
            ->first();

        AuditLogger::log('accessed_dashboard', 'Acessou o painel principal');

        return view('dashboard.index', [
            'totalContacts' => $totalContacts,
            'lastLog' => optional($lastLog?->created_at)->diffForHumans() ?? '—',
        ]);
    }
}
