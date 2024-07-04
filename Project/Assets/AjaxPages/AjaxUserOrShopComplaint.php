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
                <th scope="col">User</th>
                <th scope="col">Time</th>
                <th scope="col">Reply</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selQuery = "select * from tbl_admin_complaint ac inner join tbl_complaint_type ct
                                on ac.complaint_type_id=ct.complaint_type_id 
                                inner join tbl_user u on ac.user_id=u.user_id
                                 where admin_complaint_del_status != 1 and shop_id=0";
            $result = $conn->query($selQuery);
            $count = $result->num_rows;
            $tempCount = 0;
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
                            <?php echo $row['user_name'] ?>
                        </td>
                        <td>
                            <?php

                            $currentTime = $row['admin_complaint_time'];
                            $time = date_format(date_create($currentTime), 'd-m-Y | h:i a');
                            echo $time;
                            ?>
                        </td>
                        <td>
                            <textarea style="border: none;outline: none;" name="txt_admin_complaint_reply" id="" cols="30" rows="5"
                                placeholder="Add Reply"
                                onchange="addReply(<?php echo $row['admin_complaint_id'] ?>,this.value)"><?php echo $row['admin_complaint_reply'] ?></textarea>
                        </td>
                        <td>
                            <a class="btn btn-primary"
                                href="./AdminComplaint.php?cidD=<?php echo $row['admin_complaint_id'] ?>">Delete</a>
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
} else {
    ?>
    <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="" style="color: #548302;">
                <th scope="col">Sl no</th>
                <th scope="col">Complaint</th>
                <th scope="col">Complaint type</th>
                <th scope="col">Shop</th>
                <th scope="col">Time</th>
                <th scope="col">Reply</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selQuery = "select * from tbl_admin_complaint ac inner join tbl_complaint_type ct
                                on ac.complaint_type_id=ct.complaint_type_id 
                                left join tbl_shop s on ac.shop_id=s.shop_id
                                 where admin_complaint_del_status != 1 and user_id=0";
            $result = $conn->query($selQuery);
            $count = $result->num_rows;
            $tempCount = 0;
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
                            <?php echo $row['shop_name'] ?>
                        </td>
                        <td>
                            <?php
                            $currentTime = $row['admin_complaint_time'];
                            $time = date_format(date_create($currentTime), 'd-m-Y | h:i a');
                            echo $time;
                            ?>
                        </td>
                        <td>
                            <textarea style="border: none;outline: none;" name="txt_admin_complaint_reply" id="" cols="30" rows="5"
                                placeholder="Add Reply"
                                onchange="addReply(<?php echo $row['admin_complaint_id'] ?>,this.value)"><?php echo $row['admin_complaint_reply'] ?></textarea>
                        </td>
                        <td>
                            <a class="btn btn-primary"
                                href="./AdminComplaint.php?cidD=<?php echo $row['admin_complaint_id'] ?>">Delete</a>
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