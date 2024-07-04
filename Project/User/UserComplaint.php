<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata');
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

if (isset($_POST['btn_save_complaint'])) {
    $complaint_type = $_POST['sel_complaint_type'];
    $complaint_content = $_POST['txt_complaint_content'];
    $complaint_date = date('Y-m-d H:i:s');
    $selQuery = "select * from tbl_complaint_type where complaint_type_id=" . $complaint_type;
    $result = $conn->query($selQuery);
    $ctData = $result->fetch_assoc();
    if ($ctData['complaint_type_status'] == 1) {
        $insQuery = "insert into tbl_admin_complaint(admin_complaint_content,admin_complaint_time,complaint_type_id,user_id) 
        values('$complaint_content','$complaint_date',$complaint_type," . $data['user_id'] . ")";
        if ($conn->query($insQuery)) {
            ?>
            <script>
                alert('Complaint saved')
                window.location = './UserComplaint.php'
            </script>
            <?php
        }
    } else {
        $shop = $_POST['sel_shop'];
        $insQuery = "insert into tbl_shop_complaint(shop_complaint_content,shop_complaint_time,complaint_type_id,user_id,shop_id) 
        values('$complaint_content','$complaint_date',$complaint_type," . $data['user_id'] . ", $shop)";
        if ($conn->query($insQuery)) {
            ?>
            <script>
                alert('Complaint saved')
                window.location = './UserComplaint.php'
            </script>
            <?php
        }
    }
}

if (isset($_GET['AcidD'])) {
    $selQuery = "select * from tbl_admin_complaint where admin_complaint_del_status=1 and admin_complaint_id =" . $_GET['AcidD'];
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        $delQuery = "delete from tbl_admin_complaint where admin_complaint_id = " . $_GET['AcidD'];
        if ($conn->query($delQuery)) {
            ?>
            <script>
                alert('Complaint deleted')
                window.location = './UserComplaint.php'
            </script>
            <?php
        }
    } else {
        $upQuery = "update tbl_admin_complaint set admin_complaint_del_status=2 where admin_complaint_id = " . $_GET['AcidD'];
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Complaint deleted')
                window.location = './UserComplaint.php'
            </script>
            <?php
        }
    }
}

if (isset($_GET['ScidD'])) {
    $selQuery = "select * from tbl_shop_complaint where shop_complaint_del_status=1 and shop_complaint_id =" . $_GET['ScidD'];
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        $delQuery = "delete from tbl_shop_complaint where shop_complaint_id = " . $_GET['ScidD'];
        if ($conn->query($delQuery)) {
            ?>
            <script>
                alert('Complaint deleted')
                window.location = './UserComplaint.php'
            </script>
            <?php
        }
    } else {
        $upQuery = "update tbl_shop_complaint set shop_complaint_del_status=2 where shop_complaint_id = " . $_GET['ScidD'];
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Complaint deleted')
                window.location = './UserComplaint.php'
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
    <title>GREENCART-User complaint</title>
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

            <!-- Sign Up Start -->
            <form action="" method="post">
                <div class="container-fluid">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4" style="width:90%;">
                            <div class=" rounded p-4 p-sm-5 my-4 mx-3" style="background:#548302;">
                                <div class="form-floating mb-3">
                                    <select name="sel_complaint_type" id="" class="form-select"
                                        style="text-align: center;" onchange="selShop(this.value);">
                                        <option value="">----Select complaint type----</option>
                                        <?php
                                        $selQuery = "select * from tbl_complaint_type";
                                        $result = $conn->query($selQuery);
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['complaint_type_id'] ?>">
                                                <?php echo $row['complaint_type_name'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-floating mb-3" id="viewShop">
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingText" placeholder="jhondoe"
                                        style="background: #fff;" name="txt_complaint_content">
                                    <label for="floatingText">Enter complaint content</label>
                                </div>
                                <button type="submit" class="btn  py-3 w-100 mb-4"
                                    style="color: #fff; background:  #273d01;" name="btn_save_complaint">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Sign Up End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Complaints</h6>
                    </div>
                    <div class="mb-4">
                        <input type="radio" id="" value="1" name="radio_WebOrshop" class="form-check-input" checked
                            onclick="showComplaint(this.value)">
                        <label class="form-check-label" for="flexRadioDefault1" style="padding-right: 2em;">
                            Website based
                        </label>
                        <input type="radio" id="" value="2" name="radio_WebOrshop" class="form-check-input"
                            onclick="showComplaint(this.value)">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Product based
                        </label>
                    </div>
                    <div class="table-responsive" id="viewComplaint">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Complaint</th>
                                    <th scope="col">Complaint type</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Reply</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_admin_complaint ac inner join tbl_complaint_type ct
                                on ac.complaint_type_id=ct.complaint_type_id where shop_id=0 and admin_complaint_del_status != 2";
                                $result = $conn->query($selQuery);
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
                                                <?php echo $row['admin_complaint_content'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['complaint_type_name'] ?>
                                            </td>
                                            <td>
                                                <?php

                                                $currentTime = $row['admin_complaint_time'];
                                                $time = date_format(date_create($currentTime), 'd-m-Y | h:i a');
                                                echo $time;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['admin_complaint_reply'] == "" || $row['admin_complaint_reply'] == null) {
                                                    echo 'No reply';
                                                } else {
                                                    echo $row['admin_complaint_reply'];
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="./UserComplaint.php?AcidD=<?php echo $row['admin_complaint_id'] ?>"
                                                    class="btn btn-primary">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <th colspan="6" style="text-align: center;">No data available</th>
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

    <script>
        function showComplaint(value) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxViewUserComplaint.php?value=' + value,
                success: function (result) {

                    $("#viewComplaint").html(result);
                }
            });
        }

        function selShop(ctId) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxSelShop.php?ctId=' + ctId,
                success: function (result) {

                    $("#viewShop").html(result);
                }
            });
        }
    </script>
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>