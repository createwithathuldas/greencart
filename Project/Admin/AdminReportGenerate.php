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
    $selQuery = "select * from tbl_complaint_type where complaint_type_name ='$complaint_type' ";
    $result = $conn->query($selQuery);
    $data = $result->fetch_assoc();
    if ($data) {
        if ($data['complaint_type_del_status'] == false) {
            ?>
            <script>
                alert('Already exists');
                window.location = '../Admin/AdminComplaintType.php';
            </script>
            <?php
        } else {
            $upQuery = "update tbl_complaint_type set complaint_type_del_status=false where complaint_type_id = " . $data['complaint_type_id'];
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

        $insQuery = "insert into tbl_complaint_type (complaint_type_name,complaint_type_del_status) values('$complaint_type',false)";
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
    $selQuery = "select * from tbl_complaint p inner join tbl_complaint_type d on p.complaint_type_id = d.complaint_type_id where d.complaint_type_id =" . $_GET['ctid'];
    $result = $conn->query($selQuery);
    if (!$result->num_rows) {
        $delQuery = "delete from tbl_complaint_type where complaint_type_id = " . $_GET['ctid'];
        if ($conn->query($delQuery)) {
            ?>
            <script>
                alert("Deleted successfully");
                window.location = '../Admin/AdminComplaintType.php';
            </script>
            <?php
        }
    } else {
        $ctid = $_GET['ctid'];
        $upQuery = "update tbl_complaint_type set complaint_type_del_status=true where complaint_type_id =$ctid";
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
                    <button id="button" style="border: none; background: none;">
                        <i class="fa fa-print" style="font-size: 34pt;color: #548302;"></i>
                    </button>

                    <div id="makepdf">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Report</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr class="" style="color: #548302;">
                                        <th scope="col">Sl no</th>
                                        <th scope="col">Plant name</th>
                                        <th scope="col">Plant catagory</th>
                                        <th scope="col">Shop name</th>
                                        <th scope="col">User name</th>
                                        <th scope="col">Purchased date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $selQuery = "select * from tbl_order o 
                                inner join tbl_cart cr on o.cart_id = cr.cart_id
                                inner join tbl_user u on u.user_id = cr.user_id 
                                left join tbl_plant p on p.plant_id = cr.plant_id
                                inner join tbl_plant_category c on c.plant_category_id = p.plant_category_id 
                                left join tbl_shop s on s.shop_id = p.shop_id
                                 where o.order_status =2";
                                    $result = $conn->query($selQuery);
                                    if ($result->num_rows) {
                                        $i = 0;
                                        while ($row = $result->fetch_assoc()) {
                                            $i++;
                                            ?>
                                            <tr style="color: #000;">
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['plant_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['plant_category_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['shop_name'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['user_name'] ?>
                                                </td>
                                                <td>
                                                    <?php

                                                    echo date_format(date_create($row['order_date']), 'd-m-Y');
                                                    ?>
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
    <script src="../Assets//JS//Ajax//jQuery.js"></script>

   
    <script>
        let button = document.getElementById("button");
        let makepdf = document.getElementById("makepdf");

        button.addEventListener("click", function () {
            let mywindow = window.open("", "PRINT",
                "height=400,width=600");

            mywindow.document.write(makepdf.innerHTML);

            mywindow.document.close();
            mywindow.focus();

            mywindow.print();
            mywindow.close();

            return true;
        });
    </script>
</body>

</html>

<?php ob_flush(); ?>