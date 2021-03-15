<?php

namespace App\Services;

use App\Models\MySql\AccountType;
use App\Constants\HTTPConstant;
use Config;

class AccountTypeService
{
    private $accountType;

    public function __construct(AccountType $accountType) {
        $this->accountType = $accountType;
    }

    public function getDetails() {
        //$accountDetails = $this->accountType->get()->toArray();
        return Config('transaction.account_type');
    }
}
