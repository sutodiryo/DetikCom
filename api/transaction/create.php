<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/db.php';
include_once '../../model/transaction.php';
include_once '../helpers.php';

$database = new Db();
$db = $database->getConnection();

$item = new Transaction($db);

$data = json_decode(file_get_contents("php://input"));

$item->invoice_id = $data->invoice_id;
$item->created = date('Y-m-d H:i:s');
$item->item_name = $data->item_name;
$item->amount = $data->amount;
$item->payment_type = $data->payment_type;
$item->customer_name = $data->customer_name;
$item->merchant_id = $data->merchant_id;

$ref_id = generateRefID();
$item->references_id = $ref_id;

if ($data->payment_type == 'virtual_account') {
    $number_va = generateVA();
} else {
    $number_va = null;
}
$item->number_va = $number_va;

$item->status = 'Pending';
$store = $item->createTransaction();

if ($store) {
    $res = array(
        "references_id" => $item->references_id,
        "number_va" => $item->number_va,
        "status" => $item->status,
    );

    http_response_code(200);
} else {
    $res = array(
        "msg" => 'Transaction creation failed.',
    );
    http_response_code(500);
}

echo json_encode($res);
