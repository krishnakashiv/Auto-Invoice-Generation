<?php
//insert.php;
session_start();
if(isset($_POST["item_name"]))
{
    $order_id = $_SESSION['orderid'];
 $connect = new PDO("mysql:host=localhost;dbname=main", "root", "");
 for($count = 0; $count < count($_POST["item_name"]); $count++)
 {  
  $query = "INSERT INTO tbl_order_items 
  (order_id, item_name, item_quantity, item_remarks) 
  VALUES ('$order_id', :item_name, :item_quantity, :item_unit)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':item_name'  => $_POST["item_name"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count], 
    ':item_unit'  => $_POST["item_unit"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>
