<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maincontroller extends Model
{
    use HasFactory;
    protected $table = 'controllers';
    protected $fillable = ["id", "controller", "publish", "menu_name", "is_menu", "order","parent"];
}
