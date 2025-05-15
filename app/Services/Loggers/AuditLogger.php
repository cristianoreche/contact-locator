<?php
namespace App\Services\Loggers;

use App\Models\AuditLog;

class AuditLogger
{
    public static function log(string $action, ?string $description = null): void
    {
        $user = auth()->user();

        if (!$user) return;

        AuditLog::create([
            'user_id'    => $user->id,
            'action'     => $action,
            'description'=> $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
