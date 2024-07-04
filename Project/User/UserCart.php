<?php
ob_start();
session_start();
include("../Assets/Connection/connection.php");
ini_set('memory_limit', '44M');
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

if (isset($_GET['crid'])) {
    $cartId = $_GET['crid'];
    $itemCount = $_GET['itemcount'];
    $upQuery = "update tbl_cart set cart_quantity=" . $itemCount . " where cart_id=" . $cartId;
    if ($conn->query($upQuery)) {
        ?>
        <script>
            window.location = './UserCart.php'
        </script>
        <?php
    }
}

if (isset($_GET["delcid"])) {
    $delQuery = "delete from tbl_cart where cart_id=" . $_GET['delcid'];
    if ($conn->query($delQuery)) {
        ?>
        <script>
            alert('Removed from cart')
            window.location = './UserCart.php'
        </script>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GREENCART-User Cart</title>
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

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    
    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">
</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">


        <?php include('../Assets/components/User/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">
           
        <?php include('../Assets/components/User/NavBarOthers.php') ?>

            <div class="row" style="margin: 0.5em;margin-top: 1em;">
                <div class="col-lg-9">
                    <div class="card border shadow-0">
                        <div class="m-4">
                            <h4 class="card-title mb-4" style="color: #548302;">My shopping cart</h4>

                            <?php
                            $selQueryCr = "select * from tbl_cart cr 
                            inner join tbl_plant p on cr.plant_id=p.plant_id 
                            inner join tbl_plant_category c on p.plant_category_id=c.plant_category_id 
                            where cr.user_id =" . $data['user_id'] . " and cr.cart_del_status=false";
                            $resultCr = $conn->query($selQueryCr);
                            $totalPrice = 0;
                            if ($resultCr->num_rows) {
                                while ($rowCr = $resultCr->fetch_assoc()) {
                                    ?>
                                    <div class="row gy-3 mb-4">
                                        <div class="col-lg-5">
                                            <div class="me-lg-5">
                                                <div class="d-flex">
                                                    <img src="../Assets//Files//Plant//<?php echo $rowCr['plant_photo'] ?>"
                                                        class="border rounded me-3" style="width: 96px; height: 96px;" />
                                                    <div class="">
                                                        <a href="#" class="nav-link" style="color: #025283; font-weight: 600;">
                                                            <?php echo $rowCr['plant_name'] ?>
                                                        </a>
                                                        <p class="text-muted">
                                                            <?php echo $rowCr['plant_category_name'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                                            <div class="">
                                                <select
                                                    style="width: 100px; background: none; height: 2em;border-radius: 0.5em;"
                                                    class=" me-4"
                                                    onchange="calcPrice(<?php echo $rowCr['cart_id'] ?>,this.value)">
                                                    <?php
                                                    $i = 1;
                                                    $selQuery = "select * from tbl_plant where plant_id =" . $rowCr['plant_id'] . "";
                                                    $num = 10;
                                                    while ($i <= $num) {
                                                        if ($i == $rowCr['cart_quantity']) {
                                                            ?>
                                                            <option value=<?php echo $i ?> selected><?php echo $i ?></option>
                                                            <?php
                                                        } else {

                                                            ?>
                                                            <option value=<?php echo $i ?>><?php echo $i ?></option>
                                                            <?php
                                                        }
                                                        $i++;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="">
                                                <text class="h6 " id="countPrice" style="color: #025283;">
                                                    Rs.
                                                    <?php
                                                    $currentPrice = $rowCr['plant_price'] * $rowCr['cart_quantity'];
                                                    echo $currentPrice;
                                                    ?>
                                                </text> <br />
                                                <small class="text-nowrap" style="color: #373837;">Rs.
                                                    <?php echo $rowCr['plant_price'] ?> / per item
                                                </small>
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                                            <div class="float-md-end">
                                                <a href="./UserCart.php?delcid=<?php echo $rowCr['cart_id'] ?>"
                                                    class="btn btn-light border text-danger icon-hover-danger"
                                                    style="background: #d7e6d3;"> Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $totalPrice += $currentPrice;
                                }
                            } else {
                                ?>
                                <p>Empty results</p>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <?php
                    if ($cartCount !== 0) {
                        ?>
                        <div class="card shadow-0 border">
                            <div class="card-body">
                                <div class="d-flex justify-content-between" style="color: #373837;">
                                    <p class="mb-2">Total price:</p>
                                    <p class="mb-2">Rs.
                                        <?php echo $totalPrice ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between" style="color: #373837;">
                                    <p class="mb-2">TAX:</p>
                                    <p class="mb-2">Rs. 20</p>
                                </div>
                                <hr />
                                <div class="d-flex justify-content-between" style="color: #373837;">
                                    <p class="mb-2">Total price:</p>
                                    <p class="mb-2 fw-bold">Rs.
                                        <?php echo $totalPrice + 20 ?>
                                    </p>
                                </div>

                                <div class="mt-3">
                                    <a href="./UserPayment.php" class="btn btn-success w-100 shadow-0 mb-2"> Make Purchase
                                    </a>
                                    <a href="./UserHomepage.php" class="btn btn-light w-100 border mt-2"> Back to shop </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
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
    <script>
        function calcPrice(crId, itemcount) {
            window.location = './UserCart.php?crid=' + crId + '&itemcount=' + itemcount;
        }
    </script>
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>