<hr>
<h5 class="" style="color:#2b2b2e; ">Ratings and Reviews</h5>
<?php
$selQuery1 = "select * from tbl_plant_rating where plant_id=" . $plant['plant_id'] . " and plant_rating_star=1";
$result1 = $conn->query($selQuery1);
$star1Count = $result1->num_rows;

$selQuery2 = "select * from tbl_plant_rating where plant_id=" . $plant['plant_id'] . " and plant_rating_star=2";
$result2 = $conn->query($selQuery2);
$star2Count = $result2->num_rows;

$selQuery3 = "select * from tbl_plant_rating where plant_id=" . $plant['plant_id'] . " and plant_rating_star=3";
$result3 = $conn->query($selQuery3);
$star3Count = $result3->num_rows;

$selQuery4 = "select * from tbl_plant_rating where plant_id=" . $plant['plant_id'] . " and plant_rating_star=4";
$result4 = $conn->query($selQuery4);
$star4Count = $result4->num_rows;

$selQuery5 = "select * from tbl_plant_rating where plant_id=" . $plant['plant_id'] . " and plant_rating_star=5";
$result5 = $conn->query($selQuery5);
$star5Count = $result5->num_rows;


if ($star1Count > 0 || $star2Count > 0 || $star3Count > 0 || $star4Count > 0 || $star5Count > 0) {
    $rating = ($star1Count * 1 + $star2Count * 2 + $star3Count * 3 + $star4Count * 4 + $star5Count * 5) / ($star1Count + $star2Count + $star3Count + $star4Count + $star5Count);

    if ($rating > 0) {
    ?>


        <span style="color: #241700;font-size: 55pt;font-weight: 500;font-family: monospace;">
        <?php echo number_format($rating,1) ?><span style="font-size:32pt;"></span>
    </span>
        <span style="color: #241700;font-size: 15pt;font-weight: 700;">
        Ratings
        </span>
    <?php
    }  else {
    ?>
        <br>
        <br>
        <span style="color: #000;font-size: 15pt;font-weight: 700;">No ratings</span>
    <?php
    }
} else {
    ?>
    <img src="../Assets//Img//Rating//star_empty.png" alt="" height="40em">
    <img src="../Assets//Img//Rating//star_empty.png" alt="" height="40em">
    <img src="../Assets//Img//Rating//star_empty.png" alt="" height="40em">
    <img src="../Assets//Img//Rating//star_empty.png" alt="" height="40em">
    <img src="../Assets//Img//Rating//star_empty.png" alt="" height="40em">
    <br>
    <br>
    <span style="color: #000;font-size: 15pt;font-weight: 200;opacity: 0.7;">No ratings</span>
<?php
}
?>