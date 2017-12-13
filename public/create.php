<?php


if (isset($_POST['submit']))
{
	
	require "../config.php";
	require "../common.php";

	$connection = new PDO($dsn, $username, $password, $options);
		
		$new_product = array(
			"name" => $_POST['name'],
			"numbers"  => $_POST['numbers'],
			"color"     => $_POST['color'],
			"size"  => $_POST['size']
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"products",
				implode(", ", array_keys($new_product)),
				":" . implode(", :", array_keys($new_product))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_product);
	
}
?>

<?php require "templates/header.php"; ?>

<?php 
if (isset($_POST['submit'])) 
{ ?>
	<blockquote><?php echo $_POST['name']; ?> successfully added.</blockquote>
<?php 
} ?>

<h2>Add a product</h2>

<form method="post">
	<label for="name">Name</label>
	<input type="text" name="name" id="name">
	<label for="numbers">Number</label>
	<input type="text" name="numbers" id="numbers">
	<label for="color">Color</label>
	<input type="text" name="color" id="color">
	<label for="size">Size</label>
	<input type="text" name="size" id="size">
	<input type="submit" name="submit" value="Submit">
</form></br>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>