## About Banking App

Banking app helps us to fetch the transaction details of the account with different filter parameters like date, type, status, mode etc

## INSTALLATION
1. Install Composer
2. Download the repo using **git clone** command
3. Execute **composer install inside the project folder
4. Add .env file with required information for MongoDB and Mysql
5. Generate APP_KEY using **php artisan generate:key** command
6. Start the application using **php artisan serve** command

## FEATURE BRANCH NAME
**feature-transaction**

## MAIN FILES
1. Controller : app\Http\Controllers\TransactionController.php
2. Request Validation : app\Http\Requests\TransactionRequest.php
3. Service : app\Services\TransactionService.php
4. Models : app\Models\AccountTransaction.php
5. Core : app\Core\MongoAccountTransaction.php

## ALL DESIGN AND FLOW RELATED DOCUMNET
Below document contains entire flow, design, architecture daiagram, flow chart of the reqest and ERD daiagram of the database
https://docs.google.com/document/d/1oOWzBJO54WRPIEYAczYXNojb8d2bNEzGoCbsU0PuDXs/edit

## SAMPLE REQUEST
curl -X GET \
  'http://127.0.0.1:8001/api/transactions?account_number=11223355&account_type=2' \
  -H 'cache-control: no-cache' \
  -H 'content-type: application/json' \
  -H 'postman-token: e46cd4f7-7e07-9b3e-4ba8-450bb9a2a1f1'
  
## SAMPLE RESPONSE
{
    "code": 200,
    "message": "Request processed",
    "data": {
        "transactions": [
            {
                "account_type": 1,
                "transaction_type": "credit",
                "transaction_mode": 1,
                "status": 1,
                "amount": 100,
                "transaction_account_number": "156789",
                "account_information": {
                    "name": "Shiva",
                    "account_type": "Savings"
                },
                "notes": "",
                "categories": "",
                "created_at": "2021-03-15T00:00:00.000000Z",
                "ref_transaction": "FFG123456"
            },
            {
                "account_type": 1,
                "transaction_type": "credit",
                "transaction_mode": 1,
                "status": 1,
                "amount": 100,
                "transaction_account_number": "157789",
                "account_information": {
                    "name": "Srinivasan",
                    "account_type": "Savings"
                },
                "notes": "",
                "categories": "",
                "created_at": "2021-03-15T01:00:00.000000Z",
                "ref_transaction": "FFG123YY6"
            },
            {
                "account_type": 2,
                "transaction_type": "credit",
                "transaction_mode": 1,
                "status": 1,
                "amount": 300,
                "transaction_account_number": "15778989",
                "account_information": {
                    "name": "Srinivasan",
                    "account_type": "Savings"
                },
                "notes": "",
                "categories": "",
                "created_at": "2021-03-15T01:00:00.000000Z",
                "ref_transaction": "FFG123XX6"
            },
            {
                "account_type": 2,
                "transaction_type": "debit",
                "transaction_mode": 1,
                "status": 1,
                "amount": 100,
                "transaction_account_number": "15744489",
                "account_information": {
                    "name": "Srivittal",
                    "account_type": "Savings"
                },
                "notes": "",
                "categories": "",
                "created_at": "2021-03-15T01:00:00.000000Z",
                "ref_transaction": "FFG123BX6"
            },
            {
                "account_type": 2,
                "transaction_type": "debit",
                "transaction_mode": 1,
                "status": 2,
                "amount": 100,
                "transaction_account_number": "15744489",
                "account_information": {
                    "name": "Srivathsan",
                    "account_type": "Savings"
                },
                "reason": "account not verified",
                "notes": "",
                "categories": "Bill Payments",
                "created_at": "2021-03-15T01:00:00.000000Z",
                "ref_transaction": "FFG123BX6"
            }
        ],
        "status": [
            "Pending",
            "Success",
            "Failure",
            "Waiting for Confirmation"
        ],
        "account_types": {
            "1": "PPF",
            "2": "RD",
            "3": "FD",
            "4": "Credit Card",
            "5": "Current",
            "6": "Savings"
        },
        "transation_modes": {
            "1": {
                "name": "NEFT",
                "image": "neft.jpg"
            },
            "2": {
                "name": "RTGS",
                "image": "rtgs.jpg"
            },
            "3": {
                "name": "IMPS",
                "image": "imps.jpg"
            },
            "4": {
                "name": "ATM",
                "image": "atm.jpg"
            },
            "5": {
                "name": "others",
                "image": ""
            },
            "6": {
                "name": "UPI",
                "image": "upi.jpg"
            }
        }
    },
    "error": {},
    "total": 5,
    "limit": 25,
    "offset": 0
}
