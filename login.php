<?php
// Start the session
session_start();

if (isset($_SESSION["username"])) {
    // Redirect to another page
    header("Location: index.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];

    // Set the username as a session variable
    $_SESSION["username"] = $username;

    // Redirect to another page
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Name Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            background-color: #f0f0f0;
            background-image: url("i3.jpg"); 
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-container{
            background-color: #EEE;
            
        }

        

    </style>
</head>
<body>

<div class="login-container">
    <h2 style="color: #333; text-align: center; margin-bottom: 30px;">Enter your username</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username" style="color: #555; display: block; margin-bottom: 12px;">Username:</label>
        <input type="text" id="username" name="username" required style="width: 100%; padding: 12px; margin-bottom: 20px; border-radius: 6px; border: 1px solid #ccc; transition: background-color 0.3s ease;">
        <br>
        <input type="submit" value="Submit" style="width: 100%; padding: 12px; border: none; border-radius: 6px; background-color: #007bff; color: #fff; cursor: pointer; transition: background-color 0.3s ease;">
    </form>
</div>


</body>
</html>
