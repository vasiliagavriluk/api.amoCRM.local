<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pipeline extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =
        [
            'pipe_id',
            'name',
            'account_Id'
        ]; //перечесление всех полей в базе
}
