<?php
include_once 'config/db.php';
include_once 'model/transaction.php';

$database = new Db();
$db = $database->getConnection();

$item = new Transaction($db);

$ref_id = array_slice($argv, 1)[0];
$status = array_slice($argv, 1)[1];

$item->references_id = $ref_id;
$item->status = $status;

if ($item->updateTransaction()) {
    echo "Transaction data updated.\n";
} else {
    echo "Data update failed\n";
}
