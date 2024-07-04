<?php
include("../Connection/connection.php");
session_start();

unset($_SESSION['search_name']);
unset($_SESSION['sel_query']);

$searchName = $_GET['searchName'];

$_SESSION['search_name'] = $searchName;

$selQuery = "select * from tbl_plant p 
inner join tbl_plant_category c 
on p.plant_category_id = c.plant_category_id 
left join tbl_shop s on s.shop_id = p.shop_id 
where p.plant_name like '$searchName%' 
or c.plant_category_name 
like '$searchName%' or s.shop_name like '$searchName%'";
$_SESSION['search_name']=$searchName;
$_SESSION['sel_query']=$selQuery;
$result = $conn->query($selQuery);
if ($result->num_rows) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <!-- <div class="row justify-content-center mb-3"> -->
        <!-- <div class="col-md-12 col-xl-10"> -->
        <div class="card shadow-0  rounded-3" style="margin: 0.5em;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                            <img src="../Assets//Files//Plant//<?php echo $row['plant_photo'] ?>" class="w-100" />
                            <a href="#!">
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h5 style="color: #830202;">
                            <?php echo $row['plant_name'] ?>
                        </h5>
                        <div class="d-flex flex-row">
                            <div class="text-danger mb-1 me-2">
                                <?php
                                include('../components/RatingStar.php');
                                ?>
                            </div>
                            &nbsp;
                            <span style="padding-top: 0.2em;color: #023683;">
                                <?php
                                $selQuerycount = $selQuery5 = "select * from tbl_plant_rating where plant_id=" . $row['plant_id'];
                                $resultcount = $conn->query($selQuerycount);
                                echo $resultcount->num_rows . " Reviews";
                                ?>
                            </span>
                        </div>
                        <div class="mt-1 mb-0 text-muted small">
                            <span style="color: #833602;">
                                <?php echo $row['plant_category_name'] ?>
                            </span>
                        </div>
                        <div class="mb-2 text-muted small">
                        </div>
                        <p class="text-truncate mb-4 mb-md-0" style="color: #2b2b2b;">
                            <?php echo $row['plant_description'] ?>
                        </p><br>
                        <?php
                        if ($row['plant_stock'] == 0) {
                            ?>
                            <p class="text-danger" style="font-weight: 800;">Out of stock</p>
                            <?php
                        } else {
                            ?>
                            <p style="color: #548302; font-weight: 800;">In stock</p>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 " style="border-left: solid 1px #548302;">
                        <div class="d-flex flex-row align-items-center mb-1">
                            <h4 class="mb-1 me-1" style="color: #02835c;">&#8377;&nbsp;
                                <?php echo $row['plant_price'] ?> /-
                            </h4>
                            <!-- <span class="text-danger"><s>$20.99</s></span> -->
                        </div>
                        <!-- <h6 class="text-success">Free shipping</h6> -->
                        <div class="d-flex flex-column mt-4">
                            <a href="./UserPlantViewMore.php?plant_view_id=<?php echo $row['plant_id'] ?>" class="btn  btn-sm"
                                type="button" style="background: #748302;color: #fff;">
                                Buy / View more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
        <?php
    }
} else {
    $selQuery = "select * from tbl_plant p inner join tbl_plant_category c on p.plant_category_id = c.plant_category_id left join tbl_shop s on s.shop_id = p.shop_id";
    $result = $conn->query($selQuery);
    while ($row = $result->fetch_assoc()) {
        ?>
        <!-- <div class="row justify-content-center mb-3"> -->
        <!-- <div class="col-md-12 col-xl-10"> -->
        <div class="card shadow-0  rounded-3" style="margin: 0.5em;">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                            <img src="../Assets//Files//Plant//<?php echo $row['plant_photo'] ?>" class="w-100" />
                            <a href="#!">
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h5 style="color: #830202;">
                            <?php echo $row['plant_name'] ?>
                        </h5>
                        <div class="d-flex flex-row">
                            <div class="text-danger mb-1 me-2">
                                <?php
                                include('../components/RatingStar.php');
                                ?>
                            </div>
                            &nbsp;
                            <span style="padding-top: 0.2em;color: #023683;">
                                <?php
                                $selQuerycount = $selQuery5 = "select * from tbl_plant_rating where plant_id=" . $row['plant_id'];
                                $resultcount = $conn->query($selQuerycount);
                                echo $resultcount->num_rows . " Reviews";
                                ?>
                            </span>
                        </div>
                        <div class="mt-1 mb-0 text-muted small">
                            <span style="color: #833602;">
                                <?php echo $row['plant_category_name'] ?>
                            </span>
                        </div>
                        <div class="mb-2 text-muted small">
                        </div>
                        <p class="text-truncate mb-4 mb-md-0" style="color: #2b2b2b;">
                            <?php echo $row['plant_description'] ?>
                        </p><br>
                        <?php
                        if ($row['plant_stock'] == 0) {
                            ?>
                            <p class="text-danger" style="font-weight: 800;">Out of stock</p>
                            <?php
                        } else {
                            ?>
                            <p style="color: #548302; font-weight: 800;">In stock</p>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 " style="border-left: solid 1px #548302;">
                        <div class="d-flex flex-row align-items-center mb-1">
                            <h4 class="mb-1 me-1" style="color: #02835c;">&#8377;&nbsp;
                                <?php echo $row['plant_price'] ?> /-
                            </h4>
                            <!-- <span class="text-danger"><s>$20.99</s></span> -->
                        </div>
                        <!-- <h6 class="text-success">Free shipping</h6> -->
                        <div class="d-flex flex-column mt-4">
                            <a href="./UserPlantViewMore.php?plant_view_id=<?php echo $row['plant_id'] ?>" class="btn  btn-sm"
                                type="button" style="background: #748302;color: #fff;">
                                Buy / View more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
        <!-- </div> -->
        <?php
    }
}

?>
<!-- </div> -->
<!-- view plant -->