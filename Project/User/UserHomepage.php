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



$selQuery = "select * from tbl_user where user_id=" . $_SESSION['uid'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();


$selQueryC = "select * from tbl_cart where user_id =" . $data['user_id'] . " and cart_del_status=false";
$resultC = $conn->query($selQueryC);
$cartCount = $resultC->num_rows;

$selQueryPlant = "select * from tbl_plant p inner join tbl_plant_category c on p.plant_category_id = c.plant_category_id left join tbl_shop s on s.shop_id = p.shop_id";

$search_name = '';

if (isset($_SESSION['sel_query'])) {
    $selQueryPlant = $_SESSION['sel_query'];
    if (isset($_SESSION['search_name'])) {
        $search_name = $_SESSION['search_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GREENCART-User HomePage</title>
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

    <!-- <link rel="stylesheet" href="../Assets/"> -->

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">

</head>

<body style="background: #548302;" onload="openFilter()">
    <div class="container-fluid position-relative d-flex p-0">


        <?php include('../Assets/components/User/SideBar.php') ?>

        <!-- Content Start -->
        <div class="content" style="background: #548302;">

            <?php include('../Assets/components/User/NavBarHome.php') ?>


            <!-- view plant -->
            <!-- <div class="container py-5"> -->
            <div id="viewplant">
                <?php

                $result = $conn->query($selQueryPlant);
                if ($result->num_rows) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <!-- <div class="row justify-content-center mb-3"> -->
                        <!-- <div class="col-md-12 col-xl-10"> -->
                        <div class="card shadow-0  rounded-3" style="margin: 0.5em;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            <img src="../Assets//Files//Plant//<?php echo $row['plant_photo'] ?>"
                                                class="w-100"  />
                                            <a href="#!">
                                                <div class="hover-overlay">
                                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <h5 style="color: #830202;">
                                            <?php echo $row['plant_name'] ?>
                                        </h5>
                                        <div class="d-flex flex-row">
                                            <div class="text-danger mb-1 me-2">
                                                <?php
                                                include('../Assets/components/RatingStar.php');
                                                ?>
                                            </div>
                                            &nbsp;
                                            <span style="padding-top: 0.2em;color: #023683;">
                                                <?php
                                                $selQuerycount = $selQuery5 = "select * from tbl_plant_rating where plant_id=" . $row['plant_id'];
                                                $resultcount = $conn->query($selQuerycount);
                                                echo $resultcount->num_rows . " Reviews";
                                                ?>
                                            </span>
                                        </div>
                                        <div class="mt-1 mb-0 text-muted small">
                                            <span style="color: #833602;">
                                                <?php echo $row['plant_category_name'] ?>
                                            </span>
                                        </div>
                                        <div class="mb-2 text-muted small">
                                        </div>
                                        <p class="text-truncate mb-4 mb-md-0" style="color: #2b2b2b;">
                                            <?php echo $row['plant_description'] ?>
                                        </p><br>
                                        <?php
                                        if ($row['plant_stock'] == 0) {
                                            ?>
                                            <p class="text-danger" style="font-weight: 800;">Out of stock</p>
                                            <?php
                                        } else {
                                            ?>
                                            <p style="color: #548302; font-weight: 800;">In stock</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-xl-3 " style="border-left: solid 1px #548302;">
                                        <div class="d-flex flex-row align-items-center mb-1">
                                            <h4 class="mb-1 me-1" style="color: #02835c;">&#8377;&nbsp;
                                                <?php echo $row['plant_price'] ?> /-
                                            </h4>
                                            <!-- <span class="text-danger"><s>$20.99</s></span> -->
                                        </div>
                                        <!-- <h6 class="text-success">Free shipping</h6> -->
                                        <div class="d-flex flex-column mt-4">
                                            <a href="./UserPlantViewMore.php?plant_view_id=<?php echo $row['plant_id'] ?>"
                                                class="btn  btn-sm" type="button" style="background: #748302;color: #fff;">
                                                Buy / View more
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <!-- </div> -->
                        <?php
                    }
                } else {
                    $selQueryPlant = "select * from tbl_plant p inner join tbl_plant_category c on p.plant_category_id = c.plant_category_id left join tbl_shop s on s.shop_id = p.shop_id";
                    $result = $conn->query($selQueryPlant);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <!-- <div class="row justify-content-center mb-3"> -->
                        <!-- <div class="col-md-12 col-xl-10"> -->
                        <div class="card shadow-0  rounded-3" style="margin: 0.5em;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            <img src="../Assets//Files//Plant//<?php echo $row['plant_photo'] ?>"
                                                class="w-100" />
                                            <a href="#!">
                                                <div class="hover-overlay">
                                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);">
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <h5 style="color: #830202;">
                                            <?php echo $row['plant_name'] ?>
                                        </h5>
                                        <div class="d-flex flex-row">
                                            <div class="text-danger mb-1 me-2">
                                                <?php
                                                include('../Assets/components/RatingStar.php');
                                                ?>
                                            </div>
                                            &nbsp;
                                            <span style="padding-top: 0.2em;color: #023683;">
                                                <?php
                                                $selQuerycount = $selQuery5 = "select * from tbl_plant_rating where plant_id=" . $row['plant_id'];
                                                $resultcount = $conn->query($selQuerycount);
                                                echo $resultcount->num_rows . " Reviews";
                                                ?>
                                            </span>
                                        </div>
                                        <div class="mt-1 mb-0 text-muted small">
                                            <span style="color: #833602;">
                                                <?php echo $row['plant_category_name'] ?>
                                            </span>
                                        </div>
                                        <div class="mb-2 text-muted small">
                                        </div>
                                        <p class="text-truncate mb-4 mb-md-0" style="color: #2b2b2b;">
                                            <?php echo $row['plant_description'] ?>
                                        </p><br>
                                        <?php
                                        if ($row['plant_stock'] == 0) {
                                            ?>
                                            <p class="text-danger" style="font-weight: 800;">Out of stock</p>
                                            <?php
                                        } else {
                                            ?>
                                            <p style="color: #548302; font-weight: 800;">In stock</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-lg-3 col-xl-3 " style="border-left: solid 1px #548302;">
                                        <div class="d-flex flex-row align-items-center mb-1">
                                            <h4 class="mb-1 me-1" style="color: #02835c;">&#8377;&nbsp;
                                                <?php echo $row['plant_price'] ?> /-
                                            </h4>
                                            <!-- <span class="text-danger"><s>$20.99</s></span> -->
                                        </div>
                                        <!-- <h6 class="text-success">Free shipping</h6> -->
                                        <div class="d-flex flex-column mt-4">
                                            <a href="./UserPlantViewMore.php?plant_view_id=<?php echo $row['plant_id'] ?>"
                                                class="btn  btn-sm" type="button" style="background: #748302;color: #fff;">
                                                Buy / View more
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        <!-- </div> -->
                        <?php
                    }
                }
                ?>
            </div>
            <!-- </div> -->
            <!-- view plant -->

            <?php include("../Assets/components/UserFeedback.php"); ?>


        </div>
        <!-- Content End -->

        <?php
        include('../Assets/components/FilterModel.php');
        ?>

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


    <?php
    if (isset($_SESSION['ftr'])) {
        ?>
        <script type="text/javascript">
            $(window).on('load', function () {
                $('#exampleModalCenter').modal('show');
            });
        </script>
        <?php
    }
    unset($_SESSION['ftr']);
    ?>


    <?php include('../Assets/components/User/ViewPlantJs.php') ?>

    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>