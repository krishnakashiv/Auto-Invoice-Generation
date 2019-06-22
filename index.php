<?php
//index.php
$cid=$_POST['cid'];
$chno=$_POST['chno'];
$date=$_POST['date'];
session_start();
$conn=mysqli_connect('localhost','root','','main');

$sql="INSERT INTO CHALLAN(challanno,cid,arrivaldate) VALUES ('$chno','$cid','$date')";
 if(mysqli_query($conn,$sql))
{
    echo " ";
} 

$sql1="SELECT orderid FROM CHALLAN where challanno='$chno'";
 
$result=mysqli_query($conn,$sql1);
 $row = mysqli_fetch_row($result);
    $order_id = $row[0];
$_SESSION['orderid'] = $order_id;
$connect = new PDO("mysql:host=localhost;dbname=main", "root", "");
function fill_unit_select_box($connect)
{ 
 $output = '';
 $query = "SELECT * FROM tbl_unit ORDER BY unit_name ASC";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '<option value="'.$row["unit_name"].'">'.$row["unit_name"].'</option>';
 }
 return $output;
}

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Add Remove Select Box Fields Dynamically using jQuery Ajax in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Add Remove Select Items</h3>
   <br />
   <h4 align="center">Enter Item Details</h4>
   <br />
      <div id="container">
          <div id="jumbotron">
      <table align="center">
      <tr>
          <th style="width: 30%;">Client ID: <?php echo $cid ?></th>
          <th style="width: 30%;">Challan No: <?php echo $chno ?></th>
          <th style="width: 30%;">Date: <?php echo $date ?></th>
          <th style="width: 30%;">Order ID: <?php echo $order_id ?></th>
          </tr>
        
      </table>
          </div></div>
      <br>
   <form method="post" id="insert_form">
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>Enter Item Name</th>
       <th>Enter Quantity</th>
       <th>Enter Remarks</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Insert" />
     </div>
    </div>
   </form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';
  html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
  html += '<td><input type="text" name="item_unit[]" class="form-control item_unit" /></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  $('.item_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.item_quantity').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Quantity at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  
  $('.item_unit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Select Unit at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });
  var form_data = $(this).serialize();
  if(error == '')
  {
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     if(data == 'ok')
     {
      $('#item_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">Item Details Saved</div>');
     }
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });
 
});
</script>
