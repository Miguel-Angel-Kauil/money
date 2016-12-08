<h2>Lista de categorias</h2>
<?php if(!empty($categories)): ?>
<table class="table table-striped">
	<tr>
		<th>Id</th>
		<th>Nombre</th>
        <th>Opciones</th>
	</tr>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo $category["categories"]["id"]; ?></td>
		<td><?php echo $category["categories"]["name"]; ?></td>

        <td>
            <?php echo $this->Html->link("Edit", array("controller"=>"categories","method"=>"edit","arg"=>$category["categories"]["id"]));?> |
            <?php echo $this->Html->link("Delete", array("controller"=>"categories","method"=>"delete","arg"=>$category["categories"]["id"]));?>
			<!--<a href="<?php echo APP_URL."/categories/edit/".$category["categories"]["id"]; ?>">Edit</a>-->
			<!--<a href="<?php echo APP_URL."/categories/delete/".$category["categories"]["id"]; ?>">Delete</a>-->
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<a href="categories/add" class="btn btn-info" role="button">Add Category</a>
<?php endif; ?>