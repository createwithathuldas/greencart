<?php
ob_start();
session_start();
include("../Assets/Connection/connection.php");
if (!$_SESSION['sid']) {
  ?>
  <script>
    window.location = '../index.php'
  </script>
  <?php
}

$selQuery = "select * from tbl_shop where shop_id =" . $_SESSION['sid'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();



if (isset($_POST['btn_logout'])) {
  unset($_SESSION['sid']);
  ?>
  <script>
    window.location = '../index.php';
  </script>
  <?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>GREENCART- Shop Homepage</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/owlcarousel/assets/owl.carousel.min.css"
    rel="stylesheet">
  <link
    href="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css"
    rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="../Assets//Template//AdminTemplate//darkpan-1.0.0//css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link rel="stylesheet" href="../Assets//Template//AdminTemplate//darkpan-1.0.0//css//style.css">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <link rel="stylesheet" href="../Assets//CSS//Admin//HomePage.css">

  <link rel="stylesheet" href="../Assets/CSS/Shop/ShopFeedback.css">

</head>

<body style="background: #548302;">
  <div class="container-fluid position-relative d-flex p-0">

    <?php include('../Assets/components/Shop/SideBar.php') ?>


    <!-- Content Start -->
    <div class="content" style="background: #548302;">

      <?php include('../Assets/components/Shop/NavBar.php') ?>




      <!-- Widget Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
          <div class="col-sm-12 col-md-6 col-xl-4" onclick="window.location='./ShopNewOrder.php'">
            <div class="h-100 rounded p-4" style="background:#fff;">
              <h1 style="color: #548302;text-align: center;">New Orders</h1>
              <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                <?php
                include('../Assets/Connection/connection.php');
                $selQuery = "select * from tbl_order o 
                inner join tbl_cart cr on o.cart_id=cr.cart_id inner join tbl_plant p
                on p.plant_id=cr.plant_id inner join tbl_shop s on s.shop_id=p.shop_id
                 where order_status = 0 and s.shop_id=" . $data['shop_id'];
                $result = $conn->query($selQuery);
                echo $result->num_rows;
                ?>
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-xl-4" onclick="window.location='./ShopConfirmOrder.php'">
            <div class="h-100 rounded p-4" style="background:#fff;">
              <h1 style="color: #548302;text-align: center;">Confirmed Orders</h1>
              <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                <?php
                include('../Assets/Connection/connection.php');
                $selQuery = "select * from tbl_order o 
                inner join tbl_cart cr on o.cart_id=cr.cart_id inner join tbl_plant p
                on p.plant_id=cr.plant_id inner join tbl_shop s on s.shop_id=p.shop_id
                 where o.order_status = 1 and s.shop_id=" . $data['shop_id'];
                $result = $conn->query($selQuery);
                echo $result->num_rows;
                ?>
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-xl-4" onclick="window.location='./ShopDeliveredOrder.php'">
            <div class="h-100 rounded p-4" style="background:#fff;">
              <h1 style="color: #548302;text-align: center;">Delivered Orders</h1>
              <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                <?php
                include('../Assets/Connection/connection.php');
                $selQuery = "select * from tbl_order o 
                inner join tbl_cart cr on o.cart_id=cr.cart_id inner join tbl_plant p
                on p.plant_id=cr.plant_id inner join tbl_shop s on s.shop_id=p.shop_id
                 where o.order_status=2
                 and s.shop_id=" . $data['shop_id'];
                $result = $conn->query($selQuery);
                echo $result->num_rows;
                ?>
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-xl-4" onclick="window.location='./ShopCanceledOrder.php'">
            <div class="h-100 rounded p-4" style="background:#fff;">
              <h1 style="color: #548302;text-align: center;">Canceled Orders</h1>
              <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                <?php
                include('../Assets/Connection/connection.php');
                $selQuery = "select * from tbl_order o 
                inner join tbl_cart cr on o.cart_id=cr.cart_id inner join tbl_plant p
                on p.plant_id=cr.plant_id inner join tbl_shop s on s.shop_id=p.shop_id
                 where o.order_status=3  and 
                 s.shop_id=" . $data['shop_id'];
                $result = $conn->query($selQuery);
                echo $result->num_rows;
                ?>
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 rounded p-4" style="background:#fff;">
              <h1 style="color: #548302;text-align: center;">Total Plants</h1>
              <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                <?php
                include('../Assets/Connection/connection.php');
                $selQuery = "select * from tbl_plant where shop_id=" . $data['shop_id'];
                $result = $conn->query($selQuery);
                echo $result->num_rows;
                ?>
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 rounded p-4" style="background:#fff;">
              <h1 style="color: #548302;text-align: center;">Total Earnings</h1>
              <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                &#8377;
                <?php
                include('../Assets/Connection/connection.php');
                $selQuery = "select * from tbl_order o 
                inner join tbl_cart cr 
                on o.cart_id=cr.cart_id
                inner join tbl_plant p on p.plant_id=cr.plant_id
                 where p.shop_id=" . $data['shop_id'] . " and o.order_status=2";
                $result = $conn->query($selQuery);
                $amount = 0;
                while ($row = $result->fetch_assoc()) {
                  $amount += $row["cart_quantity"] * $row["plant_price"];
                }
                echo $amount;
                ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Widget End -->

      <?php include("../Assets/components/ShopFeedback.php"); ?>
    </div>
    <!-- Content End -->


  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/chart/chart.min.js"></script>
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/easing/easing.min.js"></script>
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/waypoints/waypoints.min.js"></script>
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/moment.min.js"></script>
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/moment-timezone.min.js"></script>
  <script
    src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Template Javascript -->
  <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//js/main.js"></script>
  <script src="../Assets//JS//Admin//HideViewShop.js"></script>
  <script src="../Assets//JS//Ajax//jQuery.js"></script>
  <script>
    function viewShop(shopId) {
      $.ajax({
        url: '../Assets//AjaxPages//AjaxRequestedShop.php?shopId=' + shopId,
        success: function (data) {
          $('#viewRequestedshop').html(data);
        }
      });
    }

    function viewAcceptedShop(shopId) {
      $.ajax({
        url: '../Assets//AjaxPages//AjaxAcceptedShop.php ?shopId=' + shopId,
        success: function (data) {
          $('#viewAcceptedshop').html(data);
        }
      });
    }
  </script>
  <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>