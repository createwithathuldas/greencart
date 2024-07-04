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

$selQuery = "select * from tbl_shop where shop_id =" . $_SESSION['sid'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();



if (isset($_POST['btn_logout'])) {
    unset($_SESSION['sid']);
    ?>
    <script>
        window.location = '../index.php';
    </script>
    <?php
}


if (isset($_POST['btn_save'])) {
    if ($data['shop_status'] == 1) {
        $plant_name = $_POST['txt_plant_name'];
        $plant_category = $_POST['sel_plant_category'];
        $plant_description = $_POST['txt_plant_description'];
        $plant_price = $_POST['txt_plant_price'];

        $time = time() . date('m-d-Y');
        $file_name_photo = $time . $_FILES['file_plant_photo']['name'];
        $temp_file_name_photo = $_FILES['file_plant_photo']['tmp_name'];
        $insQuery="insert into tbl_plant(plant_name,plant_description, plant_photo, plant_price,plant_category_id,shop_id) values('$plant_name','$plant_description','$file_name_photo',$plant_price,$plant_category,".$data['shop_id'].")";
        if ($conn->query($insQuery)) {
            move_uploaded_file($temp_file_name_photo, '../Assets/Files/Plant/' . $file_name_photo);
            ?>
            <script>
                alert('Saved')
                window.location = './ShopPlants.php'
            </script>
            <?php
        }
    } else if ($data['shop_status'] == 2) {
        ?>
            <script>
                alert("This  feature is not available.Because your shop's account is temporarily blocked")
                window.location = './ShopPlants.php'
            </script>
        <?php
    } else {
        ?>
            <script>
                alert('This has not verified')
                window.location = './ShopPlants.php'
            </script>
        <?php
    }
}


$selQuery = "select * from tbl_plant where shop_id =" . $data['shop_id'];
$result = $conn->query($selQuery);
$count = $result->num_rows;
$i = 1;
while ($i <= $count) {
    if (isset($_POST["btn_gsubmit$i"])) {
        $time = time() . date('m-d-Y');
        $plantId = $_POST["btn_gsubmit$i"];
        $file_name = $time . $_FILES["file_plant_gallery$i"]["name"];
        $tmp_file_name = $_FILES["file_plant_gallery$i"]["tmp_name"];
        $insQuery = "insert into tbl_plant_gallery(plant_gallery_photo,plant_id) values('$file_name',$plantId)";
        if ($conn->query($insQuery)) {
            move_uploaded_file($tmp_file_name, '../Assets/Files/PlantGallery/' . $file_name);
            ?>
            <script>
                alert('Gallery updated')
                window.location = './ShopPlants.php'
            </script>
            <?php
        }
    }
    $i++;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GREENCART-Shop plants</title>
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

    <link rel="stylesheet" href="../Assets/CSS/Shop/ShopFeedback.css">

</head>

<body style="background: #548302;">
    <div class="container-fluid position-relative d-flex p-0">


        <?php include('../Assets/components/Shop/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

            <?php include('../Assets/components/Shop/NavBar.php') ?>


            <!-- Sign Up Start -->
            <form method="post" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4" style="width:90%;">
                            <div class=" rounded p-4 p-sm-5 my-4 mx-3" style="background:#548302;">
                                <select required name="sel_plant_category" id="" class="form-select mb-3"
                                    style="background: #fff;text-align: center;border: none;">
                                    <option value="">------Select Plant category------</option>
                                    <?php
                                    $selQuery = "select * from tbl_plant_category";
                                    $result = $conn->query($selQuery);
                                    while ($row = $result->fetch_assoc()) {
                                        if ($row['plant_category_del_status'] == false) {
                                            ?>

                                            <option value="<?php echo $row['plant_category_id'] ?>">
                                                <?php echo $row['plant_category_name'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="floatingText"
                                        placeholder="Enter plant name" style="background: #fff;" name="txt_plant_name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <textarea rows="10" type="text" class="form-control" id="floatingText"
                                        placeholder="Enter plant description" style="background: #fff;"
                                        name="txt_plant_description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="" style="color: #fff;">&nbsp;Choose plant photo</label>
                                    <input type="file" accept="image/*" class="form-control" id="floatingText"
                                        style="background: #fff;" name="file_plant_photo" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="floatingText"
                                        placeholder="Enter plant price" style="background: #fff;" name="txt_plant_price"
                                        required>
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
                        <h6 class="mb-0" style="color: #548302;font-size: 18pt;">Plants</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="" style="color: #548302;">
                                    <th scope="col">Sl no</th>
                                    <th scope="col">Plant Name</th>
                                    <th scope="col">Plant photo</th>
                                    <th scope="col">Plant descrption</th>
                                    <th scope="col">Plant Category</th>
                                    <th scope="col">Plant gallery</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">stock</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $selQuery = "select * from tbl_plant p inner join tbl_shop s on p.shop_id = s.shop_id left join tbl_plant_category c on p.plant_category_id=c.plant_category_id where s.shop_id =" . $data['shop_id'] . " order by c.plant_category_name";
                                $result = $conn->query($selQuery);
                                $count = $result->num_rows;
                                $tempCount = 0;
                                if ($result->num_rows) {
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++;
                                        if ($row['plant_del_status'] == false) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['plant_name'] ?>
                                                </td>
                                                <td><img src="../Assets//Files//Plant/<?php echo $row['plant_photo'] ?>" alt=""
                                                        height="100em" width="auto"></td>
                                                <td>
                                                    <?php echo $row['plant_description'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['plant_category_name'] ?>
                                                </td>
                                                <td align="center">
                                                    <?php
                                                    $selQuery2 = "select * from tbl_plant_gallery where plant_id=" . $row['plant_id'];
                                                    $result2 = $conn->query($selQuery2);
                                                    if ($result2->num_rows) {
                                                        while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                            <img src="../Assets//Files//PlantGallery//<?php echo $row2['plant_gallery_photo'] ?>"
                                                                alt="" height="100em" width="auto" style="padding: 1em;">
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    Rs.<input type="number" style="border: none;color: #023683;" id=""
                                                        value="<?php echo $row['plant_price'] ?>" placeholder="Enter price"
                                                        onchange="addPlantPrice(<?php echo $row['plant_id'] ?>,this.value)">
                                                </td>

                                                <td>
                                                    <input type="number" style="border: none;color: #023683;" id=""
                                                        value="<?php echo $row['plant_stock'] ?>" placeholder="Enter stock"
                                                        onchange="addPlantStock(<?php echo $row['plant_id'] ?>,this.value)">
                                                </td>
                                                <td>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="file" accept="image/*"
                                                            name="file_plant_gallery<?php echo $i ?>" id="" required /><br><br>
                                                        <button type="submit" name="btn_gsubmit<?php echo $i ?>"
                                                            class="btn btn-primary btn-sm"
                                                            value="<?php echo $row['plant_id'] ?>">Upload</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary"
                                                        href="./ShopPlants.php?pidStock=<?php echo $row['plant_id'] ?>">Delete</a>
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
                                            <th colspan="7" style="text-align: center;">No data available</th>
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

            <?php include("../Assets/components/ShopFeedback.php"); ?>

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
        function addPlantStock(pid, pstock) {
            if (isNaN(pstock)) {
                alert('Invalid')
            } else {
                $.ajax({
                    url: '../Assets/AjaxPages/AjaxAddPlantStock.php?pid=' + pid + '&&pstock=' + pstock,
                })
            }
        }

        function addPlantPrice(pid, pprice) {
            if (isNaN(pprice)) {
                alert('Invalid')
            } else {
                $.ajax({
                    url: '../Assets/AjaxPages/AjaxAddPlantPrice.php?pid=' + pid + '&&pprice=' + pprice,
                })
            }
        }
    </script>
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>