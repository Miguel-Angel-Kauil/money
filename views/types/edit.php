<h2>Editar tipo de usuario</h2>

<form action="<?php echo APP_URL."/types/edit"; ?>" method="POST">
	<input type="hidden" name="id" value="<?php echo $type["id"]; ?>">
   
    <div class="form-group">
        <label for="name">name:</label>
        <input class="form-control" type="text" name="name" value="<?php echo $type["name"]; ?>">
    </div>
    <br>
        <button type="submit" class="btn btn-success">Update</button>
    

</form>