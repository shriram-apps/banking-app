<?php

return [
    "default_page_limit" => env('PAGE_LIMIT', 25),
    "status" => array(0 => "Pending", 1 => "Success", 2 => "Failure", 3 => "Waiting for Confirmation"),
    "account_type" => array(1 => "PPF", 2 => "RD", 3 => "FD", 4 => "Credit Card", 5=> "Current", 6 => "Savings"),
    "transaction_mode" => array(1 => array("name" => "NEFT", "image" => "neft.jpg"), 
                                2 => array("name" => "RTGS", "image" => "rtgs.jpg"), 
                                3 => array("name" => "IMPS", "image" => "imps.jpg"),
                                4 => array("name" => "ATM", "image" => "atm.jpg"), 
                                5=> array("name" => "others", "image" => ""), 
                                6 => array("name" => "UPI", "image" => "upi.jpg"))

];
