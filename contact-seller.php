<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact Seller</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['title']); ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <title>Contact Seller</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form {
            display: flex;
            flex-direction: column;
        }
        .contact-form label {
            margin-bottom: 5px;
        }
        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .contact-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>





    <div class="container">
        <h2>Contact With Seller</h2>
        <?php
        $nameErr = $emailErr = $messageErr = "";
        $name = $email = $message = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = htmlspecialchars($_POST["name"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = htmlspecialchars($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }

            if (empty($_POST["message"])) {
                $messageErr = "Message is required";
            } else {
                $message = htmlspecialchars($_POST["message"]);
            }

            if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
                // Here you can add code to send the email or save the message to a database
                // For example, using PHP's mail function:
                $to = "seller@example.com"; // Replace with seller's email
                $subject = "New message from $name";
                $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
                $headers = "From: $email";

                if (mail($to, $subject, $body, $headers)) {
                    echo "<div class='message success'>Message sent successfully!</div>";
                } else {
                    echo "<div class='message error'>Failed to send message.</div>";
                }
            }
        }
        ?>
        <form action="contact-seller.php" method="post" class="contact-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            <span class="error"><?php echo $nameErr; ?></span>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <span class="error"><?php echo $emailErr; ?></span>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required><?php echo $message; ?></textarea>
            <span class="error"><?php echo $messageErr; ?></span>
            
            <input type="submit" value="Submit">
            <a href="buy-sell.php" class="btn btn-light" style="margin-top: 10px;">Back to Home</a>
        </form>
    </div>
</body>
</html>
