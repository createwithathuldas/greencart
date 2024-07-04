<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Kolkata');
include("../Assets/Connection/connection.php");
include("../Assets/components/DaysAgo.php");

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


if (isset($_GET['fid'])) {
    $upQuery = "update tbl_feedback set feedback_status = 1 where feedback_id =" . $_GET['fid'];
    if ($conn->query($upQuery)) {
        ?>
        <script>
            alert('Accepted');
            window.location = '../Admin/AdminFeedback.php';
        </script>
        <?php
    }
}

if (isset($_GET['fidD'])) {
    $upQuery = "delete from tbl_feedback  where feedback_id =" . $_GET['fidD'];
    if ($conn->query($upQuery)) {
        ?>
        <script>
            alert('Deleted');
            window.location = '../Admin/AdminFeedback.php';
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
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <?php include('../Assets/components/Admin/SideBar.php') ?>

        <!-- Content Start -->
        <div class="content" style="background: #548302;">


            <?php include('../Assets/components/Admin/NavBar.php') ?>




            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Feedback</h6>
                    </div>
                    <?php
                    $selQuery = "select * from tbl_feedback f 
                    left join tbl_user u on f.user_id = u.user_id 
                    left join tbl_shop s on f.shop_id = s.shop_id
                    order by f.feedback_time desc";
                    $result = $conn->query($selQuery);
                    $selQuery = "select count(*) from tbl_feedback where feedback_status=1";
                    $resultC = $conn->query($selQuery);
                    $count = 0;
                    while ($value = $resultC->fetch_array()) {
                        $count += $value['count(*)'];
                    }
                    if ($result->num_rows) {
                        ?>
                        <ol class="list-group">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto" style="text-align: left;">
                                        <div class="fw-bold" style="color: #000;">
                                            <?php
                                            if ($row['user_id'] == 0) {
                                                echo $row['shop_name'];
                                            } else {
                                                echo $row['user_name'];
                                            }
                                            ?>
                                        </div>
                                        <br>
                                        <p style="color: #000; opacity: 0.8;">
                                        <?php
                                        if ($row['feedback_rating'] == 0) {
                                            ?>
                                            <span class="px-3 py-2" style="font-size: 34pt; opacity: 1;">&#128577;</span>
                                            <?php
                                        }else if ($row['feedback_rating'] == 1) {
                                            ?>
                                            <span class="px-3 py-2" style="font-size: 34pt; opacity: 1;">&#128528;</span>
                                            <?php
                                        }else{
                                            ?>
                                            <span class="px-3 py-2" style="font-size: 34pt; opacity: 1;">&#128578;</span>
                                            <?php
                                        }
                                        ?>
                                            <sup><i style="color: #000; opacity: 0.8;" class="fa fa-quote-left"
                                                    aria-hidden="true"></i></sup>
                                            <b>&nbsp;
                                                <?php echo $row['feedback_content'] ?>&nbsp;
                                            </b>
                                            <sup><i style="color: #000; opacity: 0.8;" class="fa fa-quote-right"
                                                    aria-hidden="true"></i></sup>
                                        </p>
                                        <?php
                                        if ($row['shop_id'] == 0 && $row['feedback_rating'] == 2 && $row['feedback_status'] != 1 && $count < 5) {
                                            ?>
                                            <button
                                                onclick="window.location='../Admin/AdminFeedback.php?fid=<?php echo $row['feedback_id'] ?>'"
                                                class="btn btn-primary">Accept to Super Feedback</button>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <span class="badge  rounded-pill"
                                        style="background: none; width: 8em;color: rgba(0, 0, 0, 0.8);">
                                        <?php
                                        echo timeAgo(strtotime($row['feedback_time']))
                                            ?> <br><br>
                                        <button class="btn btn-primary"
                                            onclick="window.location='../Admin/AdminFeedback.php?fidD=<?php echo $row['feedback_id'] ?>'">
                                            Delete
                                        </button>
                                    </span>
                                </li>
                                <?php
                            }
                            ?>
                        </ol>
                        <?php
                    } else {
                        ?>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                No Feedbacks
                            </li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!---->

            <br>
            <br>
            <br>
            <br>



        </div>
        <!-- Content End -->


    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
    <script src="../Assets//JS//Ajax//jQuery.js"></script>




</body>

</html>

<?php ob_flush(); ?>