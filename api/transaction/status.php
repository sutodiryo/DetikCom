<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/db.php';
include_once '../../model/transaction.php';

$database = new Db();
$db = $database->getConnection();

$item = new Transaction($db);

$data = json_decode(file_get_contents("php://input"));

$item->getStatusTransaction($data->references_id, $data->merchant_id);

if ($item->references_id != null) {
    $res = array(
        "references_id" => $item->references_id,
        "invoice_id" => $item->invoice_id,
        "status" => $item->status,
    );

    http_response_code(200);
} else {
    $res = array(
        "msg" => "Transaction not found.",
    );
    http_response_code(404);
}
echo json_encode($res);
