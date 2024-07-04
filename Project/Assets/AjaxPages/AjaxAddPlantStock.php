<?php
include("../Connection/connection.php");
$upQuery="update tbl_plant set plant_stock=".$_GET['pstock']." where plant_id =".$_GET['pid'];
if ($conn->query($upQuery)) {
    ?>
    <script>
        alert('Success')
    </script>
    <?php
}
?>