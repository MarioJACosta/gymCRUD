<?php
require_once dirname(__FILE__) . '/header.php';
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <form method="POST" action="plan/<?php echo $plan['id'] ?>">
                <div class="form-group">
                    <label for="planName">Plan Name:</label>
                    <input type="text" class="form-control" id="planName" name="planName" value=<?php echo $plan['Name'] ?> required autofocus>
                </div>

                <div class="form-group">
                    <label for="workoutsPlan">Workouts:</label>        
                        <?php
                        foreach ($workouts as $workout) {
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="workouts[]" value="<?php echo $workout['id'] ?>"><?php echo $workout['Name'] ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                </div>
                <button type="submit" class="btn btn-default">Edit</button>
                <button class="btn btn-default right"><a href="plans">Cancel</a></button>
            </form>
        </div>
    </div>
</div>
