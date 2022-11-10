<?php
$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . "/sampleSelling-master/util/path_config/global_link_files.php";
$db_path = GlobalLinkFiles::getFilePath("db");
require_once $db_path;
class Customer extends Db
{

    public function verify_customer_by_id($customer_id)
    {
        $state = false;
        $query = "SELECT * FROM `customer` WHERE `CustomerID`=?";
        $statement = $this->connect()->prepare($query);
        $row_count = count($statement->fetchAll());
        if ($row_count == 1) {
            $state = true;
        }
        return $state;
    }
    public function insert_customer_purchase($unique_id, $dnt, $qty, $customer_id, $sample_id,$customer_email)
    {
        $query = "INSERT INTO `customer_purchase_history` (`unique_id`,`dnt`,`qty`,`CustomerID`,`sampleID`,`customer_email`) 
        VALUE (?,?,?,?,?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id, $dnt, $qty, $customer_id, $sample_id,$customer_email]);
    }
    public function insert_just($unique_id,$event_name)
    {
        $query = "INSERT INTO `just_check` (`column_1`,`event_name`) 
        VALUE (?,?)";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$unique_id,$event_name]);
    }

    public function get_sample_id($sample_unique_id){
         $id = 0;
         $query = "SELECT * FROM `samples` WHERE `UniqueId` = ?";
         $statement = $this->connect()->prepare($query);
         $statement->execute([$sample_unique_id]);
         $resultset = $statement->fetchAll();
         $row_count = count($resultset);
         if($row_count==1){
            $id = $resultset[0]["sampleID"];
         }
         return $id;
    }
    public function get_user_id($user_unique_id){
        $id = 0;
        $query = "SELECT * FROM `customer` WHERE `Unique_ID` = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$user_unique_id]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if($row_count==1){
           $id = $resultset[0]["CustomerID"];
        }
        return $id;
    }
    public function get_user_id_from_stripe($email){
        $id = 0;
        $query = "SELECT * FROM `customer` WHERE `Email` = ?";
        $statement = $this->connect()->prepare($query);
        $statement->execute([$email]);
        $resultset = $statement->fetchAll();
        $row_count = count($resultset);
        if($row_count==1){
           $id = $resultset[0]["CustomerID"];
        }
        return $id;
    }
}
