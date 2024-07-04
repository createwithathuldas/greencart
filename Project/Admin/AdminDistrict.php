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
    $district = $_POST['txt_district'];
    $selQuery = "select * from tbl_district where district_name ='$district' ";
    $result = $conn->query($selQuery);
    $data = $result->fetch_assoc();
    if ($data) {
        if ($data['district_del_status'] == false) {
            ?>
            <script>
                alert('Already exists');
                window.location = '../Admin/AdminDistrict.php';
            </script>
            <?php
        } else {
            $upQuery = "update tbl_district set district_del_status=false where district_id = " . $data['district_id'];
            if ($conn->query($upQuery)) {
                ?>
                <script>
                    alert("Saved successfully");
                    window.location = '../Admin/AdminDistrict.php';
                </script>
                <?php
            }
        }
    } else {

        $insQuery = "insert into tbl_district (district_name,district_del_status) values('$district',false)";
        if ($conn->query($insQuery)) {
            ?>
            <script>
                alert("Saved successfully");
                window.location = '../Admin/AdminDistrict.php';
            </script>
            <?php
        }
    }
}
if (isset($_GET['did'])) {
    $selQuery = "select * from tbl_city p inner join tbl_district d on p.district_id = d.district_id where d.district_id =" . $_GET['did'];
    $result = $conn->query($selQuery);
    if (!$result->num_rows) {
        $delQuery = "delete from tbl_district where district_id = " . $_GET['did'];
        if ($conn->query($delQuery)) {
            ?>
            <script>
                alert("Deleted successfully");
                window.location = '../Admin/AdminDistrict.php';
            </script>
            <?php
        }
    } else {
        $did = $_GET['did'];
        $upQuery = "update tbl_district set district_del_status=true where district_id =$did";
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert("Deleted successfully");
                window.location = '../Admin/AdminDistrict.php';
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
    <title>GREENCART - Admin District</title>
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
                                    <input type="text" class="form-control" id="floatingText" cityholder="jhondoe"
                                        style="background: #fff;" name="txt_district">
                                    <label for="floatingText">Enter District</label>
                                </div>
                                <button type="submit" class="btn  py-3 w-100 mb-4"
                                    style="color: #fff; background:  #273d01;" name="btn_save">Save</button>
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
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Districts</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_district";
                                $result = $conn->query($selQuery);
                                $count = $result->num_rows;
                                $tempCount = 0;
                                if ($result->num_rows) {
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++;
                                        if ($row['district_del_status'] == false) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['district_name'] ?>
                                                </td>
                                                <td><a class="btn btn-sm btn-primary"
                                                        href="./AdminDistrict.php?did=<?php echo $row['district_id'] ?>">Delete</a>
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