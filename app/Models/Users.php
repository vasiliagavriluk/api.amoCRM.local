<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =
        [
            'users_id',
            'name',
            'email',
            'lang'
        ]; //перечесление всех полей в базе
}
