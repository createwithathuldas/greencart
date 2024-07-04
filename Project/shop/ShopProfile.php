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

if (isset($_POST['btn_save_profile'])) {
    $shop_name = $_POST['txt_shop_name'];
    $shop_address = $_POST['txt_shop_address'];
    $shop_pincode = $_POST['txt_shop_pincode'];
    $shop_city = $_POST['sel_city'];

    $upQuery = "update tbl_shop 
    set shop_name='$shop_name',
    shop_address='$shop_address',
    shop_pincode=$shop_pincode,
    city_id=$shop_city
    where shop_id=" . $data['shop_id'] . "
    ";

    if ($conn->query($upQuery)) {
        ?>
        <script>
            alert('Profile updated')
            window.location = './ShopProfile.php';
        </script>
        <?php
    }
}

if (isset($_POST['btn_save_contactno'])) {
    $shop_contactno = $_POST['txt_shop_contactno'];
    $shop_passw = $_POST['txt_shop_password'];

    if ($shop_passw == $data['shop_password']) {
        $upQuery = "update tbl_shop 
        set shop_contactno='$shop_contactno'
        where shop_id=" . $data['shop_id'] . "
        ";
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Contact number updated')
                window.location = './ShopProfile.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect password')
            window.location = './ShopProfile.php';
        </script>
        <?php
    }

}


if (isset($_POST['btn_save_email'])) {
    $shop_email = $_POST['txt_shop_email'];
    $shop_passw = $_POST['txt_shop_password'];

    if ($shop_passw == $data['shop_password']) {
        $upQuery = "update tbl_shop 
        set shop_email='$shop_email'
        where shop_id=" . $data['shop_id'] . "
        ";
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Email updated')
                window.location = './ShopProfile.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect password')
            window.location = './ShopProfile.php';
        </script>
        <?php
    }
}


