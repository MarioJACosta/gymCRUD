<?php
require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/navBar.php';
?>
<div class="col-sm-3">
    <div class="widget widget-blue">
        <h2>
            <i class="fa fa-home"></i>
            User Details
        </h2>
        <div class="details">
            <div>
                <div>
                    Name
                </div>
                <div>
                    <?php echo $userDetails['First_Name'] . ' ' . $userDetails['Last_Name'] ?>
                </div>
            </div>
            <div>
                <div>
                    Email
                </div>
                <div>
                    <?php echo $userDetails['Email'] ?>
                </div>
            </div>
            <?php
            foreach ($userDetails['Plan'] as $value) {
                ?>              

                <div>
                    <div>
                        Plan
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

<div class="col-sm-3">
    <div class="widget widget-red">
        <h2>
            <i class="fa fa-home"></i>
            Plan Details
        </h2>
        <div class="details">

            <?php
            if (!is_null($userDetails['Workout'])) {
                foreach ($userDetails['Workout'] as $value) {
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
    foreach ($userDetails['Workout'] as $value) {
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
}
?>
