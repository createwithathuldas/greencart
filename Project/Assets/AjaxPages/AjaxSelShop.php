<?php
include('../Connection/connection.php');
$selQuery = "select * from tbl_complaint_type where complaint_type_id=" . $_GET['ctId'];
$result = $conn->query($selQuery);
$data = $result->fetch_assoc();
if ($data['complaint_type_status'] == 2) {
    ?>
    <select name="sel_shop" id="" class="form-select" style="text-align: center;">
        <option value="">----Select shop----</option>
        <?php
        $selQuery = "select * from tbl_shop where shop_status=1";
        $result = $conn->query($selQuery);
        while ($row = $result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row['shop_id'] ?>">
                <?php echo $row['shop_name'] ?>
            </option>
            <?php
        }
        ?>
    </select>
    <?php
}
?>