if (isset($_POST['btn_save_passw'])) {
    $shop_npassw = $_POST['txt_shop_npassword'];
    $shop_cpassw = $_POST['txt_shop_cpassword'];
    $shop_passw = $_POST['txt_shop_password'];

    if ($shop_passw == $data['shop_password']) {
        if ($shop_npassw == $shop_cpassw) {
            $upQuery = "update tbl_shop 
        set shop_password='$shop_npassw'
        where shop_id=" . $data['shop_id'] . "
        ";
            if ($conn->query($upQuery)) {
                ?>
                <script>
                    alert('Password updated')
                    window.location = './ShopProfile.php';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Password does not match')
                window.location = './ShopProfile.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect password')
            window.location = './ShopProfile.php';
        </script>
        <?php
    }
}


if (isset($_POST['btn_save_shop_photo'])) {
    $time = time() . date('m-d-Y');
    $file_name = $time . $_FILES['file_shop_photo']['name'];
    $tmp_file_name = $_FILES['file_shop_photo']['tmp_name'];
    $old_file = '../Assets/Files/Shop/Photo/' . $data['shop_photo'];

    unlink($old_file);

    $upQuery = "update tbl_shop 
        set shop_photo='$file_name'
        where shop_id=" . $data['shop_id'] . "
        ";
    if ($conn->query($upQuery)) {
        move_uploaded_file($tmp_file_name, '../Assets/Files/shop/Photo/' . $file_name);
        ?>
        <script>
            alert('Profile photo updated')
            window.location = './ShopProfile.php';
        </script>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GREENCART-Shop Profile</title>
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



            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded-3" style="background: #fff;">
                    <div class="row">
                        <form class="col-md-3 border-right" method="post" enctype="multipart/form-data">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <div class="profile-pic">
                                    <label class="-label" for="file">
                                        <span class="glyphicon glyphicon-camera"></span>
                                        <span>Change Photo</span>
                                    </label>
                                    <input id="file" required name="file_shop_photo" type="file"
                                        onchange="loadFile(event)" />
                                    <img src="../Assets//Files//Shop//Photo//<?php echo $data['shop_photo'] ?>"
                                        id="output" width="200" />
                                </div>
                                <span class="font-weight-bold">
                                    <?php echo $data['shop_name'] ?>
                                </span><span class="text-black-50">
                                    <?php echo $data['shop_email'] ?>
                                </span><span> </span>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit" name="btn_save_shop_photo">
                                    Save Profile photo
                                </button>
                            </div>
                        </form>
                        <form class="col-md-5 border-right" method="post">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right" style="color: #548302;">Profile Settings</h4>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">Name</label><br><br>
                                        <input style="background: none;" type="text" class="form-control"
                                            placeholder="Enter name" required value="<?php echo $data['shop_name'] ?>"
                                            name="txt_shop_name">
                                    </div>
                                </div><br>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Address</label><br><br>
                                        <textarea style="background: none;" required type="text" class="form-control"
                                            placeholder="Enter address" value="" rows="6"
                                            name="txt_shop_address"><?php echo $data['shop_address'] ?></textarea>
                                    </div>
                                </div><br>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Pincode</label><br><br>
                                        <input style="background: none;" type="text" required class="form-control"
                                            placeholder="Enter pincode" value="<?php echo $data['shop_pincode'] ?>"
                                            name="txt_shop_pincode">
                                    </div>
                                </div><br>

                                <div class="row mt-3">
                                    <div class="col-md-6"><label class="labels">District</label><br><br>
                                        <select style="background: none;" class="form-select" required
                                            name="sel_district" onChange="getCity(this.value)">
                                            <?php
                                            $selQuery = "select * from tbl_district";
                                            $result = $conn->query($selQuery);
                                            while ($row = $result->fetch_assoc()) {
                                                if ($row['district_id'] == $data['district_id']) {
                                                    ?>
                                                    <option value=<?php echo $row['district_id']; ?> selected>
                                                        <?php echo $row['district_name']; ?>
                                                    </option>
                                                    <?php
                                                    continue;
                                                }
                                                ?>
                                                <option value=<?php echo $row['district_id']; ?>>
                                                    <?php echo $row['district_name']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="get_city"></div>
                                    </div>
                                </div><br>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit"
                                        name="btn_save_profile">Save Profile Details</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-4">
                            <form class="p-3 py-5" method="post">
                                <div class="d-flex justify-content-between align-items-center experience">
                                    <span><b>Change Contact number</b></span>
                                    <span class="px-3 p-1 add-experience">
                                    </span>
                                </div><br>
                                <div class="col-md-12">
                                    <label class="labels">Contact number</label><br><br>
                                    <input type="text" class="form-control" placeholder="Enter contact number"
                                        name="txt_shop_contactno" required value="<?php echo $data['shop_contactno'] ?>"
                                        style="background: none;">
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        style="background: none;" name="txt_shop_password" required>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit"
                                        name="btn_save_contactno">Save Contact number</button>
                                </div>
                            </form>
                            <form class="p-3 py-5" method="post">
                                <div class="d-flex justify-content-between align-items-center experience">
                                    <span><b>Change Email</b></span>
                                    <span class="px-3 p-1 add-experience">
                                    </span>
                                </div><br>
                                <div class="col-md-12">
                                    <label class="labels">Email</label><br><br>
                                    <input type="text" class="form-control" placeholder="Enter email"
                                        name="txt_shop_email" required value="<?php echo $data['shop_email'] ?>"
                                        style="background: none;">
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        name="txt_shop_password" required style="background: none;">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit"
                                        name="btn_save_email">Save Email</button>
                                </div>
                            </form>
                            <form class="p-3 py-5" method="post">
                                <div class="d-flex justify-content-between align-items-center experience">
                                    <span><b>Change Password</b></span>
                                    <span class="px-3 p-1 add-experience">
                                    </span>
                                </div><br>
                                <div class="col-md-12">
                                    <label class="labels">Current Password</label><br><br>
                                    <input type="password" class="form-control" name="txt_shop_password" required
                                        placeholder="Enter current password" style="background: none;">
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">New Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Enter new password"
                                        name="txt_shop_npassword" required style="background: none;">
                                </div><br>
                                <div class="col-md-12">
                                    <label class="labels">Confirm Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Confirm new password"
                                        name="txt_shop_cpassword" required style="background: none;">
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit"
                                        name="btn_save_passw">Save Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


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
            getCity(<?php echo $data['district_id'] ?>,<?php echo $data['city_id'] ?>);
        }

        function getCity(did,cid) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxChangeProfileCity.php?did=' + did+"&cid=" + cid,
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