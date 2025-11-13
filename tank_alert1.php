<?php
// ----------------- DATABASE CONNECTION -----------------
$servername = "localhost";
$username   = "root";      // default XAMPP user
$password   = "";          // default empty
$dbname     = "tank_monitor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ----------------- HANDLE ARDUINO POST -----------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $time   = isset($_POST['time']) ? $_POST['time'] : '';

    if ($status != '') {
        // Convert Arduino epoch time to MySQL datetime if provided
        $datetime = $time != '' ? date('Y-m-d H:i:s', (int)$time) : date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO tank_logs (status, logged_at) VALUES (?, ?)");
        $stmt->bind_param("ss", $status, $datetime);
        if ($stmt->execute()) {
            echo "OK Logged: $status at $datetime";
        } else {
            echo "Insert failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "No status received";
    }
}

// ----------------- DISPLAY DATA -----------------
$result = $conn->query("SELECT * FROM tank_logs ORDER BY logged_at DESC LIMIT 10");

// Get current status
$currentStatus = "No data yet";
$currentTime   = "";
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentStatus = $row['status'];
    $currentTime   = $row['logged_at'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tank Status Monitor</title>
<style>
    body { font-family: Arial; padding: 20px; }
    table { border-collapse: collapse; width: 50%; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
</style>
</head>
<body>
<h1>Tank Status Monitor</h1>

<h2>Current Status:</h2>
<p>Status: <strong><?php echo htmlspecialchars($currentStatus); ?></strong></p>
<p>Logged at: <?php echo htmlspecialchars($currentTime); ?></p>

<h2>Past Events (last 10):</h2>
<table>
<tr>
<th>ID</th>
<th>Status</th>
<th>Time</th>
</tr>
<?php
if ($result && $result->num_rows > 0) {
    // Rewind result pointer for table display
    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>" . htmlspecialchars($row['logged_at']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No data yet</td></tr>";
}
$conn->close();
?>
</table>
</body>
</html>
