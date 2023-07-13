<?php
   include 'config.php';
   session_start();

   $user_id = $_SESSION['user_id'];    //Αποθήκευση του id του χρήστη σε κατάλληλη μεταβλητή
   if(!isset($user_id)){               //Αν ο χρήστης δεν έχει συνδεθεί
      header('location:login.php');    //Ανακατεύθυνση του χρήστη στη φόρμα σύνδεσης
   }
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>About</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">    <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">       <!--Για να είναι εφικτές οι αλλαγές στην CSS -->
   </head>

   <body>
      <?php include 'header.php'; ?>     <!-- Header -->

      <!------------------ Heading ----------------------->
      <div class="heading">
         <h3>about us</h3>
      </div>

      <!------------------- Why Choose Us Section -------------------------->
      <section class="about">
         <div class="flex">
            <div class="image">
               <img src="images/about.jpg" alt="">
            </div>

            <div class="content">
               <h3>why choose us?</h3>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet voluptatibus aut hic molestias,
                  reiciendis natus fuga, cumque excepturi veniam ratione iure. Excepturi fugiat placeat iusto facere id
                  officia assumenda temporibus?</p>
               <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia
                  corporis ratione saepe sed adipisci?</p>
               <a href="contact.php" class="btn">contact us</a>
            </div>
         </div>
      </section>

      <!------------------- Client's Reviews Section ----------------------->
      <section class="reviews">
         <h1 class="title">client's reviews</h1>
         <div class="box-container">
            <!---------- 1o box --------------->
            <div class="box">
               <img src="images/pic-1.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia.
                  Ducimus repudiandae dolore placeat.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>Mike Papadopoulos</h3>
            </div>

            <!---------- 2o box --------------->
            <div class="box">
               <img src="images/pic-2.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia.
                  Ducimus repudiandae dolore placeat.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Anastasia Douma</h3>
            </div>

            <!---------- 3o box --------------->
            <div class="box">
               <img src="images/pic-3.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia.
                  Ducimus repudiandae dolore placeat.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>George Christou</h3>
            </div>

            <!---------- 4o box --------------->
            <div class="box">
               <img src="images/pic-4.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia.
                  Ducimus repudiandae dolore placeat.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
               <h3>Maria Papadimitriou</h3>
            </div>

            <!---------- 5o box --------------->
            <div class="box">
               <img src="images/pic-5.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia.
                  Ducimus repudiandae dolore placeat.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Jason Euthimiou</h3>
            </div>

            <!---------- 6o box --------------->
            <div class="box">
               <img src="images/pic-6.png" alt="">
               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ad, quo labore fugiat nam accusamus quia.
                  Ducimus repudiandae dolore placeat.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
               <h3>Gewrgia Kefidou</h3>
            </div>
         </div>
      </section>

      <!--------------------- Create Authors Section ----------------------->
      <section class="authors">
         <h1 class="title">create authors</h1>
         <div class="box-container">
            <!---------- 1o box --------------->
            <div class="box">
               <img src="images/author-1.jpg" alt="">
               <div class="share">
                  <a class="fab fa-facebook-f"></a>
                  <a class="fab fa-twitter"></a>
                  <a class="fab fa-instagram"></a>
                  <a class="fab fa-linkedin"></a>
               </div>
               <h3>Christos Dimitriou</h3>
            </div>

            <!---------- 2o box --------------->
            <div class="box">
               <img src="images/author-2.jpg" alt="">
               <div class="share">
                  <a class="fab fa-facebook-f"></a>
                  <a class="fab fa-twitter"></a>
                  <a class="fab fa-instagram"></a>
                  <a class="fab fa-linkedin"></a>
               </div>
               <h3>Marina Kagia</h3>
            </div>

            <!---------- 3o box --------------->
            <div class="box">
               <img src="images/author-3.jpg" alt="">
               <div class="share">
                  <a class="fab fa-facebook-f"></a>
                  <a class="fab fa-twitter"></a>
                  <a class="fab fa-instagram"></a>
                  <a class="fab fa-linkedin"></a>
               </div>
               <h3>Kwstas Patras</h3>
            </div>

            <!---------- 4o box --------------->
            <div class="box">
               <img src="images/author-4.jpg" alt="">
               <div class="share">
                  <a class="fab fa-facebook-f"></a>
                  <a class="fab fa-twitter"></a>
                  <a class="fab fa-instagram"></a>
                  <a class="fab fa-linkedin"></a>
               </div>
               <h3>Sylvia Mixou</h3>
            </div>

            <!---------- 5o box --------------->
            <div class="box">
               <img src="images/author-5.jpg" alt="">
               <div class="share">
                  <a class="fab fa-facebook-f"></a>
                  <a class="fab fa-twitter"></a>
                  <a class="fab fa-instagram"></a>
                  <a class="fab fa-linkedin"></a>
               </div>
               <h3>Swkratis Kwtsou</h3>
            </div>

            <!---------- 6o box --------------->
            <div class="box">
               <img src="images/author-6.jpg" alt="">
               <div class="share">
                  <a class="fab fa-facebook-f"></a>
                  <a class="fab fa-twitter"></a>
                  <a class="fab fa-instagram"></a>
                  <a class="fab fa-linkedin"></a>
               </div>
               <h3>Iwanna Pyrgidou</h3>
            </div>
         </div>
      </section>

      <?php include 'footer.php'; ?>     <!-- Footer -->

      <script src="js/script.js"></script>
   </body>
</html>