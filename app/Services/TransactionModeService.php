<?php

namespace App\Services;

use App\Models\MySql\TransactionMode;
use App\Constants\HTTPConstant;
use Config;

class TransactionModeService
{
    private $transactionMode;

    public function __construct(TransactionMode $transactionMode) {
        $this->transactionMode = $transactionMode;
    }

    public function getDetails() {
        //$transactionModeDetails = $this->transactionMode->get()->toArray();
        return Config('transaction.transaction_mode');
    }
}
