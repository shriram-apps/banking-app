<?php
namespace App\Models\MySql;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = true;
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    protected $fillable = [
        'customer_id', 'account_id', 'account_type'
    ];

}
