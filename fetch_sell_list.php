<?php
// Start session to retrieve seller ID
session_start();

// Check if seller is logged in
if(!isset($_SESSION["seller_logged_in"]) || $_SESSION["seller_logged_in"] !== true){
    header("location: sell_login.php"); // Redirect to login page if not logged in
    exit;
}

// Include database connection
include_once "database/conn.php";

// Fetch items sold by the seller from the database
$seller_id = $_SESSION["seller_id"];
$sql = "SELECT id, item_name, price, image, quantity, status, description, location FROM products WHERE seller_id = ?";
if ($stmt = $link->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("i", $seller_id);
    // Execute query
    $stmt->execute();
    // Bind result variables
    $stmt->bind_result($id, $item_name, $price, $image, $quantity, $status, $description, $location);
    // Initialize an array to store the retrieved items
    $items = array();
    // Fetch results and store in the array
    while ($stmt->fetch()) {
        $items[] = array(
            "id" => $id,
            "item_name" => $item_name,
            "price" => $price,
            "image" => $image,
            "quantity" => $quantity,
            "status" => $status,
            "description" => $description,
            "location" => $location
        );
    }
    // Close statement
    $stmt->close();
}

// Close connection
$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Item List</title>
    <link rel="shortcut icon" href="assets/logo1.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container1 {
            background-color: orange;
            color: white;
            padding: 10px;
            text-align: center; /* Align all text and items to the center */
        }

        .progress {
            height: 20px;
            margin-top: 10px;
        }

        .progress-bar {
            text-align: left;
            padding: 5px;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container1">
        <h4><i class="bi bi-cart-fill"></i>My Sell List</h4>
        <a href="sell.php" class="btn btn-primary">Back to Seller Dashboard</a>
    </div>
    <div class="container mt-5">
        <?php if (!empty($items)): ?>
            <div class="row">
                <?php foreach ($items as $item): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo $item['image']; ?>" class="card-img-top" alt="<?php echo $item['item_name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['item_name']; ?></h5>
                                <p class="card-text">Price: Ksh <?php echo $item['price']; ?></p>
                                <p class="card-text">Remaining: <?php echo $item['quantity']; ?></p>
                                <p class="card-text">Status: <?php echo $item['status']; ?></p>
                                <p class="card-text">Description: <?php echo $item['description']; ?></p>
                                <p class="card-text">Location: <?php echo $item['location']; ?></p>
                                <!-- Progress bar to show marketability -->
                                <div class="progress">
    <?php
    // Calculate the sold percentage
    $sold_percentage = ($item['quantity'] - $item['quantity_left']) / $item['quantity'] * 100;
    ?>
    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $sold_percentage; ?>%;" aria-valuenow="<?php echo $sold_percentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $sold_percentage; ?>%</div>
</div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No items sold yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
