<?php
include('../Connection/connection.php');
$selQUery = "select * from tbl_city where district_id=" . $_GET['did']." order by city_name";
$result = $conn->query($selQUery);
if ($result->num_rows) {
?>
    <label class="control-label" for="date">City</label>
    <select class="form-select" required name="sel_city" style="background: none;">
        <option value="">---Select City---</option>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <option value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name'] ?></option>
        <?php
        }
        ?>
    </select>
<?php
}
?>
