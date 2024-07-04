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

$selQuery = "select * from tbl_user u inner join tbl_city c on u.city_id=c.city_id inner join tbl_district d on c.district_id=d.district_id where user_id =" . $_SESSION['uid'];
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


if (isset($_GET['oidV'])) {
    $selQuery = "select * from tbl_order o 
 inner join tbl_cart cr on o.cart_id=cr.cart_id 
 inner join tbl_plant p on cr.plant_id=p.plant_id 
 inner join tbl_shop s on s.shop_id=p.shop_id 
 inner join tbl_city ct on ct.city_id=s.city_id 
 inner join tbl_district d on d.district_id=ct.district_id 
 left join tbl_plant_category c on c.plant_category_id=p.plant_category_id
 left join tbl_user u on u.user_id=cr.user_id where order_id = " . $_GET['oidV'];
    $result = $conn->query($selQuery);
    $orderBillData = $result->fetch_assoc();
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
    <!-- <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> -->
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

    <link rel="stylesheet" href="../Assets//CSS//User//UserPlaceOrder.css">

    <link rel="stylesheet" href="../Assets//CSS//User//UserordersViewMore.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFeedback.css">

    <link rel="stylesheet" href="../Assets/CSS/User/UserFilter.css">
</head>

<body style="background: #548302;"
    onload="test(<?php echo $orderBillData['plant_price'] * $orderBillData['cart_quantity'] ?>)">
    <div class="container-fluid position-relative d-flex p-0">



        <?php include('../Assets/components/User/SideBar.php') ?>


        <!-- Content Start -->
        <div class="content" style="background: #548302;">

            <?php include('../Assets/components/User/NavBarOthers.php') ?>


            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background: #fff;">
                    <button id="button" style="border: none; background: none;">
                        <span class="material-symbols-outlined" style="border: none;font-size: 34pt;color: #548302;">
                            print
                        </span>
                    </button>
                    <div class="invoice-box" id="makepdf">
                        <table cellpadding="0" cellspacing="0">
                            <tr class="top_rw">
                                <td colspan="2">
                                    <h2 style="margin-bottom: 0px;color: rgb(66, 66, 66,0.7);"> Tax invoice/Bill of
                                        Supply/Cash Memo </h2>
                                    <span>
                                        Number:
                                        <?php
                                        echo date('Ym') . "GC" . $orderBillData['order_number']
                                            ?> Date:
                                        <?php echo date_format(date_create($orderBillData['order_date']), 'd-m-Y') ?>
                                    </span>
                                </td>
                                <td style="width:30%; margin-right: 10px;">
                                    Order Id:
                                    <?php echo $orderBillData['order_number'] ?>
                                </td>
                            </tr>
                            <tr class="top">
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td>
                                                <b> Sold By:
                                                    <?php echo $orderBillData['shop_name'] ?>
                                                </b> <br>
                                                <?php echo $orderBillData['shop_address'] ?>, Pin Code :
                                                421302 <br>
                                                <?php echo $orderBillData['city_name'] ?>,
                                                <?php echo $orderBillData['district_name'] ?> <br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="information">
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td colspan="2">
                                                <b> Delivering Address:
                                                    <?php echo $orderBillData['user_name'] ?>
                                                </b> <br>
                                                <?php echo $orderBillData['user_address'] ?>,
                                                Pin Code :
                                                <?php echo $orderBillData['user_pincode'] ?> <br>
                                                <?php echo $orderBillData['order_place'] ?>,
                                                <?php echo $data['city_name'] ?>,
                                                <?php echo $data['district_name'] ?><br>
                                                Ph:
                                                <?php echo $data['user_contactno'] ?><br>
                                                <?php echo $data['user_email'] ?><br>
                                            </td>
                                            <td>
                                                <b> Billing Address:
                                                    <?php echo $orderBillData['user_name'] ?>
                                                </b> <br>
                                                <?php echo $orderBillData['user_address'] ?>,
                                                Pin Code :
                                                <?php echo $orderBillData['user_pincode'] ?> <br>
                                                <?php echo $orderBillData['order_place'] ?>,
                                                <?php echo $data['city_name'] ?>,
                                                <?php echo $data['district_name'] ?><br>
                                                Ph:
                                                <?php echo $data['user_contactno'] ?><br>
                                                <?php echo $data['user_email'] ?><br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <td colspan="3">
                                <table cellspacing="0px" cellpadding="2px">
                                    <tr class="heading">
                                        <td style="width:25%;">
                                            ITEM
                                        </td>
                                        <td style="width:10%; text-align:center;">
                                            QTY.
                                        </td>
                                        <td style="width:10%; text-align:right;">
                                            PRICE (INR)
                                        </td>
                                        <td style="width:15%; text-align:right;">
                                            TOTAL AMOUNT (INR)
                                        </td>
                                    </tr>
                                    <tr class="item">
                                        <td style="width:25%;">
                                            <?php echo $orderBillData['plant_name'] ?>
                                        </td>
                                        <td style="width:10%; text-align:center;">
                                            <?php echo $orderBillData['cart_quantity'] ?>
                                        </td>
                                        <td style="width:10%; text-align:right;">
                                            <?php echo $orderBillData['plant_price'] ?>
                                        </td>
                                        <td style="width:15%; text-align:right;">
                                            <?php echo $orderBillData['plant_price'] * $orderBillData['cart_quantity'] ?>
                                        </td>
                                    </tr>
                                    <tr class="item">
                                        <td style="width:25%;"> <b> Grand Total </b> </td>
                                        <td style="width:10%; text-align:center;">

                                        </td>
                                        <td style="width:15%; text-align:right;">
                                        </td>
                                        <td style="width:15%; text-align:right;">
                                            <?php echo $orderBillData['plant_price'] * $orderBillData['cart_quantity'] ?>
                                        </td>
                                    </tr>
                            </td>
                        </table>
                        <tr class="total">
                            <td width=50% align="left"> &nbsp; <b>Payment Completed</b></td>
                            <td colspan="3" align="right"> Total Amount in Words : <b>
                                    <p id="rupeesinwords"></p>
                                </b> </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <table cellspacing="0px" cellpadding="2px">
                                    <tr>
                                        <td width="50%">
                                            <b> Declaration: </b> <br>
                                            We declare that this invoice shows the actual price of the goods
                                            described above and that all particulars are true and correct. The
                                            goods sold are intended for end user consumption and not for resale.
                                        </td>
                                        <td>
                                            * This is a computer generated invoice and does not
                                            require a physical signature
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="50%">
                                            <h1 class="" style="color: rgb(84, 131, 2,0.7);">GREENCART</h1>
                                        </td>
                                        <td>
                                            <b> Authorized Signature </b>
                                            <br>
                                            <img src="../Assets//Img//signature.png" height="55em" />
                                            <br>
                                            <br>
                                            <br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        </table>
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
    <script src="../Assets//JS//User//UserPayment.js"></script>
    <script src="../Assets//JS//User//UserordersViewMore.js"></script>

    <script>
        function getPlace(did) {
            $.ajax({
                url: '../Assets//AjaxPages//AjaxPlace.php?did=' + did,
                success: function (result) {

                    $("#get_place").html(result);
                }
            });
        }
    </script>

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
    <img src="" alt="">
</body>

</html>

<?php ob_flush(); ?>