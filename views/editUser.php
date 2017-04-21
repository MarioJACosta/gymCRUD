<?php
require_once dirname(__FILE__) . '/header.php';
?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <form method="POST" action="user/<?php echo $user['id'] ?>">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value=<?php echo $user['First_Name'] ?> required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value=<?php echo $user['Last_Name'] ?> required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email" value=<?php echo $user['Email'] ?> required>
                    </div>
                    <div class="form-group">
                        <label for="plans">Plans:</label>        
                        <select class="form-control" id="plans" name="plan">
                            <?php
                            foreach ($plans as $plan) {
                                ?>
                                <option value="<?php echo $plan['id'] ?>"><?php echo $plan['Name'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Edit</button>
                    <button class="btn btn-default right"><a href="users">Cancel</a></button>
                </form>
            </div>
        </div>
    </div>
