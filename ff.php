<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Ad</title>
    <style>
        /* Style for the popup */
        .popup {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            border: 2px solid #000000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: none;
        }
    </style>
</head>
<body>

<!-- Popup Ad Container -->
<div id="popupAd" class="popup">
    <!-- Message Content -->
    <p>
        🛍️ Looking for great deals on quality second-hand items? Look no further! 🎉<br><br>
        Discover hidden treasures at [Your Shop Name]! From fashion to furniture, we've got it all at unbeatable prices! 💸<br><br>
        Why shop with us?<br>
        ✅ High-quality items at affordable prices<br>
        ✅ Wide selection of clothing, accessories, homeware, and more<br>
        ✅ Sustainable shopping - reduce, reuse, recycle 🌱<br>
        ✅ Friendly service and a welcoming atmosphere<br><br>
        Join our community of savvy shoppers and find your next favorite piece today! Visit us at [Your Shop Address] or check out our online store at [Your Website]. Don't miss out! 🛒<br><br>
        #SecondHandFinds #ShopLocal #SustainableLiving #FashionFinds #AffordableLuxury
    </p>
</div>

<script>
    // Function to show the popup ad
    function showPopup() {
        document.getElementById('popupAd').style.display = 'block';
    }

    // Function to hide the popup ad
    function hidePopup() {
        document.getElementById('popupAd').style.display = 'none';
    }

    // Show the popup ad initially
    showPopup();

    // Set interval to show the popup ad every 5 seconds
    setInterval(showPopup, 5000);

    // Close the popup when clicked outside
    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('popupAd')) {
            hidePopup();
        }
    });
</script>

</body>
</html>
