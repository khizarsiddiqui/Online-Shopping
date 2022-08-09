<!DOCTYPE html>
<html lang="en">
 <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

   
    <!-- Bootstrap core CSS -->
    <link href="../dist/frontendcss/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../dist/frontendcss/fontawesome.css">
    <link rel="stylesheet" href="../dist/frontendcss/style.css">
    <link rel="stylesheet" href="../dist/frontendcss//owl.css">
    <link rel="shortcut icon" href="images/favicon-icon/24x24.png">
  </head>
<style>
  .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  text-align: center;
 float: left;
  margin-left: 32px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white; 
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}
table, th, tr{
  text-align: center;

}
.title2{
  text-align: center;
 background-color: #000;
 color: #66afe9;
 padding: 2%;

}
table th{
  background-color: #efefef;
}


</style>
  <body>
<?php

    session_start();
include('dbcon_1.php');
if(isset($_POST["shopping_cart"])){
  if($_SESSION["cart"]){
  $item_array_id=array_column($_SESSION["cart"],"productid");
  if (!in_array($_GET["productid"], $item_array_id)) {
    $count=count($_SESSION["cart"]);
    $item_array=array(
      'productid' => $_GET['productid'],
      'productname' => $_POST['productname'],
      'productprice' => $_POST['productprice'], 
      'productquantity' => $_POST['productquantity']
     );
    $_SESSION["cart"][$count]=$item_array;
    echo '<script>window.location="productswomen.php"</script>';
  }
  else {
    echo '<script>alert("Product is already added to Cart!")</script>';
    echo '<script>window.location="productswomen.php"</script>';
  }

}
else{
   $item_array=array(
      'productid' => $_GET["productid"],
      'productname' => $_POST["productname"],
      'productprice' => $_POST["productprice"], 
      'productquantity' => $_POST["productquantity"]
     );
    $_SESSION["cart"][0]=$item_array;
}
}

if (isset($_GET["action"])) {
  if ($_GET["action"]=="delete") {
  foreach ($_SESSION["cart"] as $key => $value) {
    if ($value["productid"]==$_GET["productid"]) {
      unset($_SESSION["cart"][$keys]);
      echo '<script> alert("Product has been removed..!")</script>';
      echo '<script>window.location=productswomen.php</script>';
    }
  }
}
}
?>


 
<form >
    <!-- ***** Preloader End ***** -->

    <?php
   
   include './headerfront.php';
   
   
   ?>
    <!-- Page Content -->
    
      <?php
  include 'dbcon.php';
  $query="select * from product where productgender='Male'";
  $result=mysqli_query($conn,$query);
$run=mysqli_num_rows($result)>0;
if($run)
{
while ( $row=mysqli_fetch_array($result)) {
  ?>
  <form method="post" action="productswomen.php?action=shopping_cart&id=<?php echo$row['productid'] ?>" >
  <div class="container py-5">
 <div class col-md-3>
  <div class="card" >
    <div class="card-body">
      <img src="<?php  echo $row['productimage']; ?> "  class="card-img-top" height="200" width="300" >
      <h2 class="card-title"><?php  echo $row['productname']; ?> </h2>
      <h3 class="card-title"><?php  echo $row['productsize']; ?></h3>
      <h4 class="card-title"><?php  echo $row['productprice']; ?></h4>  
      <button  name="shopping_cart" >Add to Cart</button>
      </div>
   </div>
   </div>

   </div>
    

<?php
 
}
}
else{
echo "No data found";

}  
  ?>
 
</form>
<div style="clear: both">
  <h3 class="title2">Shopping Cart Details</h3>
  <div class="table-responsive">
    <table class="table table-bordered">
    <tr>
      <th width="30%">Product Name</th>
      <th width="30%">Quantity</th>
      <th width="30%">Price Details</th>
      <th width="30%">Total Price</th>
      <th width="30%">Remove Item</th>
    </tr>

    <?php
    if (!empty($_SESSION["cart"])) {
      $total=0;
      foreach ($_SESSION["cart"] as $key => $value) {
        ?>
        <tr>
          <td><?php  echo $value["productname"]; ?></td>
           <td><?php  echo $value["productquantity"];?></td>
            <td><?php  echo $value["productprice"];?></td>
            <td><?php echo number_format($value["productquantity"]* $value["productprice"]); ?></td>
            <td><a href="productswomen.php?action=delete&id=<?php echo $value['productid']; ?>"><span class="text-danger">Remove Item</span></a> </td>
        </tr>
        <?php
         $total =$total +($value["productquantity"] * $value["productprice"]);
}
        ?>
        <tr>
          <td colspan="3" align="right">Total </td>
          <th align="right">RS<?php echo number_format($total); ?></th>
          <td></td>
        </tr>
        <?php
      }
    
    ?>
    </table>
  </div>
</div>




    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
