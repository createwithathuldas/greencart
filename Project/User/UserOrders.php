<?php
ob_start();
session_start();
include("../Assets/Connection/connection.php");
if (!$_SESSION['uid']) {
    ?>
    <script>
        window.location = '../index.php'
    </script>
    <?php
}

$selQuery = "select * from tbl_user where user_id =" . $_SESSION['uid'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();


if (isset($_POST['btn_logout'])) {
    unset($_SESSION['uid']);
    unset($_SESSION['sel_query']);
    unset($_SESSION['search_name']);
    unset($_SESSION['ftr']);
    ?>
    <script>
        window.location = '../index.php';
    </script>
    <?php
}




$selQueryC = "select * from tbl_cart where user_id =" . $data['user_id'] . " and cart_del_status=false";
$resultC = $conn->query($selQueryC);
$cartCount = $resultC->num_rows;


if (isset($_GET['oidCl'])) {
    $orderDate = date('Y-m-d H:i:s');

    $upQueryO = "update tbl_order set order_status=3,order_date='$orderDate' where order_id = " . $_GET['oidCl'];
    if ($conn->query($upQueryO)) {

        $selQuery = "select * from tbl_order o
        inner join tbl_cart cr
         on o.cart_id = cr.cart_id
           inner join tbl_plant p
           on p.plant_id = cr.plant_id
            where o.order_status=1
          and o.order_id=" . $_GET['oidCl'];

        $result = $conn->query($selQuery);

        if ($result->num_rows) {

            $plantData = $result->fetch_assoc();

            $upQueryP = "update tbl_plant 
          set plant_stock=(plant_stock+" . $plantData['cart_quantity'] . ") 
          where plant_id=" . $plantData['plant_id'];
            $conn->query($upQueryP);
        }

        ?>
        <script>
            alert('Cancelled');
            window.location = './UserOrders.php';
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GREENCART-User Orders</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
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

    <link rel="stylesheet" href="../Assets//CSS//User//UserPlaceOrder.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">
</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">

        <?php include('../Assets/components/User/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

            <?php include('../Assets/components/User/NavBarOthers.php') ?>

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">My Orders</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Plant</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Shop</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_order o 
                                inner join tbl_cart cr on o.cart_id = cr.cart_id 
                                inner join tbl_plant p on p.plant_id=cr.plant_id 
                                inner join tbl_plant_category c 
                                on c.plant_category_id=p.plant_category_id 
                                left join tbl_shop s 
                                on s.shop_id=p.shop_id 
                                where user_id=" . $data['user_id'] . " order by o.order_date desc";
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
                                                <?php echo $row['plant_name'] ?><br><small>
                                                    <?php echo $row['plant_category_name'] ?>
                                                </small>
                                            </td>
                                            <td>
                                                <img src="../Assets//Files//Plant//<?php echo $row['plant_photo'] ?>"
                                                    style="height: 8em;" />
                                            </td>
                                            <td>
                                                <?php echo $row['cart_quantity'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['shop_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['plant_price'] * $row['cart_quantity'] ?>
                                            </td>
                                            <td style="color: darkblue;">
                                                Payment completed
                                            </td>
                                            <td>
                                                <?php
                                                $date = date_create($row['order_date']);
                                                echo date_format($date, "d-m-Y");
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['order_status'] == 0) {
                                                    ?>
                                                    <p style="color: blue;">Requested</p>
                                                    <?php
                                                } else if ($row['order_status'] == 1) {
                                                    ?>
                                                        <p style="color: blue;">Confirmed</p>
                                                    <?php
                                                } else if ($row['order_status'] == 2) {
                                                    ?>
                                                            <p style="color: purple;">Delivered</p>
                                                    <?php
                                                } else if ($row['order_status'] == 3) {
                                                    ?>
                                                                <p style="color: orangered;">Canceled</p>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button
                                                    onclick="window.location='./UserOrdersViewMore.php?oidV=<?php echo $row['order_id'] ?>'"
                                                    class="btn btn-sm btn-primary" <?php if ($row['order_status'] == 3) { ?>
                                                        disabled <?php } ?>>View more
                                                </button><br><br>
                                                <button
                                                    onclick="window.location='./UserOrders.php?oidCl=<?php echo $row['order_id'] ?>'"
                                                    class="btn btn-sm btn-primary" <?php if ($row['order_status'] == 3 || $row['order_status']==2) { ?>
                                                        disabled <?php } ?>>Cancel order
                                                </button><br><br>
                                                <button
                                                    onclick="window.location='./UserPlantReview.php?pid=<?php echo $row['plant_id'] ?>'"
                                                    class="btn btn-sm btn-primary" <?php if ($row['order_status'] != 2) { ?>
                                                        disabled <?php } ?>>Review
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <th colspan="11" style="text-align: center;">No data available</th>
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
            <?php include("../Assets/components/UserFeedback.php"); ?>
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
    <script
        src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script
        src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//js/main.js"></script>
    <script src="../Assets//JS//Admin//HideViewShop.js"></script>
    <script src="../Assets//JS//Ajax//jQuery.js"></script>
    <script src="../Assets//JS//User//UserPayment.js"></script>


    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>