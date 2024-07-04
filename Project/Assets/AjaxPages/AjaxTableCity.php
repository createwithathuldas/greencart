<?php
include('../Connection/connection.php');
if ($_GET['did'] != 0) {
    $selQuery = "select * from tbl_city p inner join tbl_district d on p.district_id = d.district_id where p.district_id=" . $_GET['did'] . " order by p.city_name";
    $result = $conn->query($selQuery);
    $count = $result->num_rows;
    $tempCount = 0;
    if ($result->num_rows) {
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $i++;
            if ($row['city_del_status'] == false) {
?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['city_name'] ?></td>
                    <td><a class="btn btn-sm btn-primary" href="./AdminCity.php?pid=<?php echo $row['city_id'] ?>">Delete</a></td>
                </tr>
            <?php

            } else {
                $tempCount++;
            }
        }
        if ($tempCount == $count) {
            ?>
            <tr>
                <th colspan="4" style="text-align: center;">No data available</th>
            </tr>
        <?php
        }
    } else {
        ?>
        <tr>
            <th colspan="4" style="text-align: center;">No data available</th>
        </tr>
    <?php
    }
} else {
    ?>
    <tr>
        <th colspan="4" style="text-align: center;">Select district to view cities</th>
    </tr>
<?php
}
?>