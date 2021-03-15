<?php

namespace App\Core;
use App\Core\AccountTransaction;

class MongoAccountTransaction implements AccountTransaction {

    private $accountTransaction;

    public function __construct($accountTransaction)
    {
        $this->accountTransaction = $accountTransaction;
    }

    public function fetchTransactionLogs($accountNumber, $where = [])
    {
        /*
        try
        {
            $previousMonthCount = $this->fetchPerviousCollectionCount($filter);
            $this->logModel->rewindTableByMonthsCompanyId(0, $filter["company_id"]);
            $count = $this->logModel->where('company_id', $filter["company_id"]);
            if(empty($filter)) {
                $filter = Config('lookup.filter');
            }
            $data = $this->logModel->where('company_id', $filter["company_id"]);
            if(isset($filter["startDate"]) && isset($filter["endDate"])) {
                $data = $data->whereBetween('created_at', [$filter["startDate"], $filter["endDate"]]);
                $count = $count->whereBetween('created_at', [$filter["startDate"], $filter["endDate"]]);
            }
            if(isset($filter["mobile"])) {
                $data = $data->where('mobile_number', 'like', '%'.$filter["mobile"]."%");
                $count = $count->where('mobile_number', 'like', '%'.$filter["mobile"]."%");
            }
            if(isset($filter["orderBy"])) {
                $data = $data->orderBy($filter["sort"], $filter["orderBy"]);
            }
            $count = $count->count();
            $data = $data->skip((int) $filter["offset"])
                        ->limit((int) $filter["limit"])
                        ->get(['mobile_number',
                        'country',
                        'country_code',
                        'current_operator',
                        'original_operator',
                        'roaming_operator',
                        'ported',
                        'info',
                        'created_at'])
                        ->toArray();
            if($count < $filter["limit"]) {
                $filter['limit'] =  ($filter['offset'] >= $filter["limit"]) ? $filter["limit"]: $filter["limit"] - $count;
                $filter['offset'] = ($count < $filter["offset"]) ?  ($filter['offset']  - $count) : 0;
                $previousMonthData = $this->fetchPerviousCollectionData($filter);
                if(!isset($previousMonthData["error"])) {
                    $data = array_merge($data, $previousMonthData);
                }
            }
            $data["count"] = $count;
            if(!isset($previousMonthCount["error"])) {
                $data["count"] = $count + $previousMonthCount;
            }
            return $data;
        }
        catch(\Illuminate\Database\QueryException $exception)
        {
            return ResponseHelpers::getDBCatchData($exception, func_get_args(), __METHOD__, 400, 'LKP511', __('lookup.LKP511'), __CLASS__);   
        }
        catch(Exception $e)
		{
            return ResponseHelpers::getDBCatchData($e, func_get_args(), __METHOD__, 400, 'LKP511', __('lookup.LKP511'), __CLASS__);   
		}*/
        try
        {
            $this->accountTransaction->setTable($accountNumber);
            if(isset($where["from_date"]) && isset($where["to_date"])) {
                $data = $this->accountTransaction->whereBetween('created_at', [$where["from_date"], $where["to_date"]]);
                $count = $this->accountTransaction->whereBetween('created_at', [$where["from_date"], $where["to_date"]]);
            }
            unset($where['from_date']);
            unset($where['to_date']);
            foreach($where as $key => $value) {
                if($key != "offset" && $key != "limit") {
                    $data = $data->where($key, $value);
                    $count = $count->where($key, $value);
                }
            }
            $count = $count->count();
            $data = $data->skip((int) $where["offset"])
                        ->limit((int) $where["limit"])
                        ->get(['account_type',
                        'transaction_type',
                        'transaction_mode',
                        'status',
                        'amount',
                        'transaction_account_number',
                        'account_information',
                        'reason',
                        'notes',
                        'ref_transaction',
                        'categories',
                        'created_at'])
                        ->toArray();
            $data["count"] = $count;
            return $data;
        }
        catch(\Illuminate\Database\QueryException $exception)
        {            
            return [
                'error' => $exception->getMessage()
            ];
        }
        catch(\Exception $e)
		{		
            return [
                'error' => $e->getMessage()
            ];
		}
    }
}