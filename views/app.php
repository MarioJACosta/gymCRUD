<?php
require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/navBar.php';
?>

<div class="row-fluid">
    <div class="col-sm-8 col-md-8 col-lg-6">

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
            <li><a data-toggle="tab" href="#plans">Plans</a></li>
            <li><a data-toggle="tab" href="#workouts">Workouts</a></li>
            <li><a data-toggle="tab" href="#exercises">Exercises</a></li>
        </ul>

        <div class="tab-content">

            <div id="users" class="tab-pane active">
                <?php
                include_once dirname(__FILE__) . '/usersTable.php';
                ?>
            </div>

            <div id="plans" class="tab-pane">
                <?php
                include_once dirname(__FILE__) . '/plansTable.php';
                ?>
            </div>

            <div id="workouts" class="tab-pane">
                <?php
                include_once dirname(__FILE__) . '/workoutsTable.php';
                ?>
            </div>

            <div id="exercises" class="tab-pane">
                <?php
                include_once dirname(__FILE__) . '/exercisesTable.php';
                ?>
            </div>
        </div>
    </div>
</div>

</div>
</body>
</html>
