<?php
session_start();
require_once 'includes/config.php';
if(isset($_GET['order_id'])){
	$order_id=$_GET['order_id'];
	$select_data="SELECT * FROM `orders` WHERE order_id=$order_id";
	$result=mysqli_query($conn,$select_data);
	$row_fetch=mysqli_fetch_assoc($result);
	$invoice_number=$row_fetch['invoice_number'];
	$amount_due=$row_fetch['total_price'];
}
	if(isset($_POST['submit'])){
		$invoice_number=$_POST['invoice_number'];
		$amount=$_POST['amount'];
		$payment_mode=$_POST['payment_mode'];
		$insert_query="INSERT INTO `payments` (order_id,invoice_number,amount,payment_mode)VALUES ($order_id,$invoice_number,$amount,'$payment_mode')";
		$result=mysqli_query($conn,$insert_query);
		if($result){
			echo"<script>alert('Successfully completed the payment')</script>";
			echo"<script>window.open('index.php','_self')</script>";
		}
		$update_orders="UPDATE `orders` SET order_status='Complete' WHERE order_id=$order_id";
		$result_orders=mysqli_query($conn,$update_orders);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="Website Icon" type="png" href="website_logo4.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment Page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap");

      body {
        background-color: #eaedf4;
        font-family: "Rubik", sans-serif;
      }

      .card {
        width: 310px;
        border: none;
        border-radius: 15px;
      }

      .justify-content-around div {
        border: none;
        border-radius: 20px;
        background: #f3f4f6;
        padding: 5px 20px 5px;
        color: #8d9297;
      }

      .justify-content-around span {
        font-size: 12px;
      }

      .justify-content-around div:hover {
        background: #545ebd;
        color: #fff;
        cursor: pointer;
      }

      .justify-content-around div:nth-child(1) {
        background: #545ebd;
        color: #fff;
      }

      span.mt-0 {
        color: #8d9297;
        font-size: 12px;
      }

      h6 {
        font-size: 15px;
      }
      .mpesa {
        background-color: green !important;
      }

      img {
        border-radius: 15px;
      }
    </style>
</head>
<body oncontextmenu="return false" class="snippet-body">
    <div class="container d-flex justify-content-center">
      <div class="card mt-5 px-3 py-4">
        <div class="d-flex flex-row justify-content-around">
          <div class="mpesa"><span>Mpesa </span></div>
          <div><span title="coming soon">Paypal</span></div>
          <div><span title="coming soon">Card</span></div>
        </div>
        <div class="media mt-4 pl-2">
          <img src="1200px-M-PESA_LOGO-01.svg.png" class="mr-3" height="75" />
          <div class="media-body">
            
          </div>
        </div>
        <div class="media mt-3 pl-2">
                          <!--bs5 input-->

            <form class="row g-3" action="quikk.php" method="POST">
				<div class="col-12">
					<input type="hidden" name="payment_mode" value="mpesa">
				</div>
				<div class="col-12">
					<label for="inputAddress3" class="form-label">Invoice no.</label>
					<input type="text" name="invoice_number" class="form-control" value="<?php echo $invoice_number?>">
				</div>
                <div class="col-12">
                  <label for="inputAddress" class="form-label">Amount</label>
                  <input type="text" class="form-control" name="amount"  value="<?php echo $amount_due?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Phone Number</label>
                    <?php 
                        $email = $_SESSION['email'];
                        $checkno = "SELECT * FROM `users` WHERE email='$email'";
                        $resultno = $conn->query($checkno);
                        
                        if ($resultno->num_rows > 0) {
                            $row = $resultno->fetch_assoc();
                            if (!empty($row['phone_number'])) {
                                echo '<input type="text" class="form-control" name="phone" value="' . $row['phone_number'] . '">';
                            } else {
                                echo '<input type="text" class="form-control" name="phone" placeholder="254________">';
                            }
                        }
                    ?>
                </div>


                <div class="col-12">
                  <button type="submit" class="btn btn-success mt-2" name="submit" value="submit">Pay</button>
                </div>
              </form>
              <!--bs5 input-->
          </div>
        </div>
      </div>
    </div>
    <script
      type="text/javascript"
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
    ></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src=""></script>
    <script type="text/Javascript"></script>
  </body>
</html>