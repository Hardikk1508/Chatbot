<?php
session_start();

// Check if the session variable is set
if (!isset($_SESSION["username"])) {
    // Redirect to another page
    header("Location: login.php"); // Replace 'login.php' with the desired page
    exit;
}

include 'database.php';

$query = "SELECT * FROM shouts";
$shouts = mysqli_query($con, $query);

// Check if the logout button is clicked
if (isset($_POST['logout'])) {
    // Unset the session variable
    unset($_SESSION['username']);
    
    // Destroy the session
    session_destroy();
    
    // Redirect to login page or any other desired page
    header("Location: login.php"); // Replace 'login.php' with the URL of your login page
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoutbox</title>
    <link rel="stylesheet" href="./css/style.css">
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
    </style>
</head>

<body data-theme="light">

<button onclick="toggleDarkMode()">Toggle Dark Mode</button>

    <div class="container">
        <header>
            <h1>Chatbox</h1>
        </header>
        <div id="shoutouts"></div>

        <div id="input">
            <?php if(isset($_GET["error"])) : ?>
                <div class="error"><?php echo $_GET["error"]; ?></div>
            <?php endif; ?>
            <form action="process.php" method="post">
                <input type="text" name="user" value="<?= $_SESSION["username"] ?>" hidden>
                <input type="text" name="message" placeholder="Enter a message...">
                <br>
                <input type="submit" value="Shout it out!" name="submit" class="shout-btn" id="send_msg">
            </form>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="submit" name="logout" value="Logout" class="shout-btn" id="logout">
            </form>
        </div>
    </div>

    <script>
        function fetchMessages() {
            fetch('fetch_messages.php') 
                .then(response => response.json())
                .then(data => {
                    document.getElementById('shoutouts').innerHTML = data.messages;
                })
                .catch(error => {
                    console.error('Error fetching messages:', error);
                });
        }


        setInterval(fetchMessages, 500);
        function toggleDarkMode() {
        const body = document.body;
        const currentTheme = body.getAttribute('data-theme');

        if (currentTheme === 'dark') {
            body.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light'); // Save theme preference to local storage
        } else {
            body.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark'); // Save theme preference to local storage
        }
    }

    // Load saved theme preference from local storage
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        const body = document.body;

        if (savedTheme) {
            body.setAttribute('data-theme', savedTheme);
        } else {
            // Use system default if no theme preference is saved
            const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
            if (darkModeMediaQuery.matches) {
                body.setAttribute('data-theme', 'dark');
            } else {
                body.setAttribute('data-theme', 'light');
            }
        }
    });
    </script>
</body>
</html>
