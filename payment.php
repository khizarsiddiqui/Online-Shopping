<?php 
include 'config.php'; 
   ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Order form</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    
    <!-- Bootstrap core CSS -->
    <link href="./dist/frontendcss/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="./dist/frontendcss/fontawesome.css">
    <link rel="stylesheet" href="./dist/frontendcss/style.css">
    <link rel="stylesheet" href="./dist/frontendcss//owl.css">
    <link rel="shortcut icon" href="images/favicon-icon/24x24.png">

    <style>
      html, body {
      height: 100%;
      }
      body, input, select { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #eee;
      }
      h1, h3 {
      font-weight: 400;
      }
      h1 {
      font-size: 50px;
      color:#000000;
      }
      h3 {
      color: #1c87c9;
      }
      .main-block, .info {
      display: flex;
      flex-direction: column;
      }
      .main-block {
      justify-content: center;
      align-items: center;
      width: 100%; 
      min-height: 100%;
      background: url("/uploads/media/default/0001/01/e7a97bd9b2d25886cc7b9115de83b6b28b73b90b.jpeg") no-repeat center;
      background-size: cover;
      }
      form {
      width: 80%; 
      padding: 25px;
      margin-bottom: 20px;
      background: rgba(0, 0, 0, 0.9);
      }
      input, select {
      padding: 5px;
      margin-bottom: 20px;
      background: transparent;
      border: none;
      border-bottom: 1px solid #eee;
      }
      input::placeholder {
      color: #eee;
      }
      option {
      background: black; 
      border: none;
      }
      .metod {
      display: flex; 
      }
      input[type=radio] {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin-right: 20px;
      text-indent: 32px;
      cursor: pointer;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: -1px;
      left: 0;
      width: 17px;
      height: 17px;
      border-radius: 50%;
      border: 2px solid #1c87c9;
      }
      label.radio:after {
      content: "";
      position: absolute;
      width: 8px;
      height: 4px;
      top: 5px;
      left: 5px;
      border-bottom: 3px solid #1c87c9;
      border-left: 3px solid #1c87c9;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      button {
      display: block;
      width: 200px;
      padding: 10px;
      margin: 20px auto 0;
      border: none;
      border-radius: 5px; 
      background: #1c87c9; 
      font-size: 14px;
      font-weight: 600;
      color: #fff;
      }
      button:hover {
      background: #095484;
      }
      @media (min-width: 568px) {
      .info {
      flex-flow: row wrap;
      justify-content: space-between;
      }
      input {
      width: 46%;
      }
      input.fname {
      width: 100%;
      }
      select {
      width: 48%;
      }
      }
    </style>
  </head>
  <body>
    <div class="main-block">
      <h1>Order Form</h1>
      <form action="success.php" method="post">
        <div class="info">
          <input class="fname" type="text" name="name" placeholder="Full name" required>
          <input type="text" name="email" placeholder="Email" required>
          <input type="text" name="phone" placeholder="Phone number" required>
          
          <input type="text" name="address" placeholder="Full delivery Address" required>
          <input type="text" name="city" placeholder="City" required>
        </div>
        <h3>Payment Method</h3>
        <div class="metod">
          <div> 
            <input type="radio" value="none" id="radioOne" name="metod" checked/>
            <label for="radioOne" class="radio">Cash On delivery</label>
          </div>
        
        </div>
        <button id= 'sub' button href="/" class="button">Submit</button>
      </form>
     
       <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    </div>
  </body>
</html>
<?php
session_start();
$user = $_SESSION['username'];

$db = new Database();
$db->select('options','site_name',null,null,null,null);
$site_name = $db->getResult();


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_f95508c7ff3dc44e5240321ee4c",
                  "X-Auth-Token:test_6a29ac898bb6e073597e3c1ed8a"));
$payload = Array(
    'purpose' => 'Payment to '.$site_name[0]['site_name'],
    'amount' => $_POST['product_total'],
    // 'phone' => '',
    'buyer_name' => $user,
    'redirect_url' => $hostname.'/success.php',
    // 'send_email' => true,
    // 'webhook' => 'http://www.example.com/webhook/',
    // 'send_sms' => true,
    // 'email' => 'rainkapil@gmail.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response); 
 //echo '<pre>';
 //print_r($response);
//exit;
$_SESSION['TID'] = $response->payment_request->id;
$params1 = [
    'item_number' => $_POST['product_id'],
    'txn_id' => $response->payment_request->id,
    'payment_gross' => $_POST['product_total'],
    'payment_status' => 'credit',
];
$params2 = [
    'product_id' => $_POST['product_id'],
    'product_qty' => $_POST['product_qty'],
    'total_amount' => $_POST['product_total'],
    'product_user' => $_SESSION['user_id'],
    'order_date' => date('Y-m-d'),
    'pay_req_id' => $response->payment_request->id
];
$db = new Database();
$db->insert('payments',$params1);
$db->insert('order_products',$params2);
$db->getResult();

header('Location: '.$response->payment_request->longurl);

?>