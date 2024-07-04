<?php
include("./AjaxPlantCountPrice.php");
include("../Connection/connection.php");
$selQuery = "select * from tbl_cart cr inner join tbl_plant p on cr.plant_id=p.plant_id where cart_id =" . $_GET['crId'];
$itemCount = $_GET['itemCount'];
$result = $conn->query($selQuery);
$data=$result->fetch_assoc();
?>
<?php
?>