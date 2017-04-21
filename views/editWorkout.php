<?php
require_once dirname(__FILE__) . '/header.php';
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <form method="POST" action="workout/<?php echo $workout['id'] ?>">
                <div class="form-group">
                    <label for="workoutName">Workout Name:</label>
                    <input type="text" class="form-control" id="workoutName" name="workoutName" value="<?php echo $workout['Name'] ?>" required autofocus>
                </div>

                <div class="form-group">
                    <label>Exercises:</label>        
                        <?php
                        foreach ($exercises as $exercise) {
                            ?>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="exercises[]" value="<?php echo $exercise['id'] ?>"><?php echo $exercise['Name'] ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                </div>
                <button type="submit" class="btn btn-default">Edit</button>
                <button class="btn btn-default right"><a href="workouts">Cancel</a></button>
            </form>
        </div>
    </div>
</div>
