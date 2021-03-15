<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TransactionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validations = [
            "from_date" => "date_format:Y-m-d",
            "to_date" => "date_format:Y-m-d",
            "account_number" => "required|string",
            "format" => ["string", Rule::in(['json', 'text', 'pdf', 'csv'])],
        ];
        switch ($this->method()) {
            case 'POST': {
                $postvalidations = [
                    "amount" => "numeric|between:0,999999999.99",
                    "transaction_type" => ["string", Rule::in(['credit', 'debit'])],
                    "transaction_mode" => ["string", Rule::in(['upi', 'cc', 'neft', 'rtgs', 'imps', 'atm', 'other'])],
                    "status" => ["string", Rule::in(['success', 'failed', 'all'])],
                    "to_account_name" => "string",
                    "ref_transaction" => "string",
                    "to_account_number" => "string",
                ];
                return array_merge($validations, $postvalidations);
                break;
            }
            default: {
                return $validations;
                break;
            }
        }
    }

    public function messages()
    {
        return [
            'account_number.required' => 'Account Number is required.',
            'from_date.required' => 'From Date is required.',
            'to_date.required' => 'To Date is required.'
        ];
    }
}
