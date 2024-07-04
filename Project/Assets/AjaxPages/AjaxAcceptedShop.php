<?php
include("../Connection/connection.php");

$selQuery = "select * from tbl_shop s inner join tbl_city p on s.city_id=p.city_id  inner join tbl_district d on p.district_id=d.district_id  where shop_id =" . $_GET["shopId"];
$result = $conn->query($selQuery);

while ($row = $result->fetch_assoc()) {
?>

    <form action="" method="post">
        <div class="col-lg-12 mb-4 mb-sm-5">
            <div class="card card-style1 border-0">
                <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <img src="../Assets//Files//Shop//Photo/<?php echo $row['shop_photo'] ?>" alt="..." height="400" style="border-radius: 0.8em;">
                        </div>
                        <div class="col-lg-6 px-xl-10">
                            <div class="d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                <h3 class="h2 mb-0" style="color: #548302;"><?php echo $row['shop_name'] ?></h3>
                            </div>
                            <ul class="list-unstyled mb-1-9">
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Address:</span> <?php echo $row['shop_address'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Pincode:</span> <?php echo $row['shop_pincode'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">City:</span> <?php echo $row['city_name'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">District:</span> <?php echo $row['district_name'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Contact number:</span> <?php echo $row['shop_contactno'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span> <?php echo $row['shop_email'] ?></li>
                                <li class="mb-2 mb-xl-3 display-28"><a class="btn btn-primary" href="../Assets//Files//Shop//Proof/<?php echo $row['shop_proof'] ?>" role="button">View proof</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php
}
?>