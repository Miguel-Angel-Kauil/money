<h2>Agregar Acounts</h2>

<form action="<?php echo APP_URL."/accounts/add"; ?>" method="POST">
    <div class="form-group">
        <label for="id">Usuario</label>
        <select class="form-control" name="user_id">
            <?php
            foreach ($users as $user):?>
            <option value="<?php echo $user["users"]["id"];?>">
                <?php echo $user ["users"] ["username"];?>
            </option>
            <?php endforeach;?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input class="form-control" type="text" name="name">
    </div>
    <br>
    
        <button type="submit" class="btn btn-primary">ADD</button>

</form>