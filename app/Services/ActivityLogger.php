<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(
        string $module,
        string $action,
        ?string $targetName = null,
        array $meta = [],
        ?int $targetId = null
    ): void {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();
        $userName = $user->name ?? $user->username ?? $user->email ?? 'Administrator';

        ActivityLog::create([
            'user_id' => $user->id,
            'user_name' => $userName,
            'module' => $module,
            'action' => $action,
            'target_id' => $targetId,
            'target_name' => $targetName,
            'description' => self::composeDescription($userName, $action, $module, $targetName),
            'meta' => empty($meta) ? null : $meta,
        ]);
    }

    protected static function composeDescription(string $user, string $action, string $module, ?string $target): string
    {
        $base = trim(sprintf('%s %s %s', $user, $action, strtolower($module)));

        if ($target) {
            return sprintf('%s "%s"', $base, $target);
        }

        return $base;
    }
}

