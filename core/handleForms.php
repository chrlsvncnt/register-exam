<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertClientBtn'])) {

	$query = insertClient($pdo, $_POST['CustomerName'], $_POST['ContactNumber'], $_POST['Email'], $_POST['Address'], $_POST['City']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editClientBtn'])) {
	$query = updateClient($pdo, $_POST['ContactNumber'], $_POST['Email'], $_POST['Address'], $_POST['City'], $_GET['CustomerID']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}




if (isset($_POST['deleteClientBtn'])) {
	$query = deleteCustomer($pdo, $_GET['CustomerID']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}




if (isset($_POST['insertNewShipmentBtn'])) {
	$query = insertShipment($pdo, $_POST['ProductName'], $_POST['Size'], $_POST['Color'], $_POST['Price'], $_POST['StockQuantity'], $_GET['CustomerID']);

	if ($query) {
		header("Location: ../ClothingShop.php?CustomerID=" .$_GET['CustomerID']);
	}
	else {
		echo "Insertion failed";
	}
}




if (isset($_POST['editShipmentBtn'])) {
	$query = updateShipment($pdo, $_POST['ProductName'], $_POST['Size'], $_POST['Color'], $_POST['Price'], $_POST['StockQuantity'], $_GET['ProductID']);

	if ($query) {
		header("Location: ../ClothingShop.php?CustomerID=" .$_GET['CustomerID']);
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteShipmentBtn'])) {
	$query = deleteOrder($pdo, $_GET['ProductID']);

	if ($query) {
		header("Location: ../ClothingShop.php?CustomerID=" .$_GET['ProductID']);
	}
	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['registerCustomerButton'])) {
    // Add error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $customer_name = trim($_POST['customer_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Add debug output
    echo "Attempting to register with:<br>";
    echo "Customer Name: " . $customer_name . "<br>";
    echo "Username: " . $username . "<br>";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $query = registerCustomer($pdo, $customer_name, $username, $hashed_password);
        if ($query) {
            echo "Registration successful!<br>";
            echo "<a href='../login.php'>Return to Login</a>";
        } else {
            echo "Registration failed! PDO error info:<br>";
            print_r($pdo->errorInfo());
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

if (isset($_POST['loginButton'])) {
    // Add error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Add debug output
    echo "Attempting to login with username: " . $username . "<br>";

    try {
        $user = getUserByUsername($pdo, $username);
        if ($user && password_verify($password, $user['password'])) {
            // Start session and store user data
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "Login successful! Redirecting...";
            header("Location: ../index.php"); // Redirect to home page
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

if (isset($_POST['loginButton'])) {
    // ... existing login code ...
    
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Add any other user information you want to store in session
        
        header("Location: ../index.php");
        exit();
    }
}
?>