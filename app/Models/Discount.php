<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'percentage',
        'startDate',
        'endDate',
        'type',
        'discountableId',
        'discountableType',
    ];

    public function discountable()
    {
        return $this->morphTo();
    }
}
