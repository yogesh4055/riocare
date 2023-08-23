<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mixing extends Model
{
    use HasFactory;
    protected $table = 'mixing_table';
    protected $fillable = [
        'id',
        'main_batch_id',
		'qty_kg',
		'start_time',
		'end_time',
		'process_qty',
		'qty_ltr',
		'final_pH',
		'done_by',
		'date',
		'done_by_1',
		'checked_by',
		'checked_by_1',
        'created_at',
        'updated_at',
    ];
}
