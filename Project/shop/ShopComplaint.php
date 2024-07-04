<?php
ob_start();
session_start();
include("../Assets/Connection/connection.php");
if (!$_SESSION['sid']) {
    ?>
    <script>
        window.location = '../index.php'
    </script>
    <?php
}

$selQuery = "select * from tbl_shop s inner join tbl_city p on s.city_id=p.city_id inner join tbl_district d on p.district_id=d.district_id where shop_id =" . $_SESSION['sid'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();
$_SESSION['city_id'] = $data['city_id'];


if (isset($_POST['btn_logout'])) {
    unset($_SESSION['sid']);
    ?>
    <script>
        window.location = '../index.php';
    </script>
    <?php
}

if (isset($_POST['btn_save_complaint'])) {
    $complaint_type = $_POST['sel_complaint_type'];
    $complaint_content = $_POST['txt_complaint_content'];
    $complaint_date = date('Y-m-d H:i:s');
    $insQuery = "insert into tbl_admin_complaint(admin_complaint_content,admin_complaint_time,complaint_type_id,shop_id) 
    values('$complaint_content','$complaint_date',$complaint_type," . $data['shop_id'] . ")";
    if ($conn->query($insQuery)) {
        ?>
        <script>
            alert('Complaint saved')
            window.location = './ShopComplaint.php';
        </script>
        <?php
    }
}


if (isset($_GET['cidD'])) {
    $selQuery = "select * from tbl_admin_complaint where admin_complaint_del_status=1 and admin_complaint_id=" . $_GET['cidD'];
    $result = $conn->query($selQuery);
    if ($result->num_rows) {
        $delQuery = "delete from tbl_admin_complaint where admin_complaint_id=" . $_GET['cidD'];
        if ($conn->query($delQuery)) {
            ?>
            <script>
                alert('Complaint deleted')
                window.location = './ShopComplaint.php';
            </script>
            <?php
        }
    } else {
        $upQuery = "update tbl_admin_complaint set admin_complaint_del_status=2 where admin_complaint_id=" . $_GET['cidD'];
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Complaint deleted')
                window.location = './ShopComplaint.php';
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
    <title>GREENCART- Shop Complaint</title>
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

    <link rel="stylesheet" href="../Assets/CSS/Shop/ShopChangeProfile.css">

    <link rel="stylesheet" href="../Assets/CSS/Shop/ShopFeedback.css">

</head>

<body style="background: #548302;" onload="mainFun()">
    <div class="container-fluid position-relative d-flex p-0">

        <?php include('../Assets/components/Shop/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

            <?php include('../Assets/components/Shop/NavBar.php') ?>

            <!-- Sign Up Start -->
            <form action="" method="post">
                <div class="container-fluid">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4" style="width:90%;">
                            <div class=" rounded p-4 p-sm-5 my-4 mx-3" style="background:#548302;">
                                <div class="form-floating mb-3">
                                    <select name="sel_complaint_type" id="" class="form-select"
                                        style="text-align: center;">
                                        <option value="">----Select complaint type----</option>
                                        <?php
                                        $selQuery = "select * from tbl_complaint_type where complaint_type_status = 1";
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
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingText" placeholder="Enter complaint content"
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
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Complaint</th>
                                    <th scope="col">Complaint type</th>
                                    <th scope="col">Reply</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_admin_complaint ac inner join tbl_complaint_type ct
                                on ac.complaint_type_id=ct.complaint_type_id where admin_complaint_del_status != 2 and user_id=0";
                                $result = $conn->query($selQuery);
                                $count = $result->num_rows;
                                $tempCount = 0;
                                if ($result->num_rows) {
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++;
                                        ?>
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
                                            if ($row['admin_complaint_reply'] == "" || $row['admin_complaint_reply'] == null) {
                                                echo 'No reply';
                                            }else {
                                                echo $row['admin_complaint_reply'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="./ShopComplaint.php?cidD=<?php echo $row['admin_complaint_id'] ?>"
                                                class="btn btn-primary">Delete</a>
                                        </td>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <th colspan="5" style="text-align: center;">No data available</th>
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
        <?php include("../Assets/components/ShopFeedback.php"); ?>

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

    <script src="../Assets/JS/Shop/ShopChangeProfile.js"></script>

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

        function mainFun() {
            getCity(<?php echo $data['district_id'] ?>)
        }

        function getCity(did) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxChangeProfileCity.php?did=' + did,
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