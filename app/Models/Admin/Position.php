<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';
    protected static $tbl = 'positions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'industry_id',
        'created_at',
        'updated_at',
    ];
}
