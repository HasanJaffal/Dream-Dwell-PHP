<?php
require "./config/config.php";

  require __DIR__ ."/vendor/autoload.php";
  
  
  \Stripe\Stripe::setApiKey("sk_test_51OUV2BEEycS1RaBOSacSCcfD9f5Ze1MpYuezADtHWAkFQoIwvQV7XL7Z0YLnJvwuQhzgXYPD8t6ym0zzYbVxUJeN00FmlHIrmF");
   $bookingId=$_SESSION['_id'];

   $sql = "SELECT cost FROM booking  WHERE userId = '$bookingId' order by _id desc";
   $result = mysqli_query($con, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalCost = $row['cost'];
} else {
    die(mysqli_error($con));
}
  $checkout = \Stripe\Checkout\Session::create([
    "mode" => 'payment',
    "success_url"=>"http://localhost:3000/CRUD/index.php",
    "line_items" =>[
        [
            "quantity" => 1,
            "price_data" =>[
                "currency" =>"usd",
                "unit_amount"=> $totalCost*100,
                "product_data" => [
                    "name" => "$bookingId"
                ]
            ]
            
        ]
    ]
]);
http_response_code(303);
header("Location: ".$checkout->url)


?>