<?php
require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/navBar.php';
?>

<div class="col-sm-3">
    <div class="widget widget-green">
        <h2>
            <i class="fa fa-home"></i>
            <?php echo $workoutDetails['Name']; ?> Details
        </h2>
        <div class="details">
            <?php
            foreach ($workoutDetails['Exercises'] as $value) {
                ?>
                <div>
                    <div>
                        Exercise
                    </div>
                    <div>
                        <?php echo $value['Name']; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
