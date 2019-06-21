<?php
include 'connect.php';

$query="SELECT * FROM orders order by orderid"
    
$statement=$connect->prepare($query);
if($statement->execute())
{
    while($row= $statement->fetch(PDO::FETCH_ASSOC))
    {
        $data[]=$row;
    }
    echo json_encode($data);
}

?>