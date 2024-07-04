<?php
include('../Assets/Connection/connection.php');
ob_start();
session_start();


if (isset($_POST['btn_login'])) {
   $email = $_POST['txt_email'];
   $password = $_POST['txt_password'];

   $selQuery = "select * from tbl_user where user_email = '$email' and user_password = '$password'";
   $result = $conn->query($selQuery);
   if ($result->num_rows) {
      $data = $result->fetch_assoc();
      $_SESSION['uid'] = $data['user_id'];
      ?>
      <script>
         window.location = '../User/UserHomepage.php';
      </script>
      <?php
   } else {
      $selQuery = "select * from tbl_shop where shop_email = '$email' and shop_password = '$password'";
      $result = $conn->query($selQuery);
      if ($result->num_rows) {
         $data = $result->fetch_assoc();
         $_SESSION['sid'] = $data['shop_id'];
         ?>
         <script>
            window.location = '../Shop/ShopHomepage.php';
         </script>
         <?php
      } else {
         $selQuery = "select * from tbl_admin where admin_email = '$email' and admin_password = '$password'";
         $result = $conn->query($selQuery);
         if ($result->num_rows) {
            $data = $result->fetch_assoc();
            $_SESSION['admin_id'] = $data['admin_id'];
            ?>
            <script>
               window.location = '../Admin/AdminHomePage.php';
            </script>
            <?php
         } else {
            ?>
            <script>
               alert('Incorrect email and password. Please try again')
               window.location = './login.php';
            </script>
            <?php
         }
      }
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <title>GREENCART - GREENCART Login</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <meta content="Free HTML Templates" name="keywords">
   <meta content="Free HTML Templates" name="description">

   <link href="../Assets//Template//Login//assets/css/bootstrap.min.css" rel="stylesheet">
   <link href="../Assets//Template//Login//assets/css/font-awesome.min.css" rel="stylesheet">
   <link href="../Assets//Template//Login//assets/css/style.css" rel="stylesheet">

   <!-- Favicon -->
   <link href="../Assets//Template//MainTemplate//img/favicon.ico" rel="icon">

   <!-- Google Web Fonts -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

   <!-- Icon Font Stylesheet -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
   <link href="../Assets//Template//MainTemplate//lib/flaticon/font/flaticon.css" rel="stylesheet">

   <!-- Libraries Stylesheet -->
   <link href="../Assets//Template//MainTemplate//lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

   <!-- Customized Bootstrap Stylesheet -->
   <link href="../Assets//Template//MainTemplate//css/bootstrap.min.css" rel="stylesheet">

   <!-- Template Stylesheet -->
   <link href="../Assets//Template//MainTemplate//css/style.css" rel="stylesheet">

   <link rel="stylesheet" href="../">
</head>

<body>

   <!-- Navbar Start -->
   <br>
   <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
      <a href="index.html" class="navbar-brand ms-lg-5">
         <h1 class="m-0 text-uppercase" style="color:#548302;"><i class="bi  fs-1 text-primary me-3"></i>GREENCART</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav ms-auto py-0">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="./login.php" class="nav-item nav-link active">Login</a>
            <div class="nav-item dropdown"  style="padding-right: 2em;">
               <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Register</a>
               <div class="dropdown-menu m-0">
                  <a href="./userRegistration.php" class="dropdown-item">User</a>
                  <a href="./ShopRegistration.php" class="dropdown-item">Shop</a>
               </div>
            </div>
         </div>
      </div>

   </nav>
   <!-- Navbar End -->




   <!-- login section  -->
   <section class="form-02-main">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="_lk_de">
                  <form class="form-03-main" method="post">
                     <br>
                     <br>
                     <br>
                     <div class="form-group">
                        <input type="email" name="txt_email" class="form-control _ge_de_ol" type="text"
                           placeholder="Enter Email" required="" aria-required="true">
                     </div>

                     <div class="form-group">
                        <input type="password" name="txt_password" class="form-control _ge_de_ol" type="text"
                           placeholder="Enter Password" required="" aria-required="true">
                     </div>

                     <div class="form-group">
                        <button type="submit" name="btn_login" class="_btn_04"
                           style="color: #ffff;font-weight: bold; font-size: 14pt;background-color: #548302;border:none;">Login</button>
                     </div>
                     <br>
                     <br>
                     <br>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- login section end -->






   <?php include('../Assets/Template/MainTemplate/Guest/footer.php'); ?>


   <!-- JavaScript Libraries -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../Assets//Template//MainTemplate//lib//easing/easing.min.js"></script>
   <script src="../Assets//Template//MainTemplate//lib/waypoints/waypoints.min.js"></script>
   <script src="../Assets//Template//MainTemplate//lib/owlcarousel/owl.carousel.min.js"></script>

   <!-- Template Javascript -->
   <script src="../Assets//Template//MainTemplate//js/main.js"></script>
</body>

</html>

<?php ob_flush(); ?>