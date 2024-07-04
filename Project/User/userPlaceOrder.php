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

$selQuery = "select * from tbl_user u 
inner join tbl_city ct on u.city_id=ct.city_id 
inner join tbl_district d on ct.district_id=d.district_id 
where user_id =" . $_SESSION['uid'];
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



if (isset($_POST['btn_submit'])) {
    $selQueryCR = "select * from tbl_cart where user_id =" . $data['user_id'];
    $resultCR = $conn->query($selQueryCR);
    $orderPlace = $_POST['txt_order_place'];
    $orderDate = date('Y-m-d H:i:s');

    while ($rowCR = $resultCR->fetch_assoc()) {
        if ($rowCR['cart_del_status'] == false) {
            $orderNumber = rand(13254078, 982864959);
            $insQuery = "insert into tbl_order(order_number,order_place,order_date,cart_id) values($orderNumber,'$orderPlace','$orderDate'," . $rowCR['cart_id'] . ")";
            if ($conn->query($insQuery)) {
                $upQuery = "update tbl_cart set cart_del_status=true where cart_id = " . $rowCR['cart_id'];
                if ($conn->query($upQuery)) {
                    ?>
                    <script>
                        alert('order placed successfully')
                        window.location = './UserOrders.php'
                    </script>
                    <?php
                }
            }
        }
    }
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





            <section class="d-flex justify-content-center" style="background: #548302;">
                <form class="form-control" style="width:85%;margin-bottom: 5%; background:rgb(255,255,255); padding:5%;"
                    method="post" enctype="multipart/form-data">
                    <p class="h3 text-center" style="color: #548302;">Fill order details</p>
                    <div class="mb-3">
                        <label for="">Name: </label>
                        <input type="text" class="form-control inp" value="<?php echo $data['user_name'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="control-label" for="date">Address</label>
                        <textarea class="form-control  inp" rows="5" readonly
                            required><?php echo $data['user_address'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Pincode: </label>
                        <input type="number" class="form-control inp" value="<?php echo $data['user_pincode'] ?>"
                            required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Place: </label>
                        <input type="text" class="form-control inp" placeholder="Enter Place" name="txt_order_place"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="control-label" for="date" name="sel_district">City</label>
                        <input type="text" class="form-control inp" required value="<?php echo $data['city_name'] ?>"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="control-label" for="date" name="sel_district">District</label>
                        <input type="text" class="form-control inp" required
                            value="<?php echo $data['district_name'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Contact number: </label>
                        <input type="text" class="form-control inp" required
                            value="<?php echo $data['user_contactno'] ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Email: </label>
                        <input type="text" class="form-control inp" required value="<?php echo $data['user_email'] ?>"
                            readonly>
                    </div>
                    <center>
                        <button type="submit" class="btn" style="background: #548302;color:#fff;"
                            name="btn_submit">Place order</button>
                    </center>
                </form>
            </section>
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

    <script>
        function getCity(did) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxCity.php?did=' + did,
                success: function (result) {

                    $("#get_city").html(result);
                }
            });
        }
    </script>
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>