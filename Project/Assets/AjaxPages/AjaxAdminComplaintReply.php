<?php

    include("../Connection/connection.php");
    $complaint_id=$_GET['aCid'];
    $complaint_reply=$_GET['aReply'];
    $upQuery="update tbl_admin_complaint set admin_complaint_reply='$complaint_reply' where admin_complaint_id=$complaint_id";
    $conn->query($upQuery);

?>