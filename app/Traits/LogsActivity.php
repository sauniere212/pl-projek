<?php

namespace App\Traits;

use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity(): void
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            static::$event(function ($model) use ($event) {
                if (!Auth::check()) {
                    return;
                }

                $actionMap = [
                    'created' => 'menambahkan',
                    'updated' => 'memperbarui',
                    'deleted' => 'menghapus',
                ];

                ActivityLogger::log(
                    $model->resolveActivityLogModule(),
                    $actionMap[$event],
                    $model->resolveActivityLogTitle(),
                    [
                        'event' => $event,
                        'model' => get_class($model),
                        'id' => $model->getKey(),
                    ],
                    $model->getKey()
                );
            });
        }
    }

    protected function resolveActivityLogModule(): string
    {
        if (method_exists($this, 'getActivityLogName')) {
            return $this->getActivityLogName();
        }

        if (property_exists($this, 'activityLogName')) {
            return $this->activityLogName;
        }

        return class_basename($this);
    }

    protected function resolveActivityLogTitle(): ?string
    {
        if (method_exists($this, 'getActivityLogTitle')) {
            return $this->getActivityLogTitle();
        }

        $candidates = property_exists($this, 'activityLogAttributes')
            ? (array) $this->activityLogAttributes
            : ['judul', 'nama', 'title', 'judul_album', 'kegiatan', 'deskripsi'];

        foreach ($candidates as $attribute) {
            if (!empty($this->{$attribute})) {
                return $this->{$attribute};
            }
        }

        return (string) $this->getKey();
    }
}

