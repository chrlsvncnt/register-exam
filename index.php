<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<header>
    <a href="index.php">Home</a>
    <a href="">About Us</a> 
    <a href="">Contact</a> 
    <a href="logout.php" style="
        background-color: #d50000;
        color: #fff;
        padding: 8px 15px;
        border-radius: 4px;
        margin-left: 15px;
    ">Logout</a>
</header>

	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Light background for better contrast */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }

        h1 {
            color: #03ADC5;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        form {
            background-color: #fff; /* White background for forms */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #555; /* Darker text for better readability */
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px; /* Increased padding for a better touch area */
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9; /* Light gray for inputs */
            color: #333;
            font-size: 14px;
            margin-bottom: 10px;
            transition: border 0.3s; /* Smooth transition for focus */
        }

        input[type="text"]:focus {
            border: 1px solid #03ADC5; /* Highlight on focus */
            outline: none;
        }

        input[type="submit"] {
            background-color: #03ADC5;
            color: #ffffff;
            border: none;
            width: 100%;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #018da0;
        }

        .container {
            background-color: #fff; /* White background for customer details */
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }

        .container h3 {
            font-size: 16px;
            margin: 10px 0;
            color: #333; /* Dark text for better visibility */
        }

        .editAndDelete {
            margin-top: 15px;
            text-align: right;
        }

        .editAndDelete a {
            text-decoration: none;
            color: #03ADC5;
            font-weight: bold;
            margin-left: 10px;
            transition: color 0.3s;
        }

        .editAndDelete a:hover {
            color: #018da0;
        }
    </style>
<body>
	<h1>Welcome Modern Fit Collective!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstName">Client Name</label> 
			<input type="text" name="CustomerName">
		</p>
		<p>
			<label for="firstName">Contact Person</label> 
			<input type="text" name="ContactNumber">
		</p>
		<p>
			<label for="firstName">Email</label> 
			<input type="text" name="Email">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="Address">
		</p>
		<p>
			<label for="firstName">City</label> 
			<input type="text" name="City">
			<input type="submit" name="insertClientBtn">
		</p>
	</form>
	<?php $getAllCustomer = getAllCustomer($pdo); ?>
	<?php foreach ($getAllCustomer as $row) { ?>
	<div class="container" style="width: 50%; height: 250px; margin-top: 20px;">
		<h3>Cutomer Name: <?php echo $row['CustomerName']; ?></h3>
		<h3>Contact number: <?php echo $row['ContactNumber']; ?></h3>
		<h3>Email: <?php echo $row['Email']; ?></h3>
		<h3>Address: <?php echo $row['Address']; ?></h3>
		<h3>City: <?php echo $row['City']; ?></h3>
		<h3>Date Registered: <?php echo $row['RegistrationDate']; ?></h3>


		<div class="editAndDelete" style="float: right;">
			<a href="ClothingShop.php?CustomerID=<?php echo $row['CustomerID']; ?>">View Orders</a>
			<a href="editCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Edit</a>
			<a href="deleteCustomer.php?CustomerID=<?php echo $row['CustomerID']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>