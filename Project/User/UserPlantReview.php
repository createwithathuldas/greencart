<?php
ob_start();
session_start();
include("../Assets/Connection/connection.php");
$plant_id = null;
if (isset($_GET['pid'])) {
    $_SESSION['pid'] = $_GET['pid'];
}
$plant_id = $_SESSION['pid'];

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


if (isset($_POST['btn_submit'])) {
    $selQuery = "select * from tbl_plant_rating where plant_id =" . $plant_id . " and user_id = " . $data['user_id'];
    $result = $conn->query($selQuery);
    if (!$result->num_rows) {
        $plant_rating_user_review = $_POST['txt_plant_rating_user_review'];
        $plant_rating_star = $_POST['rating3'];
        $insQuery = "insert into tbl_plant_rating(plant_rating_user_review,user_id,plant_id,plant_rating_star) values('$plant_rating_user_review'," . $data['user_id'] . "," . $plant_id . ",$plant_rating_star)";
        if ($conn->query($insQuery)) {
            $selQuery1 = "select * from tbl_plant_rating where plant_id=" . $plant_id . " and plant_rating_star=1";
            $result1 = $conn->query($selQuery1);
            $star1Count = $result1->num_rows;

            $selQuery2 = "select * from tbl_plant_rating where plant_id=" . $plant_id . " and plant_rating_star=2";
            $result2 = $conn->query($selQuery2);
            $star2Count = $result2->num_rows;

            $selQuery3 = "select * from tbl_plant_rating where plant_id=" . $plant_id . " and plant_rating_star=3";
            $result3 = $conn->query($selQuery3);
            $star3Count = $result3->num_rows;

            $selQuery4 = "select * from tbl_plant_rating where plant_id=" . $plant_id . " and plant_rating_star=4";
            $result4 = $conn->query($selQuery4);
            $star4Count = $result4->num_rows;

            $selQuery5 = "select * from tbl_plant_rating where plant_id=" . $plant_id . " and plant_rating_star=5";
            $result5 = $conn->query($selQuery5);
            $star5Count = $result5->num_rows;

            $rating = ($star1Count * 1 + $star2Count * 2 + $star3Count * 3 + $star4Count * 4 + $star5Count * 5) / ($star1Count + $star2Count + $star3Count + $star4Count + $star5Count);
            $rating = number_format($rating, 1);
            $upQuery = "update tbl_plant set plant_rating=$rating where plant_id=" . $plant_id;
            if ($conn->query($upQuery)) {
                ?>
                <script>
                    alert('submitted')
                    window.location = './UserPlantReview.php'
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            alert('Already reviewed')
            window.location = './UserPlantReview.php'
        </script>
        <?php

    }
}

if (isset($_GET['s'])) {
    ?>
    <script>
        window.onload = function () {
            document.getElementById('searchplant').focus();
        };
    </script>
    <?php
}


$selQuery = "select * from tbl_plant p inner join tbl_plant_category c on p.plant_category_id=c.plant_category_id left join tbl_shop s on p.shop_id=s.shop_id where plant_id =" . $plant_id;
$result = $conn->query($selQuery);
$plant = $result->fetch_assoc();


$selQueryC = "select * from tbl_cart where user_id =" . $data['user_id'] . " and cart_del_status=false";
$resultC = $conn->query($selQueryC);
$cartCount = $resultC->num_rows;

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

    <link rel="stylesheet" href="../Assets//CSS//User//UserPlantReview.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">
</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">



        <?php include('../Assets/components/User/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

            <?php include('../Assets/components/User/NavBarOthers.php') ?>



            <form class="container-fluid pt-4 px-4" onsubmit="return checkPlantReview();" name="plantReview"
                method="post">
                <div class="rounded p-4" style="background: #fff;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Review</h6>
                    </div>
                    <div class="mb-3">
                        <img src="../Assets//Files//Plant//<?php echo $plant['plant_photo'] ?>"
                            class="img-thumbnail" alt="Cinque Terre" width="304" height="236" style="border: none;">
                        <p style="font-size: 18pt;">
                            <?php echo $plant['plant_name'] ?>
                        </p>
                        <small>Category:
                            <?php echo $plant['plant_category_name'] ?>
                        </small><br>
                        <small>Seller:
                            <?php echo $plant['shop_name'] ?>
                        </small>
                    </div>
                    <div id="full-stars-example-two">
                        <div class="rating-group" aria-required="true">
                            <input disabled checked class="rating__input rating__input--none" name="rating3"
                                id="rating3-none" value="0" type="radio" required>
                            <label aria-label="1 star" class="rating__label" for="rating3-1"><i
                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating3" id="rating3-1" value="1" type="radio" required>
                            <label aria-label="2 stars" class="rating__label" for="rating3-2"><i
                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating3" id="rating3-2" value="2" type="radio" required>
                            <label aria-label="3 stars" class="rating__label" for="rating3-3"><i
                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating3" id="rating3-3" value="3" type="radio" required>
                            <label aria-label="4 stars" class="rating__label" for="rating3-4"><i
                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating3" id="rating3-4" value="4" type="radio" required>
                            <label aria-label="5 stars" class="rating__label" for="rating3-5"><i
                                    class="rating__icon rating__icon--star fa fa-star"></i></label>
                            <input class="rating__input" name="rating3" id="rating3-5" value="5" type="radio" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <textarea style="background: none;color: #000;" class="form-control"
                            name="txt_plant_rating_user_review" placeholder="Content...." rows="5" required></textarea>
                    </div>
                    <div class="mb-3" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" name="btn_submit">Submit</button>
                    </div>

                    <div class="mb-3">

                        <?php include('../Assets/components/RatingCount.php') ?>

                        <?php include('../Assets/components/RatingProgress.php') ?>



                        <br><br>
                        <select onchange="viewReviews(<?php echo $plant_id ?>,this.value)"
                            style="background: none;color:  #000; width: 8em;border:1px solid #548302; border-radius: 0.3em;text-align: center;">
                            <option value="0">All</option>
                            <?php
                            for ($i = 5; $i >= 1; $i--) {
                                ?>
                                <option class="rating-value" value="<?php echo $i ?>">
                                    <?php echo $i ?> &#9733;<i></i>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                        <br><br>
                        <div id="viewReviews">
                            <?php include('../Assets/components/ViewReview.php') ?>
                        </div>
                    </div>
                </div>
            </form>


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
    <script>
        function checkPlantReview() {
            var starrValue = document.plantReview.rating3.value;
            if (starrValue == 0) {
                alert('Please select star rating')
                return false;
            }
        }

        function viewReviews(plantID,plantRatingStar) {
            $.ajax({
                url: '../Assets/AjaxPages/AjaxViewPlantReviews.php?plantID='+plantID+'&plantRatingStar=' + plantRatingStar,
                success: function (data) {
                    $('#viewReviews').html(data);
                }
            })
        }
    </script>
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>