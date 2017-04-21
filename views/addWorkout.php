
<form method="POST" action='addWorkout'>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required autofocus>
    </div>
    <div class="form-group">
        <label required>Select Exercises:</label>

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

    <button type="submit" class="btn btn-default">Create</button>
    <button class="btn btn-default right"><a href="workouts">Cancel</a></button>
</form>