<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statuses extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =
        [
            'statuses_id',
            'name',
            'color'
        ]; //перечесление всех полей в базе
}
