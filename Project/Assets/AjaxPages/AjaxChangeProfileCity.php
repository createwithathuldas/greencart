<?php
include('../Connection/connection.php');
ob_start();
session_start();

$selQUery = "select * from tbl_city where district_id=" . $_GET['did'] . " order by city_name";
$result = $conn->query($selQUery);
if ($result->num_rows) {
    ?>
    <label class="control-label" for="date">City</label><br><br>
    <select class="form-select" required name="sel_city" style="background: none;">
        <option value="" style="text-align: center;">---Select City---</option>
        <?php
        while ($row = $result->fetch_assoc()) {
            if ($row['city_id'] == $_GET['cid']) {
                ?>
                <option value=<?php echo $row['city_id']; ?> selected>
                    <?php echo $row['city_name']; ?>
                </option>
                <?php
                continue;
            }
            ?>
            <option value="<?php echo $row['city_id'] ?>">
                <?php echo $row['city_name'] ?>
            </option>
            <?php
        }
        ?>
    </select>
    <?php
    ob_flush();
} else {
    ?>
    <label class="control-label" for="date">City</label><br><br>
    <select class="form-select" required name="sel_city" style="background: none;" disabled>
        <option value="">No available</option>
    </select>
    <?php
}
?>