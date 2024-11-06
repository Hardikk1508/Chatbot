<?php
include 'database.php';

date_default_timezone_set('Asia/Kolkata');

$query = "SELECT * FROM shouts";
$shouts = mysqli_query($con, $query);

$messages = [];

while ($row = mysqli_fetch_assoc($shouts)) {
    $timeIST = date('h:i:s A', strtotime($row['time']));
    $messages[] = '<li class="shout"><span>' . $timeIST . ' IST - </span>' . $row['user'] . ': ' . $row['message'] . '</li>';
}

echo json_encode(['messages' => implode('', $messages)]);
?>
