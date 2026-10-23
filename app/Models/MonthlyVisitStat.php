<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyVisitStat extends Model
{
    protected $table = 'monthly_visit_stats';

    protected $fillable = [
        'page',
        'year',
        'month',
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
