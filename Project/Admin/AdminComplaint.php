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



if (isset($_POST['btn_logout'])) {
    unset($_SESSION['admin_id']);
    ?>
    <script>
        window.location = '../index.php';
    </script>
    <?php
}

if (isset($_GET['cidD'])) {
    $selQuery = "select * from tbl_admin_complaint where admin_complaint_del_status=2 and admin_complaint_id =" . $_GET['cidD'];
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        $delQuery = "delete from tbl_admin_complaint where admin_complaint_id =" . $_GET['cidD'];
        if ($conn->query($delQuery)) {
            ?>
            <script>
                alert('complaint deleted')
                window.location = './AdminComplaint.php';
            </script>
            <?php
        }
    } else {
        $upQuery = "update tbl_admin_complaint set admin_complaint_del_status=1 where admin_complaint_id =" . $_GET['cidD'];
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('complaint deleted')
                window.location = './AdminComplaint.php';
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
    <title>GREENCART- Admin Complaints</title>
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
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Complaints</h6>
                    </div>
                    <div class="mb-4">
                        <input type="radio" onclick="ViewUserOrShopComplaints(this.value)" id="" value="1"
                            name="radio_userOrshop" class="form-check-input" checked>
                        <label class="form-check-label" for="flexRadioDefault1" style="padding-right: 2em;">
                            User
                        </label>
                        <input type="radio" onclick="ViewUserOrShopComplaints(this.value)" id="" value="2"
                            name="radio_userOrshop" class="form-check-input">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Shop
                        </label>
                    </div>
                    <div class="table-responsive" id="ViewUserOrShopComplaints">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Complaint</th>
                                    <th scope="col">Complaint type</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Reply</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_admin_complaint ac inner join tbl_complaint_type ct
                                on ac.complaint_type_id=ct.complaint_type_id 
                                left join tbl_user u on ac.user_id=u.user_id
                                 where admin_complaint_del_status != 1 and shop_id=0";
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
                                            <?php echo $row['admin_complaint_content'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['complaint_type_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['user_name'] ?>
                                        </td>
                                        <td>
                                            <?php

                                            $currentTime = $row['admin_complaint_time'];
                                            $time = date_format(date_create($currentTime), 'd-m-Y | h:i a');
                                            echo $time;
                                            ?>
                                        </td>
                                        <td>
                                            <textarea style="border: none;outline: none;" name="txt_admin_complaint_reply" id=""
                                                cols="30" rows="5" placeholder="Add Reply"
                                                oninput="addReply(<?php echo $row['admin_complaint_id'] ?>,this.value)"><?php echo $row['admin_complaint_reply'] ?></textarea>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="./AdminComplaint.php?cidD=<?php echo $row['admin_complaint_id'] ?>">Delete</a>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <th colspan="7" style="text-align: center;">No data available</th>
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


    <script>
        function ViewUserOrShopComplaints(value) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxUserOrShopComplaint.php?value=' + value,
                success: function (result) {
                    $("#ViewUserOrShopComplaints").html(result);
                }
            });
        }

        function addReply(aCid, aReply) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxAdminComplaintReply.php?aCid=' + aCid + '&&aReply=' + aReply,
            });
        }

    </script>

</body>

</html>

<?php ob_flush(); ?>