<?php

namespace App\Services;

use App\Core\AccountTransaction;
use App\Constants\HTTPConstant;
use Config;

class TransactionService
{
    private $accountTransaction;
    private $searchableFileds = ["transaction_type", "destination_account_number",
        "transaction_mode_id", "account_information", "amount", "status",
        "notes", "categories"];
    private $wildcardSearchableFields = ["desctination_account_number", "account_information",
        "notes", "categories", "ref_transaction"];
    private $dateFields = ["from_date", "to_date"];
    private $where = array();
    private $result = array();
    private $account_number = "";
    private $limit = 25;
    private $offset = 0;

    public function __construct(AccountTransaction $accountTransaction) {
        $this->accountTransaction = $accountTransaction;
        $startDate = date("Y-m-d") . " 00:00:00";
        $endDate = date("Y-m-d") . " 23:59:59";
        $this->limit = Config('transaction.default_page_limit');
        $this->where["from_date"] = $startDate;
        $this->where["to_date"] = $endDate;
        $this->where["limit"] = $this->limit;
        $this->where["offset"] = $this->offset;
        $this->result = [
            "code" => HTTPConstant::APPLICATION_ERROR,
            "data" => [],
            "error" => []
        ];
    }

    public function setFilters($filters = []) {
        foreach($filters as $key => $value) {
            if($key === "account_number") {
                $this->account_number = $value;
            }
            if(!in_array($key, $this->searchableFileds)) {
                continue;
            }
            if(in_array($key, $this->wildcardSearchableFields)) {
                $value = "%".$value."%";
            }
            $this->where[$key] = $value;
        }
    }

    public function fetchTransactionLogs() {
        $transaction_data = $this->accountTransaction->fetchTransactionLogs($this->account_number, $this->where);
        if(isset($transaction_data["error"])) {
            $this->result["error"] = $transaction_data["error"];
            return $this->result;
        }
        $this->result["total"] = $transaction_data['count'];
        unset($transaction_data['count']);
        $this->result["code"] = HTTPConstant::OK;
        $this->result["data"] = ["transactions" => $transaction_data];
        $this->result["limit"] = $this->where['limit'];
        $this->result["offset"] = $this->where['offset'];
        return $this->result;
    }
}
