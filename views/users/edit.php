<h2>Editar Usuario</h2>

<?php
//print_r($user);
?>

<form action="<?php echo APP_URL."/users/edit"; ?>" method="POST">
	<input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
    <div class="form-group">
        <label for="username">Username:</label>
        <input class="form-control" type="text" name="username" value="<?php echo $user["username"]; ?>">
        
    </div>
    <div class="form-group">
        <label for="newPassword">Password:</label>
        <input class="form-control" type="password" name="newPassword">
    </div>    
         <label for="type_id">Types</label>
        <select class="form-control" name="type_id" id="type_id">
            <?php
            foreach ($types as $type):
                if($type["types"]["id"]
                   == $user["type_id"]) { ?>
            <option selected value="<?php echo $type["types"]["id"];?>">
            <?php echo $type ["types"] ["name"];?>
            </option>
                    
                <?php }else{?>
            <option value="<?php echo $type["types"]["id"];?>">
            <?php echo $type ["types"] ["name"];?>
            </option>
           <?php }?>
            
            <?php endforeach;?>
        </select>
        <br>
        <button type="submit" class="btn btn-success">Update</button>
</form>