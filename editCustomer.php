<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
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
        a {
            text-decoration: none;
            color: #0077b6; /* Bright blue */
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        form p {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #a4c3b2; /* Soft green border */
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #0077b6; /* Bright blue */
            color: #ffffff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005f8b; /* Darker blue */
        }
    </style>
<body>
	<?php $getClientByID = getClientByID($pdo, $_GET['CustomerID']); ?>
	<h1>Update User Information</h1>
	<form action="core/handleForms.php?CustomerID=<?php echo $_GET['CustomerID']; ?>" method="POST">
		<p>
			<label for="firstName">Contact Person</label> 
			<input type="text" name="ContactNumber" value="<?php echo $getClientByID['ContactNumber']; ?>">
		</p>
		<p>
			<label for="firstName">Email</label> 
			<input type="text" name="Email" value="<?php echo $getClientByID['Email']; ?>">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="Address" value="<?php echo $getClientByID['Address']; ?>">
		</p>
		<p>
			<label for="firstName">Store Address</label> 
			<input type="text" name="City" value="<?php echo $getClientByID['City']; ?>">
			<input type="submit" name="editClientBtn">
		</p>
	</form>
</body>
</html>