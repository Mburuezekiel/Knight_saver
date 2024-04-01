<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="shortcut icon" href="assets/logo1.jpg" type="image/x-icon">
    <!-- Include your CSS stylesheets here -->
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
        
        padding: 20px;
            background-color:orange;
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .address-info, .delivery-details, .order-summary, .payment-method {
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .confirm-btn {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .login-form {
            margin: 0 auto;
            max-width: 300px;
            text-align: center;
        }
        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="submit"] {
            width: 100%;
            margin-top: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <h1>Knight_ Second_ Hand _Resale Shop - Payment</h1>
    
    <div class="container">
    <?php
    session_start();
    include('database/conn.php');
    
    // Check if the user is logged in
    if(isset($_SESSION['user_id'])) {
        // Fetch user details from the database
        $user_id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE id = $user_id";
        $result = mysqli_query($link, $query);
        $user = mysqli_fetch_assoc($result);
        
        // Display user information
        ?>
    
        <div class="address-info">
            <div class="section-title">Customer Address</div>
            <div><?php echo $_SESSION['username']; ?></div>
            <div><?php echo $_SESSION['phone_number']; ?> 
            <br><?php echo $_SESSION['email']; ?> </div>
           
        </div>
        <?php
    } else {
        // Display login form
        ?>
        <div class="login-form">
            <form action="processlogin.php" method="POST">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" value="Login">
            </form>
        </div>
        <?php
    }
    ?>

    <div class="delivery-details">
        <div class="section-title">Delivery Details</div>
        <div>Pick-up Station (from KSh 159)</div>
        <div>Delivery between 04 April and 06 April</div>
        <div><a href="#">Change</a></div>
    </div>

    <?php
    // Example code to retrieve product details from the database
    $productId = 1; // Assuming the product ID is available
    $productName = "43E3A, 43\" Full HD Frameless Smart Android TV – Black";
    $productPrice = 25999;
    // Store product details in session variables
    $_SESSION['product_id'] = $productId;
    $_SESSION['product_name'] = $productName;
    $_SESSION['product_price'] = $productPrice;
    ?>

    <div class="order-summary">
        <div class="section-title">Order summary</div>
        <div><?php echo $productName; ?> (1): KSh <?php echo $productPrice; ?></div>
        <div>Delivery fees: KSh 159</div>
        <div><strong>Total: KSh <?php echo $productPrice + 159; ?></strong></div>
        <div>You will be able to add a voucher when selecting your payment method.</div>
    </div>

    <div class="confirm-btn">
        <button class="btn">CONFIRM ORDER</button>
        <div>(Complete the steps in order to proceed)</div>
        <div>By proceeding, you are automatically accepting the <a href="#">Terms & Conditions</a></div>
    </div>
</div>

</body>
</html>
