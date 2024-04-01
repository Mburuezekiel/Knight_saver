
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="shortcut icon" href="assets/logo1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .container {
            padding-top: 10px;
            /* Adjust the body padding to make space for the fixed navbar */
        }

        /* Button styles */
        .btn-get-started {
            background-color: #2ACFCF;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-get-started:hover {
            background-color: #1D9FA3;
        }

        /* Custom styles for the category */
        .category-heading {
            text-transform: uppercase;
            background-color: orange;
            color: white;
          
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-top: 70px;
        }

        /* Updated card styles */
        .card {
             align-items: center;
             text-align: center;
            width: 100%; /* Set width to fit 20 cards in a row */
            margin: 10px; /* Add margin between cards */
            display: flex; /* Display cards side by side */
        }
         .products {
             
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between; /* Align products with space between */
}

@media (max-width: 992px) {
    .products {
         
        justify-content: space-around; /* Align products with space around */
    }
}

@media (max-width: 768px) {
    
    .products {
         
        justify-content: center; /* Align products in the center */
    }
}


        .product {
            background-color: #fff;
             
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1 1 300px; /* Let products grow but don't shrink below 300px */
            min-width: 250px; /* Minimum width for each product */
        }

        .product img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .product h3 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .product p {
            color: #777;
            margin-bottom: 10px;
        }

        .product button {
            background-color: #FFCA28;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .product button:hover {
            background-color: #e0a8ae;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Main Content -->
   
        <?php
        // Check if category is provided in the URL
        if (isset($_GET['category'])) {
            $category = $_GET['category'];

            // Include database connection
            include 'database/conn.php';

            // Fetch items according to the category from the database
            $sql = "SELECT * FROM products WHERE category = '$category'";
            $result = $link->query($sql);

            // Check if there are any items
            if ($result->num_rows > 0) {
                echo '<h2 class="category-heading">' . strtoupper($category) . '</h2>';
               

                // Loop through each item and display them
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="products">'; // Set column width to fit 4 cards in a row
                    echo '<div class="product mb-4 shadow-sm">';
                    echo '<img src="' . $row['image'] . '"  width="50%" height="225">';
                    echo '<div class="product-body">';
                    echo '<h5 class="product-title">' . $row['item_name'] . '</h5>';

                    $description =  $row['description'];
                $maxLength = 15; // Maximum length of the description to display

                echo '<p class="description">';
                if (strlen($description) > $maxLength) {
                    // If description is longer than maxLength, truncate and add "Read More" link
                    echo '<span class="truncated">' . substr($description, 0, $maxLength) . '...</span>';
                    echo '<span class="full" style="display:none;">' . $description . '</span>';
                    echo ' <a href="#" class="read-more">Read More</a>';
                } else {
                    // If description is within the maxLength, display the full description
                    echo $description;
                }
                echo '</p>';
            
                    echo '<p class="product-text">Status: ' . $row['status'] . '</p>';
                    echo '<p class="product-text">Price: Ksh ' . $row['price'] . '</p>';
                     echo '<p class="product-text">Location: ' . $row['location'] . '</p>';
                   echo ' <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">'; 
                              echo '   <h4 class="text-info"><?php echo  $row["item_name"]; ?></h4>'; 
                          

                    // Add to cart form
echo '<form method="post" action="add_to_cart.php">';
echo '<input type="hidden" name="item_id" value="' . $row['item_id'] . '">';
echo '<input type="hidden" name="item_name" value="' . $row['item_name'] . '">';
echo '<input type="hidden" name="price" value="' . $row['price'] . '">';
echo '<input type="hidden" name="quantity" value="' . $row['quantity'] . '">';
echo '<input type="hidden" name="image" value="' . $row['image'] . '">';
echo '<input type="number" name="quantity" class="form-control" placeholder="Quantity" required/>';

echo '<button class="btn btn-warning add-to-cart" data-name="' . $row['item_name'] . '" data-price="' . $row['price']  .'" data-quantity="' . $row['quantity']. '" data-image="' . $row['image'] . '" disabled >Add to Cart</button>'; // Add to cart button



                    // Generate WhatsApp link with the encoded message
                    $message = 'Hi, I am interested in your product: *' . urlencode($row['item_name']) . '*.' . "\n" .
                        'Price: *Ksh ' . $row['price'] . '*.' . "\n" .
                          
                          'More details at: *' . urlencode("https://knight.businesscareerconsulting.co.ke//shop.php?item_id=" . $row['item_id']) . '*';

               // Format the contact number with +254 and replace the first digit
                    $contact_number = "+254115812700";
                    $whatsapp_link = 'https://wa.me/' . $contact_number . '?text=' . $message;

                    // WhatsApp contact link
                    echo '<a href="' . $whatsapp_link . '" class="btn btn-success contact-seller"><i class="bi bi-whatsapp"></i> Contact Seller</a>';

                    echo '</div>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>'; // End row
            } else {
                echo '<div class="alert alert-warning" role="alert">No items found in this category.</div>';
            }
        } else {
            // Redirect to home page if category is not provided
            header('Location: shop.php');
            exit();
        }
        ?>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Find all elements with class "read-more"
    var readMoreButtons = document.querySelectorAll('.read-more');
    var lessButtons = document.querySelectorAll('.read-less');

    // Function to toggle description visibility
    function toggleDescription(paragraph) {
        var truncatedSpan = paragraph.querySelector('.truncated');
        var fullSpan = paragraph.querySelector('.full');
        truncatedSpan.style.display = 'none';
        fullSpan.style.display = 'inline';
    }

    // Function to toggle description visibility back to truncated
    function toggleTruncated(paragraph) {
        var truncatedSpan = paragraph.querySelector('.truncated');
        var fullSpan = paragraph.querySelector('.full');
        truncatedSpan.style.display = 'inline';
        fullSpan.style.display = 'none';
    }

    // Loop through each "Read More" button
    readMoreButtons.forEach(function(button) {
        // Add click event listener
        button.addEventListener('click', function(event) {
            // Prevent default link behavior
            event.preventDefault();

            // Find the parent paragraph element
            var paragraph = this.parentNode;

            // Toggle visibility of truncated and full description spans
            toggleDescription(paragraph);

            // Hide the "Read More" button and show the "Less" button
            this.style.display = 'none';
            paragraph.querySelector('.read-less').style.display = 'inline';
        });
    });

    // Loop through each "Read Less" button
    lessButtons.forEach(function(button) {
        // Add click event listener
        button.addEventListener('click', function(event) {
            // Prevent default link behavior
            event.preventDefault();

            // Find the parent paragraph element
            var paragraph = this.parentNode;

            // Toggle visibility back to truncated description
            toggleTruncated(paragraph);

            // Hide the "Less" button and show the "Read More" button
            this.style.display = 'none';
            paragraph.querySelector('.read-more').style.display = 'inline';
        });
    });
});
</script>

    <!-- JavaScript code for updating the cart count -->
    <script>
        // Function to update cart count asynchronously
        function updateCartCount() {
            // Create an XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the callback function
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the cart count element with the response text
                    document.getElementById("cart-count").innerHTML = this.responseText;
                }
            };

            // Open a GET request to the PHP script that retrieves the cart count
            xhttp.open("GET", "update_cart_count.php", true);
            // Send the request
            xhttp.send();
        }

        // Call the updateCartCount function when the page loads
        window.onload = updateCartCount;
    </script>

    <!-- JavaScript to update cart count -->
    <script>
        // Function to update cart count asynchronously
        function updateCartCount() {
            // Create an XMLHttpRequest object
            var xhttp = new XMLHttpRequest();

            // Define the callback function
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the cart count element with the response text
                    document.getElementById("cart-count").innerHTML = this.responseText;
                }
            };

            // Open a GET request to the PHP script that retrieves the cart count
            xhttp.open("GET", "update_cart_count.php", true);
            // Send the request
            xhttp.send();
        }

        // Call the updateCartCount function when the page loads
        window.onload = updateCartCount;
    </script>
</div>
</div>
</body>
<footer>
     
</footer>
 <!-- 
 Header -->
   
</html>
