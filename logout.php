<?php
    include 'config.php';

    session_start();
    session_unset();        //Διαγραφή της αποθηκευμένης πληροφορίας του session
    session_destroy();      //Πλήρης κατάργηση του session

    header('location:login.php');
?>