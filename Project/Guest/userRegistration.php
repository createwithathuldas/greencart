<?php
include("../Assets/Connection/connection.php");
session_start();
if (isset($_POST['btn_submit'])) {
    $user_name = $_POST['txt_user_name'];
    $user_gender = $_POST['radio_user_gender'];
    $user_dob = $_POST['date_user_dob'];
    $user_address = $_POST['txt_user_address'];
    $user_pincode=$_POST['txt_user_pincode'];
    $user_city = $_POST['sel_city'];
    $time = time() . date('m-d-Y');
    $user_contactno = $_POST['txt_user_contactno'];
    $user_email = $_POST['txt_user_email'];
    $user_password = $_POST['txt_user_password'];
    $user_cpassword = $_POST['txt_user_cpassword'];

    $file_name = $time . $_FILES['user_profile']['name'];
    $tmp_file_name = $_FILES['user_profile']['tmp_name'];
    if ($user_password != $user_cpassword) {
?>
        <script>
            alert("Password does not match");
        </script>
        <?php
    } else {
        $insQuery = "insert into tbl_user(user_name,user_gender,user_dob,user_address,user_pincode,city_id,user_photo,user_contactno,user_email,user_password)
        values('$user_name','$user_gender','$user_dob','$user_address',$user_pincode,$user_city,'$file_name','$user_contactno','$user_email','$user_password')
        ";
        $selQuery = "select * from tbl_user where user_email = '$user_email'";
        $result = $conn->query($selQuery);
        if ($result->num_rows) {
        ?>
            <script>
                alert('Email already exists');
                window.location = '../User/UserHomePage.php';
            </script>
            <?php
        } else {
            if ($conn->query($insQuery)) {
                move_uploaded_file($tmp_file_name, '../Assets/Files/User/' . $file_name);
            ?>
                <script>
                    alert('Successfully registered');
                </script>
                <?php
                $selQuery = "select * from tbl_user where user_email = '$user_email' and user_password = '$user_password'";
                $result = $conn->query($selQuery);
                $data = $result->fetch_assoc();
                $_SESSION['uid'] = $data['user_id'];
                ?>
                <script>
                    window.location = '../User/UserHomePage.php';
                </script>
<?php
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GREENCART - GREENCART Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="../Assets//Template//Login//assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Assets//Template//Login//assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../Assets//Template//Login//assets/css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="../Assets//Template//MainTemplate//img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../Assets//Template//MainTemplate//lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets//Template//MainTemplate//lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets///Template//MainTemplate//css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../Assets///Template//MainTemplate//css/style.css" rel="stylesheet">


    <link rel="stylesheet" href="../Assets//CSS//Guest//userRegistration.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

</head>

<body>

    <!-- Navbar Start -->
    <br>
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.html" class="navbar-brand ms-lg-5">
            <h1 class="m-0 text-uppercase" style="color:#548302;"><i class="bi  fs-1 text-primary me-3"></i>GREENCART</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0"  style="padding-right: 2em;">
                <a href="/GreenCart/Project/index.php" class="nav-item nav-link">Home</a>
                <a href="./login.php" class="nav-item nav-link">Login</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown">Register</a>
                    <div class="dropdown-menu m-0">
                        <a href="./userRegistration.php" class="dropdown-item">User</a>
                        <a href="./ShopRegistration.php" class="dropdown-item">Shop</a>
                    </div>
                </div>
            </div>
        </div>
        

    </nav>
    <!-- Navbar End -->


    <section class="d-flex justify-content-center" style="background:url('../Assets//Img//login.jpg');background-repeat: no-repeat;">
        <form class="form-control" style="width:85%;margin-top: 5%;margin-bottom: 5%; background:rgb(255,255,255); padding:5%;" method="post" enctype="multipart/form-data">
            <p class="h3 text-center" style="color: #548302;">USER REGISTRATION</p>
            <div class="mb-3">
                <label for="">Name: </label>
                <input type="text" class="form-control" placeholder="Enter Name" name="txt_user_name" required>
            </div>
            <div class="mb-3">
                <label for="">Gender: </label>
                &nbsp;
                <input class="form-check-input" type="radio" name="radio_user_gender" id="flexRadioDefault1" value="Male" required>
                <label class="form-check-label" for="flexRadioDefault1">
                    Male
                </label>
                &nbsp;
                <input class="form-check-input" type="radio" name="radio_user_gender" id="flexRadioDefault1" value="Female" required>
                <label class="form-check-label" for="flexRadioDefault1">
                    Female
                </label>
                &nbsp;
                <input class="form-check-input" type="radio" name="radio_user_gender" id="flexRadioDefault1" value="Other" required>
                <label class="form-check-label" for="flexRadioDefault1">
                    Others
                </label>
            </div>
            <div class="mb-3">
                <label class="control-label" for="date">Date of Birth</label>
                <input class="form-control" id="date" name="date_user_dob" placeholder="MM/DD/YYY" type="date" required />
            </div>
            <div class="mb-3">
                <label class="control-label" for="date">Address</label>
                <textarea class="form-control" name="txt_user_address" placeholder="Enter Address" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label class="control-label" for="date">Pincode</label>
                <input class="form-control"  name="txt_user_pincode" placeholder="Enter Pincode" type="number" required />
            </div>
            <div class="mb-3">
                <label class="control-label" for="date" name="sel_district">District</label>
                <select class="form-select" required name="sel_district" onChange="getCity(this.value)">
                    <option value="0">---Select District---</option>
                    <?php
                    $selQuery = "select * from tbl_district";
                    $result = $conn->query($selQuery);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value=<?php echo $row['district_id']; ?>>
                            <?php echo $row['district_name']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3" id="get_city">

            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Profile Photo</label>
                <input type="file" class="form-control" id="formFile" name="user_profile" required>
            </div>
            <div class="mb-3">
                <label for="">Contact number: </label>
                <input type="number" class="form-control" placeholder="Enter Contact" name="txt_user_contactno" required>
            </div>
            <div class="mb-3">
                <label for="">Email: </label>
                <input type="email" class="form-control" placeholder="Enter Email" name="txt_user_email" required>
            </div>
            <div class="mb-3">
                <label for="">Password: </label>
                <input type="password" class="form-control" placeholder="Enter Password" name="txt_user_password" required>
            </div>
            <div class="mb-3">
                <label for="">Confirm Password: </label>
                <input type="password" class="form-control" placeholder="Confirm Password" name="txt_user_cpassword" required>
            </div>
            <center>
                <button type="submit" class="btn" style="background: #548302;color:#fff;" name="btn_submit">Submit</button>
            </center>
        </form>
    </section>

    <?php include('../Assets/Template/MainTemplate/Guest/footer.php'); ?>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Assets//Template//MainTemplate//lib//easing/easing.min.js"></script>
    <script src="../Assets//Template//MainTemplate//lib/waypoints/waypoints.min.js"></script>
    <script src="../Assets//Template//MainTemplate//lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets//Template//MainTemplate//js/main.js"></script>
    <script src="../Assets//JS//Guset//userRegistration.js"></script>
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script src="../Assets//JS//Ajax//jQuery.js"></script>
    <script>
        $(document).ready(function() {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>

    <script>
        function getCity(did) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxCity.php?did=' + did,
                success: function(result) {

                    $("#get_city").html(result);
                }
            });
        }
    </script>
</body>

</html>