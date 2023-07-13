<?php
   include 'config.php';

   session_start();
   $user_id = $_SESSION['user_id'];
   if(!isset($user_id)){
      header('location:login.php');
   }

   if(isset($_POST['order_btn'])){           //Όταν ο χρήστης πατήσει το κουμπί 'Order Now'
      $name = mysqli_real_escape_string($conn, $_POST['name']);      //Χρήση της mysql_real_escape_string για αποφυγή της SQL injetion
      $number = $_POST['number'];
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $method = mysqli_real_escape_string($conn, $_POST['method']);
      $address = mysqli_real_escape_string($conn, $_POST['street'].' '.$_POST['flat'].', '. $_POST['state'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
      $placed_on = date('d-M-Y');

      $cart_total = 0;
      $cart_products[] = '';
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');     //Ανάκτηση των προιόντων που βρίσκονται στο cart του χρήστη
      
      if(mysqli_num_rows($cart_query) > 0){
         while($cart_item = mysqli_fetch_assoc($cart_query)){        //Υπολογισμός του συνολικού ποσού του καλαθιού
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
         }
      }

      $total_products = implode(', ',$cart_products);    //Τα προιόντα του cart αποθηκεύονται ως συμβολοσειρά σε μια μεταβλητή, με χρήση ενδιάμεσου κόματος
      $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

      if($cart_total == 0){
         $message[] = 'Your cart is empty';
      }else{
         if(mysqli_num_rows($order_query) > 0){
            $message[] = 'Order already placed!'; 
         }else{
            //Εισαγωγή της παραγγελίας στον πίνακα orders της βάσης δεδομένων
            mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
            $message[] = 'Order placed successfully!';
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');   //Διαγραφή των προιόντων από το cart του χρήστη
         }
      }
   }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Checkout</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">       <!--Για να είναι εφικτές οι αλλαγές στην CSS -->
   </head>

   <body>
      <?php include 'header.php'; ?>

      <div class="heading">
         <h3>checkout</h3>
      </div>

      <section class="display-order">
         <?php  
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                  $grand_total += $total_price;
         ?>
         <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo $fetch_cart['quantity'].' x '.$fetch_cart['price'].'€'; ?>)</span> </p>
         <?php
            }
         }else{
            echo '<p class="empty">Your cart is empty</p>';
         }
         ?>
         <div class="grand-total"> Grand total : <span><?php echo $grand_total; ?>€</span> </div>
      </section>

      <section class="checkout">
         <form action="" method="post">
            <h3>place your order</h3>
            <div class="flex">
               <div class="inputBox">
                  <span>Your name:</span>
                  <input type="text" name="name" required placeholder="Name">
               </div>
               <div class="inputBox">
                  <span>Your phone number:</span>
                  <input type="number" name="number" required placeholder="Phone number">
               </div>
               <div class="inputBox">
                  <span>Your email:</span>
                  <input type="email" name="email" required placeholder="Email">
               </div>
               <div class="inputBox">
                  <span>Payment method :</span>
                  <select name="method">
                     <option value="cash on delivery">Cash on delivery</option>
                     <option value="credit card">Credit card</option>
                     <option value="paypal">Paypal</option>
                  </select>
               </div>
               <div class="inputBox">
                  <span>Address:</span>
                  <input type="text" name="street" required placeholder="e.g. Xaridimou">
               </div>
               <div class="inputBox">
                  <span>Number:</span>
                  <input type="number" min="0" name="flat" required placeholder="e.g. 56">
               </div>
               <div class="inputBox">
                  <span>City:</span>
                  <input type="text" name="city" required placeholder="e.g. Athens">
               </div>
               <div class="inputBox">
                  <span>State:</span>
                  <input type="text" name="state" required placeholder="e.g. Polixni">
               </div>
               <div class="inputBox">
                  <span>Country:</span>
                  <input type="text" name="country" required placeholder="e.g. Greece">
               </div>
               <div class="inputBox">
                  <span>Postcode:</span>
                  <input type="number" min="0" name="pin_code" required placeholder="e.g. 56430">
               </div>
            </div>
            <input type="submit" value="order now" class="btn" name="order_btn">
         </form>
      </section>

      <?php include 'footer.php'; ?>

      <script src="js/script.js"></script>
   </body>
</html>