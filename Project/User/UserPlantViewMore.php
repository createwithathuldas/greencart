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
if (isset($_GET['plant_view_id'])) {
    $_SESSION['pvi'] = $_GET['plant_view_id'];
}


$selQuery = "select * from tbl_user where user_id =" . $_SESSION['uid'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();

$selQuery = "select * from tbl_plant p inner join tbl_plant_category c on p.plant_category_id=c.plant_category_id left join tbl_shop s on p.shop_id=s.shop_id where plant_id =" .$_SESSION['pvi'] ;
$result = $conn->query($selQuery);
$plant = $result->fetch_assoc();

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

if (isset($_POST['btn_addtocart'])) {
    $insQuery = "insert into tbl_cart(cart_quantity, plant_id,user_id) values(1," . $plant['plant_id'] . "," . $data['user_id'] . ")";
    if ($conn->query($insQuery)) {
    ?>
        <script>
            alert('successfully added to cart')
            window.location = './UserPlantviewMore.php';
        </script>
    <?php
    }
}

if (isset($_POST['btn_buynow'])) {
    $insQuery = "insert into tbl_cart(cart_quantity, plant_id,user_id) values(1," . $plant['plant_id'] . "," . $data['user_id'] . ")";
    if ($conn->query($insQuery)) {
    ?>
        <script>
            window.location = './UserCart.php'
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets//Template//AdminTemplate//darkpan-1.0.0//css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="../Assets//Template//AdminTemplate//darkpan-1.0.0//css//style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="../Assets//CSS//Admin//HomePage.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    
    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">

    <link rel="stylesheet" href="../Assets//CSS//User//UserPlantReview.css">
</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">


    <?php include('../Assets/components/User/SideBar.php') ?>


    <!-- Content Start -->
    <div class="content" style="background: #548302;">
   
    <?php include('../Assets/components/User/NavBarOthers.php') ?>
    
            <div class="container mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="images p-3">
                                        <div class="text-center p-4"> <img id="main-image" src="../Assets//Files//Plant//<?php echo $plant['plant_photo'] ?>" width="250" /> </div>
                                        <div class="thumbnail text-center">
                                            <?php
                                            $selQuery = "select * from tbl_plant_gallery where plant_id=" . $plant['plant_id'];
                                            $result = $conn->query($selQuery);
                                            if ($result->num_rows) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <img onclick="change_image(this)" src="../Assets//Files//PlantGallery//<?php echo $row['plant_gallery_photo'] ?>" width="70">
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="sizes mt-5" >
                                        <?php include('../Assets/components/RatingCount.php') ?>

                                        <?php include('../Assets/components/RatingProgress.php') ?>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="product p-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div> <i class="fa fa-shopping-cart text-muted"></i> -->
                                        </div>
                                        <div class="mt-4 mb-3">
                                            <!-- <span class="text-uppercase text-muted brand"></span> -->
                                            <h5 class="text-uppercase" style="color: #548302;font-weight: bold;"><?php echo $plant['plant_name'] ?></h5>
                                            <div class="price d-flex flex-row align-items-center"> <span class="act-price" style="color: #4a4a01;font-weight: 520;"><?php echo $plant['plant_category_name'] ?></span>
                                                <!-- <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span> </div> -->
                                            </div>
                                        </div>
                                        <p class="about" style="color: #4c4e59;"><?php echo $plant['plant_description'] ?></p>
                                        <div class="sizes mt-5">
                                            <h6 class="" style="color:#014a3e; ">Price: &#8377;&nbsp;<?php echo $plant['plant_price'] ?></h6>
                                            <span style="color: #023683;">Seller: <?php echo $plant['shop_name'] ?></span><br><br>
                                            <?php
                                            if ($plant['plant_stock'] != 0) {
                                            ?>
                                                <h6 class="" style="color: #2f4a01; ">Only <?php echo $plant['plant_stock'] ?> in stock</h6>
                                            <?php
                                            } else {
                                            ?>
                                                <h6 class="" style="color: #830202; ">Out of stock</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="cart mt-4 align-items-center">
                                            <form action="" method="post">
                                                <button name="btn_addtocart" class="btn btn-danger text-uppercase mr-2 px-4" style="background: #748302;color: #fff; outline: none; border: none;" <?php if ($plant['plant_stock'] < 1) {
                                                                                                                                                                                                    ?> disabled <?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                                ?>>
                                                    Add to cart
                                                </button>
                                                <button name="btn_buynow" class="btn btn-danger text-uppercase mr-2 px-4" style="background: #834502;color: #fff;outline: none; border: none;" <?php if ($plant['plant_stock'] < 1) {
                                                                                                                                                                                                ?> disabled <?php
                                                                                                                                                                                                        }
                                                                                                                                                                                                            ?>>
                                                    Buy now
                                                </button>
                                            </form>
                                        </div>
                                        <div class="sizes mt-5">
                                             <select onchange="viewReviews(<?php echo $plant['plant_id'] ?>,this.value)"
                                                  style="background: none;color:  #000; width: 8em;border:1px solid #548302; border-radius: 0.3em;text-align: center;">
                                               <option value="0">All</option>
                                                <?php
                                                  for ($i = 5; $i >= 1; $i--) {
                                                        ?>
                                                             <option class="rating-value" value="<?php echo $i ?>">
                                                                <?php echo $i ?> &#9733;
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
                                </div>
                            </div>
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
    <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Assets//Template//AdminTemplate//darkpan-1.0.0//js/main.js"></script>
    <script src="../Assets//JS//Admin//HideViewShop.js"></script>
    <script src="../Assets//JS//Ajax//jQuery.js"></script>

    <script>
        function change_image(image) {

            var container = document.getElementById("main-image");

            container.src = image.src;
        }



        document.addEventListener("DOMContentLoaded", function(event) {







        });

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