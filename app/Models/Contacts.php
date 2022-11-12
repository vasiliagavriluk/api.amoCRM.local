<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =
        [
            'contacts_id',
            'name',
            'firstName',
            'lastName',
            'accountId'
        ]; //перечесление всех полей в базе

}
