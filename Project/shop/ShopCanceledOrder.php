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

if (isset($_GET['oidD'])) {
  $selQuery = "select * from tbl_order where order_id = " . $_GET['oidD'];
  $result = $conn->query($selQuery);
  $orderData = $result->fetch_assoc();
  $delQueryO = "delete from tbl_order where order_id = " . $_GET['oidD'];
  $delQueryC = "delete from tbl_cart where cart_id = " . $orderData['cart_id'];
  if ($conn->query($delQueryO)) {
    if ($conn->query($delQueryC)) {
      ?>
      <script>
        alert('Deleted')
        window.location = './ShopCanceledOrder.php';
      </script>
      <?php
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>DarkPan - Bootstrap 5 Admin Template</title>
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


      <!-- Recent Sales Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="text-center rounded p-4" style="background: #fff;">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Canceled orders</h6>
          </div>
          <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
              <thead>
                <tr class="" style="color: #548302;">
                  <th scope="col">Sl no</th>
                  <th scope="col">Order Id</th>
                  <th scope="col">Plant</th>
                  <th scope="col">Type</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Payment</th>
                  <th scope="col">User</th>
                  <th scope="col">Address</th>
                  <th scope="col">Contact</th>
                  <th scope="col">Place</th>
                  <th scope="col">City</th>
                  <th scope="col">District</th>
                  <th scope="col">Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $selQuery = "select * from tbl_order o 
                inner join tbl_cart cr on o.cart_id=cr.cart_id 
                left join tbl_user u on cr.user_id=u.user_id 
                inner join tbl_city ct on ct.city_id=u.city_id
                inner join tbl_district d on d.district_id=ct.district_id
                inner join tbl_plant p on cr.plant_id=p.plant_id 
                left join tbl_plant_category c on c.plant_category_id=p.plant_category_id 
                inner join tbl_shop s on s.shop_id=p.shop_id  
                where o.order_status = 3
                 and s.shop_id =" . $data['shop_id'] . " order by o.order_number";
                $result = $conn->query($selQuery);
                $count = $result->num_rows;
                $tempCount = 0;
                if ($result->num_rows) {
                  $i = 0;
                  while ($row = $result->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                      <td>
                        <?php echo $i ?>
                      </td>
                      <td>
                        <?php echo $row['order_number'] ?>
                      </td>
                      <td>
                        <?php echo $row['plant_name'] ?>
                      </td>
                      <td>
                        <?php echo $row['plant_category_name'] ?>
                      </td>
                      <td>
                        <?php echo $row['cart_quantity'] ?>
                      </td>
                      <td style="color: blue;">Completed</td>
                      <td>
                        <?php echo $row['user_name'] ?>
                      </td>
                      <td>
                        <?php echo $row['user_address'] ?><br>
                      </td>
                      <td>
                        <?php echo $row['user_contactno'] ?>
                        <br>
                        <?php echo $row['user_email'] ?>
                      </td>
                      <td>
                        <?php echo $row['order_place'] ?><br>
                      </td>
                      <td>
                        <?php echo $row['city_name'] ?><br>
                      </td>
                      <td>
                        <?php echo $row['district_name'] ?><br>
                      </td>
                      <td>
                        <?php
                        $date = date_create($row['order_date']);
                        echo date_format($date, "d-m-Y");
                        ?>
                      </td>
                      <td align="center">
                        <a href="./ShopCanceledOrder.php?oidD=<?php echo $row['order_id'] ?>"
                          class="btn btn-sm btn-primary">Delete</a>
                      </td>
                    </tr>
                    <?php

                  }
                } else {
                  ?>
                  <tr>
                    <th colspan="14" style="text-align: center;">No data available</th>
                  </tr>
                  <?php
                }

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Recent Sales End -->
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