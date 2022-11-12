<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Companies extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =
        [
            'companies_id',
            'name',
            'responsibleUserId',
            'account_Id'
        ]; //перечесление всех полей в базе

    public function getAll($perPage = null)
    {
        $columns = ['companies_id','name',];

        $result = $this
            ->select($columns)
            ->paginate($perPage, $columns);


        return $result;
    }



}
