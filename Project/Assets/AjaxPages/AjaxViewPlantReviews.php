<?php
ob_start();
session_start();
include("../Connection/connection.php");
$selQueryRU = "select * from tbl_plant_rating r inner join tbl_user u on r.user_id=u.user_id where plant_id =" . $_GET['plantID'] . " and u.user_id = " . $_SESSION['uid'] . " and plant_rating_star=" . $_GET['plantRatingStar'];
$resultRU = $conn->query($selQueryRU);
if ($resultRU->num_rows) {
    $dataRU = $resultRU->fetch_assoc();
    ?>
    <h6 style="color:#000; ">
        You
    </h6>
    <?php
    if ($dataRU['plant_rating_star'] == 5) {
        ?>
        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <?php
    } else if ($dataRU['plant_rating_star'] == 4) {
        ?>
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <?php
    } else if ($dataRU['plant_rating_star'] == 3) {
        ?>
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <?php
    } else if ($dataRU['plant_rating_star'] == 2) {
        ?>
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <?php
    } else if ($dataRU['plant_rating_star'] == 1) {
        ?>
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
        <?php
    }
    ?>
    <p>
        <?php echo $dataRU['plant_rating_user_review'] ?>
    </p>
    <?php
}

$selQueryR = "select * from tbl_plant_rating r 
inner join tbl_user u on r.user_id=u.user_id 
where plant_id =" . $_GET['plantID'] . " and plant_rating_star=" . $_GET['plantRatingStar'];
$resultR = $conn->query($selQueryR);
if ($resultR->num_rows) {
    while ($rowR = $resultR->fetch_assoc()) {
        ?>
        <h6 style="color:#000; ">
            <?php
            if ($rowR['user_id'] == $_SESSION['uid']) {
                continue;
            }
            echo $rowR['user_name'];

            ?>
        </h6>
        <?php
        if ($rowR['plant_rating_star'] == 5) {
            ?>
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <?php
        } else if ($rowR['plant_rating_star'] == 4) {
            ?>
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <?php
        } else if ($rowR['plant_rating_star'] == 3) {
            ?>
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <?php
        } else if ($rowR['plant_rating_star'] == 2) {
            ?>
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <?php
        } else if ($rowR['plant_rating_star'] == 1) {
            ?>
                            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
            <?php
        }
        ?>
        <p>
            <?php echo $rowR['plant_rating_user_review'] ?>
        </p>
        <?php
    }
} else if ($_GET['plantRatingStar'] == 0) {
    $selQueryR = "select * from tbl_plant_rating r 
    inner join tbl_user u on r.user_id=u.user_id 
    where plant_id =" .$_GET['plantID'];
    $resultR = $conn->query($selQueryR);
    if ($resultR->num_rows) {
        while ($rowR = $resultR->fetch_assoc()) {
            ?>
                <h6 style="color:#000; ">
                    <?php
                    if ($rowR['user_id'] == $_SESSION['uid']) {
                        echo 'You';
                    } else {
                        echo $rowR['user_name'];
                    }
                    ?>
                </h6>
                <?php
                if ($rowR['plant_rating_star'] == 5) {
                    ?>
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <?php
                } else if ($rowR['plant_rating_star'] == 4) {
                    ?>
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                        <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <?php
                } else if ($rowR['plant_rating_star'] == 3) {
                    ?>
                            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                            <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <?php
                } else if ($rowR['plant_rating_star'] == 2) {
                    ?>
                                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                                <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <?php
                } else if ($rowR['plant_rating_star'] == 1) {
                    ?>
                                    <img src="../Assets//Img//Rating//star_full.png" alt="" height="15em">
                <?php
                }
                ?>
                <p>
                <?php echo $rowR['plant_rating_user_review'] ?>
                </p>
            <?php
        }
    } else {
        ?>
            No reviews
        <?php
    }
} else {
    ?>
        No reviews
    <?php
}
?>