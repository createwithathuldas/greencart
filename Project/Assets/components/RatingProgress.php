<div class="row">
    <?php
    $selQuery = "select * from tbl_plant_rating where plant_id=".$plant['plant_id'];
    $resultr = $conn->query($selQuery);
    $totalr = $resultr->num_rows;
    for($i = 5; $i >= 1; $i--) {
        $selQuery = "select * from tbl_plant_rating where plant_rating_star=$i and plant_id=".$plant['plant_id'];
        $resultr = $conn->query($selQuery);
        if($resultr->num_rows) {
            ?>
            <div class="side">
                <div>
                    <?php echo $i ?> star
                </div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-<?php echo $i ?>"
                        style="width: <?php echo floor(($resultr->num_rows / $totalr) * 100); ?>%; "></div>
                </div>
            </div>
            <div class="side right">
                <div>
                    <?php
                    echo $resultr->num_rows;
                    ?>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="side">
                <div>
                    <?php echo $i ?> star
                </div>
            </div>
            <div class="middle">
                <div class="bar-container">
                    <div class="bar-<?php echo $i ?>"
                        style="width: 0%; "></div>
                </div>
            </div>
            <div class="side right">
                <div>
                    <?php
                    echo $resultr->num_rows;
                    ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>