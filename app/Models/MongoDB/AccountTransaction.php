<?php

namespace App\Models\MongoDB;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Moloquent;

class AccountTransaction extends Eloquent {
    protected $connection = "mongodb";
    protected $collection = null;
    public $timestamps = true;
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    protected $hidden = ['_id'];

    public function __construct()
    {
        $this->collection = "account_transaction";
    }

    public function getTable()
    {
        return parent::getTable();
    }

    public function setTable($accountNumber)
    {
        $this->collection = "account_transaction_" . $accountNumber;
    }

}