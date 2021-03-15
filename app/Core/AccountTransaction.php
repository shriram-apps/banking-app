<?php

namespace App\Core;

interface AccountTransaction {
    public function fetchTransactionLogs($accountNumber, $where);
}