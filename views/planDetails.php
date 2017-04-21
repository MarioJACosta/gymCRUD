<?php
require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/navBar.php';
?>

<div class="col-sm-3">
    <div class="widget widget-red">
        <h2>
            <i class="fa fa-home"></i>
            Plan Details
        </h2>
        <div class="details">
            <div>
                <div>
                    Name
                </div>
                <div>
                    <?php echo $planDetails['Name'] ?>
                </div>
            </div>
            <?php
            foreach ($planDetails['Workouts'] as $value) {
                ?>
                <div>
                    <div>
                        Workout
                    </div>
                    <div>
                        <?php echo $value['Name'] ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
foreach ($planDetails['Workouts'] as $value) {
    ?>
    <div class="col-sm-3">
        <div class="widget widget-green">
            <h2>
                <i class="fa fa-home"></i>
                <?php echo $value['Name']; ?> Details
            </h2>
            <div class="details">
                <?php
                foreach ($value['Exercises'] as $value) {
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
    <?php
}
?>