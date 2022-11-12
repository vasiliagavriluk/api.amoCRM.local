<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leads extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable =
        [
            'leads_id',
            'name',
            'price',
            'responsibleUser_Id',
            'group_Id',
            'account_Id',
            'pipeline_Id',
            'status_Id',
            'company_id'
        ]; //перечесление всех полей в базе

    public function statuses()
    {
        return $this->hasMany(Statuses::class, 'statuses_id', 'status_Id');
    }

    public function companies()
    {
        return $this->hasMany(Companies::class,'companies_id', 'company_id');
    }

    public function users()
    {
        return $this->hasMany(Users::class,'users_id', 'responsibleUser_Id');
    }



    public function getAllLeads($perPage = null)
    {
        $columns = ['leads_id','name','price','responsibleUser_Id','status_Id','company_id'];

        $result = $this
            ->select($columns)
            ->with(
                [
                    'statuses:statuses_id,name',
                    'companies:companies_id,name',
                    'users:users_id,name',

                ])
            ->paginate($perPage, $columns);


        return $result;
    }
}
