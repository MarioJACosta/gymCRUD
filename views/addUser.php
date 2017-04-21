<form method="POST" action='addUser'>
    <div class="form-group">
        <label for="firstName">First Name:</label>
        <input type="text" class="form-control" id="firstName" name="firstName" required autofocus>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name:</label>
        <input type="text" class="form-control" id="lastName" name="lastName" required>
    </div>
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="planSelect">Select Plan:</label>
        <select class="form-control" id="planSelect" name="planSelect">
            <?php
            foreach ($plans as $plan) {
                ?>
                <option value=<?php echo $plan['id']; ?>><?php echo $plan['Name']; ?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-default">Create</button>
    <button class="btn btn-default right"><a href="users">Cancel</a></button>
</form>

