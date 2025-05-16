<?php


namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class LogWebController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::where('user_id', auth()->id());

        // Filtros opcionais
        if ($request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        if ($request->filled('ip_address')) {
            $query->where('ip_address', $request->input('ip_address'));
        }

        $logs = $query->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Listas únicas para os filtros <select>
        $actions = AuditLog::where('user_id', auth()->id())
            ->select('action')->distinct()->pluck('action');

        $ips = AuditLog::where('user_id', auth()->id())
            ->select('ip_address')->distinct()->pluck('ip_address');

        return view('logs.index', compact('logs', 'actions', 'ips'));
    }

    public function exportCsv(Request $request): StreamedResponse
    {
        $logs = AuditLog::where('user_id', auth()->id())
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('action', 'like', "%{$request->search}%")
                        ->orWhere('description', 'like', "%{$request->search}%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="logs.csv"',
        ];

        $callback = function () use ($logs) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Ação', 'Descrição', 'IP', 'User Agent', 'Data']);

            foreach ($logs as $log) {
                fputcsv($output, [
                    $log->action,
                    $log->description,
                    $log->ip,
                    $log->user_agent,
                    $log->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $logs = AuditLog::where('user_id', auth()->id())
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('action', 'like', "%{$request->search}%")
                        ->orWhere('description', 'like', "%{$request->search}%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        $pdf = Pdf::loadView('logs.pdf', ['logs' => $logs])
            ->setPaper('a4', 'portrait');

        return $pdf->download('logs.pdf');
    }
}
