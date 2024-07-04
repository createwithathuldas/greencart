<?php
ob_start();
session_start();
include("../Assets/Connection/connection.php");
if (!$_SESSION['admin_id']) {
    ?>
    <script>
        window.location = '../index.php'
    </script>
    <?php
}

$selQuery = "select * from tbl_admin where admin_id =" . $_SESSION['admin_id'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();

if (isset($_GET['Ashopid'])) {
    $upQuery = "update tbl_shop set shop_status=1 where shop_id=" . $_GET['Ashopid'];
    if ($conn->query($upQuery)) {
        ?>
        <script>
            alert('Shop accepted');
            window.location = './AdminHomePage.php';
        </script>
        <?php
    }
}

if (isset($_GET['Rshopid'])) {
    $upQuery = "update tbl_shop set shop_status=2 where shop_id=" . $_GET['Rshopid'];
    if ($conn->query($upQuery)) {
        ?>
        <script>
            alert('Shop rejected');
            window.location = './AdminHomePage.php';
        </script>
        <?php
    }
}

if (isset($_POST['btn_logout'])) {
    unset($_SESSION['admin_id']);
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
    <title>GREENCART-Admin HomePage</title>
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
</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">

        <?php include('../Assets/components/Admin/SideBar.php') ?>

        <!-- Content Start -->
        <div class="content" style="background: #548302;">


            <?php include('../Assets/components/Admin/NavBar.php') ?>


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 rounded p-4" style="background:#fff;">
                            <h1 style="color: #548302;text-align: center;">Shops</h1>
                            <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                                <?php
                                include('../Assets/Connection/connection.php');
                                $selQuery = "select * from tbl_shop";
                                $result = $conn->query($selQuery);
                                echo $result->num_rows;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 rounded p-4" style="background:#fff;">
                            <h1 style="color: #548302;text-align: center;">Users</h1>
                            <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                                <?php
                                include('../Assets/Connection/connection.php');
                                $selQuery = "select * from tbl_user";
                                $result = $conn->query($selQuery);
                                echo $result->num_rows;
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 rounded p-4" style="background:#fff;">
                            <h1 style="color: #548302;text-align: center;">Plants</h1>
                            <p style="text-align: center; font-size: 24pt;font-weight: bold;">
                                <?php
                                include('../Assets/Connection/connection.php');
                                $selQuery = "select * from tbl_plant";
                                $result = $conn->query($selQuery);
                                echo $result->num_rows;
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
      

          
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Requested Shops</h6>
                    </div>
                    <div
                        style="border-radius: 0.8em; border-left: 0.3em solid #548302;border-top: 0.3em solid #548302; border-right: 0.3em solid #548302;border-bottom: 0.3em solid #548302;padding-top:1em;padding-left:1em;padding-right:1em;">
                        <select name="sel_shop" onchange="viewShop(this.value)" class="form-select form-select-lg mb-3"
                            style="background: #fff; color: #548302; text-align: center;border: none;">
                            <option value="0">------Select shop------</option>
                            <?php
                            $selQuery = "select * from tbl_shop where shop_status=0";
                            $result = $conn->query($selQuery);
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <option style="background: #fff;color: #548302;" value="<?php echo $row['shop_id'] ?>">
                                    <?php echo $row['shop_name'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
       

            <div class="container-fluid pt-4 px-4" id="viewRequestedshop">
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Accepted Shops</h6>
                    </div>
                    <div
                        style="border-radius: 0.8em; border-left: 0.3em solid #548302;border-top: 0.3em solid #548302; border-right: 0.3em solid #548302;border-bottom: 0.3em solid #548302;padding-top:1em;padding-left:1em;padding-right:1em;">
                        <select name="sel_district" onchange="viewAcceptedShop(this.value)"
                            class="form-select form-select-lg mb-3"
                            style="background: #fff; color: #548302; text-align: center;border: none;">
                            <option value="0">------Select shop------</option>
                            <?php
                            $selQuery = "select * from tbl_shop where shop_status=1";
                            $result = $conn->query($selQuery);
                            while ($row = $result->fetch_assoc()) {
                                ?>

                                <option style="background: #fff;color: #548302;" value="<?php echo $row['shop_id'] ?>">
                                    <?php echo $row['shop_name'] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
      

            <div class="container-fluid pt-4 px-4" id="viewAcceptedshop">
            </div>



            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Rejected Shops</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_shop s inner join tbl_city p on s.city_id=p.city_id inner join tbl_district d on p.district_id=d.district_id where shop_status = 2";
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
                                                <?php echo $row['shop_name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['shop_address'] ?><br>
                                                <?php echo $row['shop_pincode'] ?><br>
                                                <?php echo $row['city_name'] ?><br>
                                                <?php echo $row['district_name'] ?>
                                            </td>
                                            <td>
                                                Tel:
                                                <?php echo $row['shop_contactno'] ?><br>
                                                Email: <a href="mailto: <?php echo $row['shop_email'] ?>" style="color: blue;">
                                                    <?php echo $row['shop_email'] ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php

                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <th colspan="4" style="text-align: center;">No data available</th>
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