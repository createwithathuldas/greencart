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

if (isset($_POST['btn_save'])) {
    $complaint_type = $_POST['txt_complaint_type'];
    $complaint_type_status = $_POST['radio_complaint_type_status'];
    $selQuery = "select * from tbl_complaint_type where complaint_type_name ='$complaint_type' ";
    $result = $conn->query($selQuery);
    $data = $result->fetch_assoc();
    if ($data) {
        if ($data['complaint_type_del_status'] == 0) {
            ?>
            <script>
                alert('Already exists');
                window.location = '../Admin/AdminComplaintType.php';
            </script>
            <?php
        } else {
            $upQuery = "update tbl_complaint_type set complaint_type_del_status=0 where complaint_type_id = " . $data['complaint_type_id'];
            if ($conn->query($upQuery)) {
                ?>
                <script>
                    alert("Saved successfully");
                    window.location = '../Admin/AdminComplaintType.php';
                </script>
                <?php
            }
        }
    } else {

        $insQuery = "insert into tbl_complaint_type (complaint_type_name,complaint_type_status) values('$complaint_type',$complaint_type_status)";
        if ($conn->query($insQuery)) {
            ?>
            <script>
                alert("Saved successfully");
                window.location = '../Admin/AdminComplaintType.php';
            </script>
            <?php
        }
    }
}

if (isset($_GET['ctid'])) {
    $selQuery = "select * from tbl_complaint cp inner join tbl_complaint_type ct on cp.complaint_type_id = ct.complaint_type_id where ct.complaint_type_id = " . $_GET['ctid'] . "";
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        $upQuery = "update tbl_complaint_type set complaint_type_del_status =1";
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert("Deleted successfully");
                window.location = '../Admin/AdminComplaintType.php';
            </script>
            <?php
        }
    }else {
        $upQuery = "delete from tbl_complaint_type where complaint_type_id = " . $_GET['ctid'];
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert("Deleted successfully");
                window.location = '../Admin/AdminComplaintType.php';
            </script>
            <?php
        }
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
    <title>GREENCART - Admin Complaint type</title>
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


            <!-- Sign Up Start -->
            <form action="" method="post">
                <div class="container-fluid">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4" style="width:90%;">
                            <div class=" rounded p-4 p-sm-5 my-4 mx-3" style="background:#548302;">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingText" placeholder="jhondoe"
                                        style="background: #fff;" name="txt_complaint_type">
                                    <label for="floatingText">Enter complaint type</label>
                                </div>

                                <div style="background: #fff;margin-bottom: 1em;text-align: center;"
                                    class="rounded p-2">
                                    <input style="accent-color:  #548302;width: 1.2em;height: 1.2em;" type="radio"
                                        name="radio_complaint_type_status" required value="1" id="">
                                    Website based
                                    <input style="accent-color:  #548302;width: 1.2em;height: 1.2em;margin-left: 3em;"
                                        type="radio" name="radio_complaint_type_status" required value="2" id="">
                                    Shop based
                                </div>
                                <button type="submit" class="btn  py-3 w-100 mb-4"
                                    style="color: #fff; background:  #273d01;" name="btn_save">
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
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Complaint Types</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Complaint type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_complaint_type";
                                $result = $conn->query($selQuery);
                                $count = $result->num_rows;
                                $tempCount = 0;
                                if ($result->num_rows) {
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++;
                                        if ($row['complaint_type_del_status'] == false) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['complaint_type_name'] ?>
                                                </td>
                                                <td><a class="btn btn-sm btn-primary"
                                                        href="./AdminComplaintType.php?ctid=<?php echo $row['complaint_type_id'] ?>">Delete</a>
                                                </td>
                                            </tr>
                                            <?php

                                        } else {
                                            $tempCount++;
                                        }
                                    }
                                    if ($tempCount == $count) {
                                        ?>
                                        <tr>
                                            <th colspan="4" style="text-align: center;">No data available</th>
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

</body>

</html>

<?php ob_flush(); ?>