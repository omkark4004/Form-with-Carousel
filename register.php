<?php

@include 'conn.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user(name, email, phone, password) VALUES('$name','$email','$phone', '$pass')";
         mysqli_query($conn, $insert);
         header('location:home.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="registerform.css">

</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Registration Form</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="text" name="name" required placeholder="Enter your Name">
            <br>
            <br>
            <input type="text" name="email" required placeholder="Enter your Email">
            <br>
            <br>
            <input type="text" name="phone" required placeholder="Enter your Phone Number">
            <br>
            <br>
            <input type="text" name="password" required placeholder="Enter your Password">
            <br>
            <br>
            <input type="text" name="cpassword" required placeholder="Confirm Password">
            <br>
            <br>
            <input type="submit" name="submit" value="Register Now!" class="btn">


        </form>
    </div>
    
</body>
</html>