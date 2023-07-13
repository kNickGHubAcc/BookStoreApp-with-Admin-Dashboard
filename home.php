<?php
   include 'config.php';
   session_start();

   $user_id = $_SESSION['user_id'];
   if(!isset($user_id)){
      header('location:login.php');
   }

   if(isset($_POST['add_to_cart'])){            //Όταν ο χρήστης πατήσει το κουμπί 'Add To Cart', για 1 product
      $product_name = $_POST['product_name'];     //Τα χαρακτηριστικά του product, αποθηκεύονται σε κατάλληλες μεταβλητές
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];

      //Εκτέλεση ενός SQL query με σκοπό να ελεγχθεί αν το product που επιχειρεί να προσθέσει ο χρήστης στο cart, βρίσκεται ήδη εκεί
      $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

      if(mysqli_num_rows($check_cart_numbers) > 0){      //Αν το product έχει ήδη προστεθει στο cart
         $message[] = 'Already added to cart!';
      }else{
         //To product προστίθεται στο cart και εμφανίζεται κατάλληλο μήνυμα επιτυχίας
         mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
         $message[] = 'Product added to cart!';
      }
   }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Home</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">       <!--Για να είναι εφικτές οι αλλαγές στην CSS -->
   </head>

   <body>
      <?php include 'header.php'; ?>

      <!---------------- Main Section --------------------->
      <section class="home">
         <div class="content">
            <h3>Buy your favourite book with 1 click</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.</p>
            <a href="about.php" class="white-btn">discover more</a>
         </div>
      </section>

      <!----------- Latest Products Section --------------->
      <section class="products">
         <h1 class="title">latest products</h1>
         <div class="box-container">
            <?php  
               $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');    //Ανάκτηση των πρώτων 6 προιόντων από τον πίνακα products της βάσης δεδομένων
               if(mysqli_num_rows($select_products) > 0){       //Αν ο πίνακας products δεν είναι άδειος
                  while($fetch_products = mysqli_fetch_assoc($select_products)){       //Για κάθε 1 από αυτά τα products, τα οποία θα αποθηκεύονται στον πίνακα 'fetch_products'
            ?>
            <form action="" method="post" class="box">         <!-- θα εμφανίζεται και 1 box με τα χαρακτηριστικά του product-->
               <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
               <div class="name"><?php echo $fetch_products['name']; ?></div>
               <div class="price"><?php echo $fetch_products['price']; ?>€</div>
               <input type="number" min="1" name="product_quantity" value="1" class="qty">
               <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
               <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
               <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
               <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>
            <?php
               }
            }else{      //Αν ο πίνακας products δεν έχει καθόλου εγγραφές
               echo '<p class="empty">No products added yet!</p>';
            }
            ?>
         </div>

         <div class="load-more" style="margin-top:4rem; text-align:center">
            <a href="shop.php" style="width:30%" class="option-btn">load more</a>
         </div>
      </section>

      <!----------------- About Us Section ------------------->
      <section class="about">
         <div class="flex">
            <div class="image">
               <img src="images/about.jpg" alt="">
            </div>

            <div class="content">
               <h3>about us</h3>
               <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima
                  ipsa dicta officia corporis ratione saepe sed adipisci? Lorem ipsum dolor, sit
                  amet consectetur adipisicing elit.</p>
               <a href="about.php" class="btn">read more</a>
            </div>
         </div>
      </section>

      <?php include 'footer.php'; ?>

      <script src="js/script.js"></script>
   </body>
</html>