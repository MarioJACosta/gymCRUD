<?php
require_once dirname(__FILE__) . '/header.php';
?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <form method="POST" action="exercise/<?php echo $exercise['id'] ?>">
                <div class="form-group">
                    <label for="exerciseName">Exercise Name:</label>
                    <input type="text" class="form-control" id="exerciseName" name="exerciseName" value=<?php echo $exercise['Name'] ?> required autofocus>
                </div>
                <button type="submit" class="btn btn-default">Edit</button>
                <button class="btn btn-default right"><a href="exercises">Cancel</a></button>
            </form>
        </div>
    </div>
</div>
