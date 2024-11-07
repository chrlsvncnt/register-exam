<?php  

function insertClient($pdo, $CustomerName, $ContactNumber, $Email, 
	$Address, $City) {

	$sql = "INSERT INTO Customer (CustomerName, ContactNumber, Email, 
		Address, City) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerName, $ContactNumber, $Email, 
	$Address, $City]);

	if ($executeQuery) {
		return true;
	}
}



function updateClient($pdo, $ContactNumber, $Email, 
	$Address, $City, $CustomerID) {

	$sql = "UPDATE Customer
				SET ContactNumber = ?,
					Email = ?,
					Address = ?, 
					City = ?
				WHERE CustomerID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ContactNumber, $Email, 
	$Address, $City, $CustomerID]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteCustomer($pdo, $CustomerID) {
	$deleteOder = "DELETE FROM ClothingShop WHERE CustomerID = ?";
	$deleteStmt = $pdo->prepare($deleteOder);
	$executeDeleteQuery = $deleteStmt->execute([$CustomerID]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM Customer WHERE CustomerID = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$CustomerID]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCustomer($pdo) {
	$sql = "SELECT * FROM Customer";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getClientByID($pdo, $CustomerID) {
	$sql = "SELECT * FROM Customer WHERE CustomerID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerID]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getShipmentByClient($pdo, $CustomerID) {
	
	$sql = "SELECT 
				ClothingShop.ProductID AS ProductID,
				ClothingShop.ProductName AS ProductName,
				ClothingShop.Size AS Size,
				ClothingShop.Color AS Color,
				ClothingShop.Price AS Price,
				ClothingShop.StockQuantity AS StockQuantity,
				ClothingShop.dateRegistered AS dateRegistered,
				Customer.CustomerName AS CustomerName
			FROM ClothingShop
			JOIN Customer ON ClothingShop.CustomerID = Customer.CustomerID
			WHERE ClothingShop.CustomerID = ? 
			GROUP BY ClothingShop.ProductName;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerID]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertShipment($pdo, $ProductName, $Size, $Color, $Price, $StockQuantity, $CustomerID) {
	$sql = "INSERT INTO ClothingShop (ProductName, Size, Color, Price, StockQuantity, CustomerID) VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductName, $Size, $Color, $Price, $StockQuantity, $CustomerID]);
	if ($executeQuery) {
		return true;
	}

}

function getShipmentByID($pdo, $ProductID) {
	$sql = "SELECT 
				ClothingShop.ProductID AS ProductID,
				ClothingShop.ProductName AS ProductName,
				ClothingShop.Size AS Size,
				ClothingShop.Color AS Color,
				ClothingShop.Price AS Price,
				ClothingShop.StockQuantity AS StockQuantity,
				ClothingShop.dateRegistered AS dateRegistered,
				Customer.CustomerName AS CustomerName
			FROM ClothingShop
			JOIN Customer ON ClothingShop.CustomerID = Customer.CustomerID
			WHERE ClothingShop.ProductID  = ? 
			GROUP BY ClothingShop.ProductName";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductID]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateShipment($pdo, $ProductName, $Size, $Color, $Price, $StockQuantity, $ProductID) {
	$sql = "UPDATE ClothingShop
			SET ProductName = ?,
				Size = ?,
				Color = ?,
				Price = ?,
				StockQuantity = ?
			WHERE ProductID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductName, $Size, $Color, $Price, $StockQuantity, $ProductID]);

	if ($executeQuery) {
		return true;
	}
}

function deleteOrder($pdo, $ProductID) {
	$sql = "DELETE FROM ClothingShop WHERE ProductID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ProductID]);
	if ($executeQuery) {
		return true;
	}
}


function getAllOrderByCustomerID($CustomerID) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Customer WHERE CustomerID = :CustomerID");
    $stmt->execute(['CustomerID' => $CustomerID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function registerCustomer($pdo, $customer_name, $username, $password) {
    try {
        $stmt = $pdo->prepare("INSERT INTO customers (customer_name, username, password) VALUES (?, ?, ?)");
        return $stmt->execute([$customer_name, $username, $password]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getUserByUsername($pdo, $username) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>