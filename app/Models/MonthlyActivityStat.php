<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyActivityStat extends Model
{
    public const CATEGORY_INTERNAL = 'internal';

    public const CATEGORY_PEMOHON = 'pemohon';

    protected $table = 'monthly_activity_stats';

    protected $fillable = [
        'year',
        'month',
        'category',
        'module',
        'action',
        'total',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'month' => 'integer',
            'total' => 'integer',
        ];
    }
}
