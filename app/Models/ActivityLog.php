<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'user_role',
        'action',
        'module',
        'description',
        'ip_address',
        'user_agent',
        'properties',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'properties' => 'array',
        ];
    }

    /**
     * Relasi ke model User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper untuk mencatat aktivitas secara langsung
     */
    public static function record(
        string $action,
        string $module,
        ?string $description = null,
        ?array $properties = null,
        ?User $user = null
    ): self {
        $actor = $user ?? Auth::user();

        $roleName = null;
        if ($actor) {
            if (method_exists($actor, 'getRoleNames')) {
                $roles = $actor->getRoleNames();
                $roleName = $roles->first() ?? $actor->role ?? null;
            } else {
                $roleName = $actor->role ?? null;
            }
        }

        return self::create([
            'user_id' => $actor?->id,
            'user_name' => $actor?->nama_lengkap ?? $actor?->name ?? 'Sistem/Tamu',
            'user_role' => $roleName,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => substr((string) Request::userAgent(), 0, 500),
            'properties' => $properties,
        ]);
    }
}
