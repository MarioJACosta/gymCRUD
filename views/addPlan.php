<form method="POST" action='addPlan'>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required autofocus>
    </div>
    <div class="form-group">
        <label for="workoutSelect">Select Workouts:</label>

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

    <button type="submit" class="btn btn-default">Create</button>
    <button class="btn btn-default right"><a href="plans">Cancel</a></button>
</form>

