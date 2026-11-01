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
        ?User $user = null,
        ?string $actorName = null,
        ?string $actorRole = null
    ): self {
        $actor = $user ?? Auth::user();

        $roleName = $actorRole;
        $userName = $actorName;
        $userId = $actor?->id;

        if ($actor) {
            if (! $roleName) {
                if (method_exists($actor, 'getRoleNames')) {
                    $roles = $actor->getRoleNames();
                    $roleName = $roles->first() ?? $actor->role ?? null;
                } else {
                    $roleName = $actor->role ?? null;
                }
            }
            if (! $userName) {
                $userName = $actor->nama_lengkap ?? $actor->name ?? null;
            }
        } elseif (session()->has('pemohon_id')) {
            $roleName = $roleName ?: 'Pemohon';
            $userName = $userName ?: (session('pemohon_nama') ?: 'Pemohon');
            if ($properties === null) {
                $properties = ['pemohon_id' => session('pemohon_id')];
            } elseif (! isset($properties['pemohon_id'])) {
                $properties['pemohon_id'] = session('pemohon_id');
            }
        }

        return self::create([
            'user_id' => $userId,
            'user_name' => $userName ?? 'Sistem/Tamu',
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
