<h2>Edit Accounts</h2>
<form action="<?php echo APP_URL."/accounts/edit"; ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $account["id"]; ?>">
    <div class="form-group">
    	<label for="user_id">Username:</label>
        <select class="form-control" name="user_id" id="user_id">
            <?php foreach ($users as $user):if ($user["users"]["id"] == $account["user_id"]) { ?>
                <option selected value="<?php echo $user["users"]["id"]; ?>">
                    <?php echo $user["users"]["username"]; ?>
                </option>
            <?php } else { ?>
                <option value="<?php echo $user["users"]["id"]; ?>">
                    <?php echo $user["users"]["username"]; ?>
                </option>
            <?php
                }
                endforeach;
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="name">name:</label>
        <input class="form-control" type="text" name="name" value="<?php echo $account["name"]; ?>">
    </div>
        <button type="submit" class="btn btn-success">Update</button>   
</form>