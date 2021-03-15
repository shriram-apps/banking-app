<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Services\AccountTypeService;
use App\Services\TransactionModeService;
use App\Http\Requests\TransactionRequest;
use App\Constants\HTTPConstant;
use App\Helpers\ResponseHelper;
use Config;

class TransactionController extends Controller
{
    private $transactionService, $accountTypeService, $transactionMode;

    public function __construct(TransactionService $transactionService, 
                                AccountTypeService $accountTypeService,
                                TransactionModeService $transactionModeService)
    {
        $this->transactionService = $transactionService;
        $this->accountTypeService = $accountTypeService;
        $this->transactionModeService = $transactionModeService;
    }

    public function get(TransactionRequest $request)
    {
        $transactionData = $this->processData($request);
        return ResponseHelper::format($transactionData);
    }

    public function post(TransactionRequest $request)
    {
        $transactionData = $this->processData($request);
        return ResponseHelper::format($transactionData);
    }

    public function processData(Request $request) {
        $requestData = $request->all();
        $this->transactionService->setFilters($requestData);
        $transactionData = $this->transactionService->fetchTransactionLogs();
        $transactionData["data"]["status"] = Config('transaction.status');
        $transactionData["data"]["account_types"] = $this->accountTypeService->getDetails();
        $transactionData["data"]["transation_modes"] = $this->transactionModeService->getDetails();
        return $transactionData;
    }
}
