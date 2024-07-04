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

$selQuery = "select * from tbl_user u inner join tbl_city p on u.city_id=p.city_id where user_id =" . $_SESSION['uid'];
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

if (isset($_POST['btn_save_profile'])) {
    $user_name = $_POST['txt_user_name'];
    $user_gender = $_POST['radio_user_gender'];
    $user_dob = $_POST['date_user_dob'];
    $user_address = $_POST['txt_user_address'];
    $user_pincode = $_POST['txt_user_pincode'];
    $user_city = $_POST['sel_city'];

    $upQuery = "update tbl_user 
    set user_name='$user_name',
    user_gender='$user_gender',
    user_dob='$user_dob',
    user_address='$user_address',
    user_pincode=$user_pincode,
    city_id=$user_city
    where user_id=" . $data['user_id'] . "
    ";

    if ($conn->query($upQuery)) {
        ?>
        <script>
            alert('Profile updated')
            window.location = './UserChangeProfile.php';
        </script>
        <?php
    }
}

if (isset($_POST['btn_save_contactno'])) {
    $user_contactno = $_POST['txt_user_contactno'];
    $user_passw = $_POST['txt_user_password'];

    if ($user_passw == $data['user_password']) {
        $upQuery = "update tbl_user 
        set user_contactno='$user_contactno'
        where user_id=" . $data['user_id'] . "
        ";
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Contact number updated')
                window.location = './UserChangeProfile.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect password')
            window.location = './UserChangeProfile.php';
        </script>
        <?php
    }

}


if (isset($_POST['btn_save_email'])) {
    $user_email = $_POST['txt_user_email'];
    $user_passw = $_POST['txt_user_password'];

    if ($user_passw == $data['user_password']) {
        $upQuery = "update tbl_user 
        set user_email='$user_email'
        where user_id=" . $data['user_id'] . "
        ";
        if ($conn->query($upQuery)) {
            ?>
            <script>
                alert('Email updated')
                window.location = './UserChangeProfile.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect password')
            window.location = './UserChangeProfile.php';
        </script>
        <?php
    }
}


