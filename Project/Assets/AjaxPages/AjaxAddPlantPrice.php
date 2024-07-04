<?php
include("../Connection/connection.php");
$upQuery="update tbl_plant set plant_price=".$_GET['pprice']." where plant_id =".$_GET['pid'];
if ($conn->query($upQuery)) {
    ?>
    <script>
        alert('Success')
    </script>
    <?php
}
?>