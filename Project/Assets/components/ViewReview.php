<?php
$selQueryRU = "select * from tbl_plant_rating r inner join tbl_user u on r.user_id=u.user_id where plant_id =" . $plant['plant_id'] . " and u.user_id = " . $data['user_id'];
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
$selQueryR = "select * from tbl_plant_rating r inner join tbl_user u on r.user_id=u.user_id where plant_id =" . $plant['plant_id'];
$resultR = $conn->query($selQueryR);
if ($resultR->num_rows) {
    while ($rowR = $resultR->fetch_assoc()) {
        ?>
        <h6 style="color:#000; ">
            <?php
            if ($rowR['user_id'] == $data['user_id']) {
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
} else {
    ?>
    No reviews
    <?php
}
?>