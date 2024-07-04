<?php

    include("../Connection/connection.php");
    $complaint_id=$_GET['sCid'];
    $complaint_reply=$_GET['sReply'];
    $upQuery="update tbl_shop_complaint set shop_complaint_reply='$complaint_reply' where shop_complaint_id=$complaint_id";
    $conn->query($upQuery);

?>