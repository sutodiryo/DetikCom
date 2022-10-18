<?php
class Transaction
{
    private $conn;

    private $db_table = "transaction";

    public $invoice_id;
    public $created;
    public $item_name;
    public $amount;
    public $payment_type;
    public $customer_name;
    public $merchant_id;
    public $number_va;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTransaction()
    {
        $q = "INSERT INTO $this->db_table
                        SET
                        invoice_id = :invoice_id,
                        created = :created,
                        item_name = :item_name,
                        amount = :amount,
                        payment_type = :payment_type,
                        customer_name = :customer_name,
                        merchant_id = :merchant_id,
                        references_id = :references_id,
                        number_va = :number_va,
                        status = :status";

        $stmt = $this->conn->prepare($q);

        // Sanitize
        $this->invoice_id = htmlspecialchars(strip_tags($this->invoice_id));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->item_name = htmlspecialchars(strip_tags($this->item_name));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->payment_type = htmlspecialchars(strip_tags($this->payment_type));
        $this->customer_name = htmlspecialchars(strip_tags($this->customer_name));
        $this->merchant_id = htmlspecialchars(strip_tags($this->merchant_id));
        $this->references_id = htmlspecialchars(strip_tags($this->references_id));
        $this->number_va = htmlspecialchars(strip_tags($this->number_va));
        $this->status = $this->status;

        // Bind data
        $stmt->bindParam(":invoice_id", $this->invoice_id);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":item_name", $this->item_name);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":payment_type", $this->payment_type);
        $stmt->bindParam(":customer_name", $this->customer_name);
        $stmt->bindParam(":merchant_id", $this->merchant_id);
        $stmt->bindParam(":references_id", $this->references_id);
        $stmt->bindParam(":number_va", $this->number_va);
        $stmt->bindParam(":status", $this->status);

        $res = $stmt->execute();

        if ($res) {
            return $res;
        }
        return false;
    }

    public function getStatusTransaction($references_id, $merchant_id)
    {
        $q = "SELECT references_id,invoice_id,status
                    FROM $this->db_table
                    WHERE
                    references_id = $references_id
                    AND
                    merchant_id = $merchant_id
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($q);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->references_id = $dataRow['references_id'];
        $this->invoice_id = $dataRow['invoice_id'];
        $this->status = $dataRow['status'];
    }

    public function updateTransaction()
    {
        $q = "UPDATE $this->db_table
                    SET
                    status = :status
                    WHERE
                    references_id = :references_id";

        $stmt = $this->conn->prepare($q);

        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->references_id = htmlspecialchars(strip_tags($this->references_id));

        // bind data
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":references_id", $this->references_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}
