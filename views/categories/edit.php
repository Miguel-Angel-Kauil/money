<h2>Edit category</h2>

<form action="<?php echo APP_URL."/categories/edit"; ?>" method="POST">
	<input type="hidden" name="id" value="<?php echo $category["id"]; ?>">
    <div class="form-group">
        <label for="name">Name Category:</label>
        <input class="form-control" type="text" name="name" value="<?php echo $category["name"]; ?>">
    </div>
    <br>
       <button type="submit" class="btn btn-success">Update</button>
</form>