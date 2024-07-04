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


if (isset($_POST['pay-btn'])) {
    ?>
    <script>
        alert('Payment completed');
        window.location = './userPlaceOrder.php'
    </script>
    <?php
}

$selQueryC = "select * from tbl_cart where user_id =" . $data['user_id'] . " and cart_del_status=false";
$resultC = $conn->query($selQueryC);
$cartCount = $resultC->num_rows;

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

    <link rel="stylesheet" href="../Assets//CSS//User//UserPayment.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">
</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">



        <?php include('../Assets/components/User/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

        <?php include('../Assets/components/User/NavBarOthers.php') ?>

            <div class='container'>
                <div class='window'>
                    <div class='order-info' style="padding-top: 30%;">
                        <?php
                        $selQueryCr = "select * from tbl_cart cr inner join tbl_plant p on cr.plant_id=p.plant_id inner join tbl_plant_category c on p.plant_category_id=c.plant_category_id left join tbl_shop s on s.shop_id=p.shop_id where cr.user_id =" . $data['user_id'] . " and cr.cart_del_status = false";
                        $resultCr = $conn->query($selQueryCr);
                        $totalPrice = 0;
                        if ($resultCr->num_rows) {
                            while ($rowCr = $resultCr->fetch_assoc()) {

                                $currentPrice = $rowCr['plant_price'] * $rowCr['cart_quantity'];

                                $totalPrice += $currentPrice;
                                ;
                            }
                        }
                        ?>
                        <h4 style="color: #000;">Total Price(include tax)<br>Rs.
                            <?php echo $totalPrice + 20 ?>
                        </h4>
                    </div>
                    <div class='credit-info'>
                        <div class='credit-info-content'>
                            <form action="" method="post">
                                <table class='half-input-table'>
                                    <tr>
                                        <td>Please select your card: </td>
                                        <td>
                                            <div class='dropdown' id='card-dropdown'>
                                                <div class='dropdown-btn' id='current-card'>Visa</div>
                                                <div class='dropdown-select'>
                                                    <ul>
                                                        <li>Master Card</li>
                                                        <li>Rupay</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <img src='../Assets//Img//Payment//Visa.png' height='80' class='credit-card-image'
                                    id='credit-card-image'></img>
                                Card Number
                                <input class='input-field' required></input>
                                Card Holder
                                <input class='input-field' required></input>
                                <table class='half-input-table'>
                                    <tr>
                                        <td> Expires
                                            <input class='input-field' required></input>
                                        </td>
                                        <td>CVC
                                            <input class='input-field' required></input>
                                        </td>
                                    </tr>
                                </table>
                                <button class='pay-btn' name="pay-btn" type="submit">Checkout</button>
                            </form>
                        </div>

                    </div>
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
    <script src="../Assets//JS//User//UserPayment.js"></script>
    
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>