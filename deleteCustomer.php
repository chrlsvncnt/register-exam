<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9f5f5; /* Light cyan background */
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #d50000; /* Red color for the warning header */
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            border: 1px solid #d50000; /* Red border for delete confirmation */
        }
        h2 {
            margin: 10px 0;
            color: #333; /* Dark gray for the text */
        }
        .deleteBtn {
            float: right;
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #d50000; /* Red color for delete button */
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #b00020; /* Darker red on hover */
        }
    </style>
<body>
	<h1>Do you really want to delete this user?</h1>
	<?php $getClientByID = getClientByID($pdo, $_GET['CustomerID']); ?>
	<div class="container" style="border-style: solid; height: 300px;">
		<h2>Client Name: <?php echo $getClientByID['CustomerName']; ?></h2>
		<h2>Contact Person: <?php echo $getClientByID['ContactNumber']; ?></h2>
		<h2>Email: <?php echo $getClientByID['Email']; ?></h2>
		<h2>Address: <?php echo $getClientByID['Address']; ?></h2>
		<h2>Store City: <?php echo $getClientByID['City']; ?></h2>
		<h2>Date Added: <?php echo $getClientByID['RegistrationDate']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form class="delete" action="core/handleForms.php?CustomerID=<?php echo $_GET['CustomerID']; ?>" method="POST">
				<input type="submit" name="deleteClientBtn" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>