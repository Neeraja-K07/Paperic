<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .green-button {
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 12px 28px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: background-color 0.3s, transform 0.2s;
    }

    .green-button:hover {
        background-color: #218838;
        transform: scale(1.03);
    }
</style>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank You</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="confetti-wrapper"></div>
<div id="alert-box">
    <div class="tick-mark">&#10004;</div>
    <div class="message">Order Placed Successfully!</div>
    <a href="cnavbar.php" class="green-button">Go to Home</a>
    <!-- <div class="confirmation-message">For confirmation mail, kindly click the button below:</div>
    
    <form id="emailForm" action="sendConfirmationMail.php" method="post">
        <button type="submit" id="sendEmailBtn">Send Confirmation Email</button>
    </form> -->
</div>
</body>
</html>
