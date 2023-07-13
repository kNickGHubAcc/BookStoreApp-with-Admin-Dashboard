<?php
   include 'config.php';

   session_start();

   if(isset($_POST['submit'])){              //Όταν ο χρήστης πατήσει το κουμπί Login Now
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

      //Ερώτημα SQL προκειμένου να ελεγχθεί αν τα στοιχεία email και password που εισήχθησαν, υπάρχουν στη βάση
      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

      if(mysqli_num_rows($select_users) > 0){       //Αν ο χρήστης υπάρχει στη βάση
         $row = mysqli_fetch_assoc($select_users);   //Χρήση της mysqli_fetch_assoc με σκοπό την πρόσβαση στα πεδία της εγγραφής (χρήστη)

         if($row['user_type'] == 'admin'){           //Αν αναφερόμαστε σε admin
            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
         }elseif($row['user_type'] == 'user'){       //Αν αναφερόμαστε σε απλό user
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }else{
         $message[] = 'Incorrect email or password!';
      }
   }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">       <!--Για να είναι εφικτές οι αλλαγές στην CSS -->
   </head>

   <body>
      <?php
         if(isset($message)){
            foreach($message as $message){
               echo '
               <div class="message">
                  <span>'.$message.'</span>
                  <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
               </div>
               ';
            }
         }
      ?>
         
      <div class="form-container">
         <form action="" method="post">
            <h3>login</h3>
            <input type="email" name="email" placeholder="Enter your email" required class="box">
            <input type="password" name="password" placeholder="Enter your password" required class="box">
            <input type="submit" name="submit" value="login now" class="btn">
            <p>Don't have an account? <a href="register.php"> Register now</a></p>
         </form>
      </div>
   </body>
</html>