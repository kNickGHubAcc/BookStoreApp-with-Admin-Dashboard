<?php
   include 'config.php';
   session_start();

   $user_id = $_SESSION['user_id'];
   if(!isset($user_id)){
      header('location:login.php');
   }

   if(isset($_POST['send'])){          //Όταν ο χρήστης πατήσει το κουμπί 'Send Message'
      $name = mysqli_real_escape_string($conn, $_POST['name']);     //Χρήση της mysqli_real_escape_string για αποφυγή της SQL injection
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $number = $_POST['number'];
      $msg = mysqli_real_escape_string($conn, $_POST['message']);

      //Ερώτημα SQL προκειμένου να ελεχθεί αν έχουν αποσταλλεί τα ίδια name, email, number και msg
      $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

      if(mysqli_num_rows($select_message) > 0){    //Αν έχουν αποσταλλεί τα ίδια
         $message[] = 'Message already sent!';
      }else{
         //Αποθήκευση στον πίνακα message
         mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
         $message[] = 'Message sent successfully!';
      }
   }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Contact</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">       <!--Για να είναι εφικτές οι αλλαγές στην CSS -->
   </head>

   <body>
      <?php include 'header.php'; ?>

      <div class="heading">
         <h3>contact us</h3>
      </div>

      <section class="contact">
         <form action="" method="post">
            <h3>say something !</h3>
            <input type="text" name="name" required placeholder="Name" class="box">
            <input type="email" name="email" required placeholder="Email" class="box">
            <input type="number" name="number" required placeholder="Phone Number" class="box">
            <textarea name="message" class="box" placeholder="Message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="btn">
         </form>
      </section>

      <?php include 'footer.php'; ?>

      <script src="js/script.js"></script>
   </body>
</html>