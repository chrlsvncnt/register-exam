<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
        }
        .client {
            background: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-top: 0;
        }
        form p {
            margin: 10px 0;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        table {
            width: 85%;
            margin: 50px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        a {
            color: #337ab7;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
<body>
    <header>
        <a href="index.php">Return to home</a>
        <a href="">About Us</a> 
        <a href="">Contact</a> 
    </header>
	
	<?php $getAllOrderByCustomerID = getAllOrderByCustomerID($_GET['CustomerID']); ?>
	<div class="client" style="text-align: left;">
		<h3 style="margin-bottom: 10px;">Add New Shipment</h3>
		<form action="core/handleForms.php?CustomerID=<?php echo $_GET['CustomerID']; ?>" method="POST">
			<p>
				<label for="ProductName">Product Name</label> 
				<input type="text" name="ProductName" required>
			</p>
			<p>
				<label for="Size">Size</label> 
				<input type="text" name="Size" required>
			</p>
			<p>
				<label for="Color">Color</label> 
				<input type="text" name="Color" required>
			</p>
			<p>
				<label for="Price">Price</label> 
				<input type="text" name="Price" required>
			</p>
			<p>
				<label for="StockQuantity">Stock Quantity</label> 
				<input type="text" name="StockQuantity" required>
			</p>
			<input type="submit" name="insertNewShipmentBtn" value="Add Shipment">
		</form>
	</div>

	<table style="width:85%; margin-top: 50px;">
	  <tr>
	    <th>Product ID </th>
	    <th>Product Name</th>
		<th>Size</th>
	    <th>Color</th>
		<th>Price</th>
		<th>Stock Quantity</th>
	    <th>Customer Name</th>
	    <th>Shipment Date</th>
	    <th>Action</th>
	  </tr>
	  <?php $getShipmentByClient = getShipmentByClient($pdo, $_GET['CustomerID']); ?>
	  <?php foreach ($getShipmentByClient as $row) { ?>
	  <tr>
	  	<td><?php echo $row['ProductID']; ?></td>	  	
	  	<td><?php echo $row['ProductName']; ?></td>	  
		<td><?php echo $row['Size']; ?></td>	 	
	  	<td><?php echo $row['Color']; ?></td>
		<td><?php echo $row['Price']; ?></td>	
		<td><?php echo $row['StockQuantity']; ?></td>	  	  	
	  	<td><?php echo $row['CustomerName']; ?></td>	  	
	  	<td><?php echo $row['dateRegistered']; ?></td>
	  	<td>
	  		<a href="editOrder.php?ProductID=<?php echo $row['ProductID']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>">Edit</a>
	  		<a href="deleteOrder.php?ProductID=<?php echo $row['ProductID']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>
</body>
</html>