if (isset($_POST['btn_save_passw'])) {
    $user_npassw = $_POST['txt_user_npassword'];
    $user_cpassw = $_POST['txt_user_cpassword'];
    $user_passw = $_POST['txt_user_password'];

    if ($user_passw == $data['user_password']) {
        if ($user_npassw == $user_cpassw) {
            $upQuery = "update tbl_user 
        set user_password='$user_npassw'
        where user_id=" . $data['user_id'] . "
        ";
            if ($conn->query($upQuery)) {
                ?>
                <script>
                    alert('Password updated')
                    window.location = './UserChangeProfile.php';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Password does not match')
                window.location = './UserChangeProfile.php';
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Incorrect password')
            window.location = './UserChangeProfile.php';
        </script>
        <?php
    }
}


if (isset($_POST['btn_save_user_photo'])) {
    $time = time() . date('m-d-Y');
    $file_name = $time . $_FILES['file_user_photo']['name'];
    $tmp_file_name = $_FILES['file_user_photo']['tmp_name'];
    $old_file = '../Assets/Files/User/' . $data['user_photo'];

    unlink($old_file);

    $upQuery = "update tbl_user 
        set user_photo='$file_name'
        where user_id=" . $data['user_id'] . "
        ";
    if ($conn->query($upQuery)) {
        move_uploaded_file($tmp_file_name, '../Assets/Files/User/' . $file_name);
        ?>
        <script>
            alert('Profile photo updated')
            window.location = './UserChangeProfile.php';
        </script>
        <?php
    }
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

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../Assets//CSS//Admin//HomePage.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserChangeProfile.css">


    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">
</head>

<body style="background: #548302;" onload="mainFun()">
    <div class="container-fluid position-relative d-flex p-0">


        <?php include('../Assets/components/User/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

        <?php include('../Assets/components/User/NavBarOthers.php') ?>



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
                                    <input id="file" required name="file_user_photo" type="file"
                                        onchange="loadFile(event)" />
                                    <img src="../Assets//Files//User//<?php echo $data['user_photo'] ?>" id="output"
                                        width="200" />
                                </div>
                                <span class="font-weight-bold">
                                    <?php echo $data['user_name'] ?>
                                </span><span class="text-black-50">
                                    <?php echo $data['user_email'] ?>
                                </span><span> </span>
                            </div>
                            <div class="mt-5 text-center">
                                <button class="btn btn-primary profile-button" type="submit" name="btn_save_user_photo">
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
                                            placeholder="Enter name" required value="<?php echo $data['user_name'] ?>"
                                            name="txt_user_name">
                                    </div>
                                </div><br>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <label class="labels">Gender</label><br><br>
                                        <?php
                                        $arr = ['Male', 'Female', 'Other'];
                                        foreach ($arr as $key => $value) {
                                            if ($value == $data['user_gender']) {
                                                ?>
                                                &nbsp;&nbsp;
                                                <input style="accent-color:  #548302;width: 1.2em;height: 1.2em;" type="radio"
                                                    name="radio_user_gender" required value="<?php echo $value; ?>" id=""
                                                    checked>
                                                <?php
                                                echo $value;
                                                continue;
                                            }
                                            ?>
                                            &nbsp;&nbsp;
                                            <input style="accent-color:  #548302;width: 1.2em;height: 1.2em;" type="radio"
                                                name="radio_user_gender" required value="<?php echo $value; ?>" id="">
                                            <?php
                                            echo $value;
                                        }
                                        ?>
                                    </div>
                                </div><br>

                                <div class="row mt-3">
                                    <?php
                                    $dateDob = $data['user_dob'];
                                    $day = date_format(date_create($dateDob), "d");
                                    $month = date_format(date_create($dateDob), "m");
                                    $year = date_format(date_create($dateDob), "Y");
                                    ?>
                                    <label class="labels">Date of Birth</label>
                                    <div class="col-md-12">
                                        <input class="form-control" type="date" value="yyyy-mm-dd" id="d"
                                            style="background: none;" oninput="edit()" name="date_user_dob" hidden>
                                    </div><br>
                                    <div class="col-md-3">
                                        <label class="labels"><small>Day</small></label>
                                        <input class="form-control" type="number" required value="<?php echo $day ?>"
                                            id="d1" max="31" min="1" size="2" style="background: none;"
                                            oninput="edit()">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="labels"><small>Month</small></label>
                                        <input class="form-control" type="number" required value="<?php echo $month ?>"
                                            id="m" max="12" min="1" size="2" style="background: none;" oninput="edit()">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="labels"><small>Year</small></label>
                                        <input class="form-control" type="number" required value="<?php echo $year ?>"
                                            id="y" min="1900" max="3000" size="4" maxlength="4"
                                            style="background: none;" oninput="edit()">
                                    </div>
                                </div><br>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Address</label><br><br>
                                        <textarea style="background: none;" required type="text" class="form-control"
                                            placeholder="Enter address" value="" rows="3"
                                            name="txt_user_address"><?php echo $data['user_address'] ?></textarea>
                                    </div>
                                </div><br>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Pincode</label><br><br>
                                        <input style="background: none;" type="text" required class="form-control"
                                            placeholder="Enter pincode" value="<?php echo $data['user_pincode'] ?>"
                                            name="txt_user_pincode">
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
                                        name="txt_user_contactno" required value="<?php echo $data['user_contactno'] ?>"
                                        style="background: none;">
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        style="background: none;" name="txt_user_password" required>
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
                                        name="txt_user_email" required value="<?php echo $data['user_email'] ?>"
                                        style="background: none;">
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        name="txt_user_password" required style="background: none;">
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
                                    <input type="password" class="form-control" name="txt_user_password" required
                                        placeholder="Enter current password" style="background: none;">
                                </div> <br>
                                <div class="col-md-12">
                                    <label class="labels">New Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Enter new password"
                                        name="txt_user_npassword" required style="background: none;">
                                </div><br>
                                <div class="col-md-12">
                                    <label class="labels">Confirm Password</label><br><br>
                                    <input type="password" class="form-control" placeholder="Confirm new password"
                                        name="txt_user_cpassword" required style="background: none;">
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
    <script src="../Assets/JS/User/UserChangeProfile.js"></script>
    <script>
        function calcPrice(crId, itemcount) {
            window.location = './UserCart.php?crid=' + crId + '&itemcount=' + itemcount;
        }
    </script>


    <script>

        function mainFun() {
            edit();
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



        function edit() {
            
            // Retrieve the values of 'dd', 'mm', 'yy' 
            var dd = document.getElementById("d1").value;
            var mm = document.getElementById("m").value;
            var yy = document.getElementById("y").value;

            // Check if the length of day and month is 
            // equal to 1 
            if (dd.length == 1) {
                dd = "0" + dd;
            }
            if (mm.length == 1) {
                mm = "0" + mm;
            }

            // Construct a date format like 
            // [yyyy - mm - dd] 
            var date = yy + "-" + mm + "-" + dd;

            // Replace the date format with BootStrap 
            // date field 
            document.getElementById("d").value = date;
        } 
    </script>
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>