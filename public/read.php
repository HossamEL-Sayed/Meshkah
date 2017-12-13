<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) 
{
	
	try 
	{
		
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM products
						WHERE name = :name";

		$location = $_POST['name'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':name', $location, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) 
{
	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Number</th>
					<th>Color</th>
					<th>Size</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{ ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["name"]); ?></td>
				<td><?php echo escape($row["numbers"]); ?></td>
				<td><?php echo escape($row["color"]); ?></td>
				<td><?php echo escape($row["size"]); ?></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['name']); ?>.</blockquote>
	<?php
	} 
}?> 

<h2>Find product by name</h2>

<form method="post">
	<label for="name">Name</label>
	<input type="text" id="name" name="name">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>