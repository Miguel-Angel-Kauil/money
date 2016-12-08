
<h2>Lista de usuarios:</h2>
<!--<h4>Número de usuarios: </h4><?php echo $usersCount; ?>
<?php if(!empty($users)): ?> -->
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Password</th>
		<th>Type</th>
		<th>Options</th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo $user["users"]["id"]; ?></td>
		<td><?php echo $user["users"]["username"]; ?></td>
		<td><?php echo $user["users"]["password"]; ?></td>
		<td><?php echo $user["types"]["name"]; ?></td>
		
		
		<td><?php echo $this->Html->link("Edit", array("controller"=>"users","method"=>"edit","arg"=>$user["users"]["id"]));?> |
            <?php echo $this->Html->link("Delete", array("controller"=>"users","method"=>"delete","arg"=>$user["users"]["id"]));?>
			<!--<a href="<?php echo APP_URL."/users/edit/".$user["users"]["id"]; ?>">Edit</a>-->
			<!--<a href="<?php echo APP_URL."/users/delete/".$user["users"]["id"]; ?>">Delete</a>-->
        
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<a href="users/add" class="btn btn-info" role="button">Add Users</a>

<?php endif; ?>