<?php
include('../Connection/connection.php');

if ($_GET['value'] == 1) {
    ?>
    <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="" style="color: #548302;">
                <th scope="col">Sl no</th>
                <th scope="col">Complaint</th>
                <th scope="col">Complaint type</th>
                <th scope="col">Time</th>
                <th scope="col">Reply</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selQuery = "select * from tbl_admin_complaint ac inner join tbl_complaint_type ct
                                on ac.complaint_type_id=ct.complaint_type_id  where shop_id=0 and admin_complaint_del_status != 2";
            $result = $conn->query($selQuery);
            if ($result->num_rows) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            <?php echo $row['admin_complaint_content'] ?>
                        </td>
                        <td>
                            <?php echo $row['complaint_type_name'] ?>
                        </td>
                        <td>
                            <?php

                            $currentTime = $row['admin_complaint_time'];
                            $time = date_format(date_create($currentTime), 'd-m-Y | h:i a');
                            echo $time;
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row['admin_complaint_reply'] == "" || $row['admin_complaint_reply'] == null) {
                                echo 'No reply';
                            } else {
                                echo $row['admin_complaint_reply'];
                            }
                            ?>
                        </td>
                        <td>
                            <a href="./UserComplaint.php?AcidD=<?php echo $row['admin_complaint_id'] ?>"
                                class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <th colspan="6" style="text-align: center;">No data available</th>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="" style="color: #548302;">
                <th scope="col">Sl no</th>
                <th scope="col">Complaint</th>
                <th scope="col">Complaint type</th>
                <th scope="col">Time</th>
                <th scope="col">Shop</th>
                <th scope="col">Reply</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selQuery = "select * from tbl_shop_complaint sc inner join tbl_complaint_type ct
                                on sc.complaint_type_id=ct.complaint_type_id
                                left join tbl_shop s on sc.shop_id=s.shop_id where shop_complaint_del_status != 2";
            $result = $conn->query($selQuery);
            if ($result->num_rows) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            <?php echo $row['shop_complaint_content'] ?>
                        </td>
                        <td>
                            <?php echo $row['complaint_type_name'] ?>
                        </td>
                        <td>
                            <?php
                            $currentTime = $row['shop_complaint_time'];
                            $time = date_format(date_create($currentTime), 'd-m-Y | h:i a');
                            echo $time;
                            ?>
                        </td>
                        <td>
                            <?php echo $row['shop_name'] ?>
                        </td>
                        <td>
                            <?php
                            if ($row['shop_complaint_reply'] == "" || $row['shop_complaint_reply'] == null) {
                                echo 'No reply';
                            } else {
                                echo $row['shop_complaint_reply'];
                            }
                            ?>
                        </td>
                        <td>
                            <a href="./UserComplaint.php?ScidD=<?php echo $row['shop_complaint_id'] ?>"
                                class="btn btn-primary">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <th colspan="7" style="text-align: center;">No data available</th>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
}

?>