<?php
session_start();

// Cek jika user belum login, redirect ke login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Contoh data untuk ditampilkan
$events = [
    ['id' => 1, 'name' => 'Event A', 'date' => '2024-10-01', 'status' => 'Active'],
    ['id' => 2, 'name' => 'Event B', 'date' => '2024-10-15', 'status' => 'Completed'],
    ['id' => 3, 'name' => 'Event C', 'date' => '2024-11-01', 'status' => 'Upcoming'],
];

$totalEvents = count($events);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li><a href="#">Events</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
            <a href="logout.php" class="logout-button">Logout</a>
        </header>

        <div class="stats">
            <div class="card">
                <h3>Total Events</h3>
                <p><?php echo $totalEvents; ?></p>
            </div>
            <div class="card">
                <h3>Active Events</h3>
                <p><?php echo count(array_filter($events, fn($event) => $event['status'] === 'Active')); ?></p>
            </div>
            <div class="card">
                <h3>Completed Events</h3>
                <p><?php echo count(array_filter($events, fn($event) => $event['status'] === 'Completed')); ?></p>
            </div>
        </div>

        <h3>Data Events</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td><?php echo $event['name']; ?></td>
                        <td><?php echo $event['date']; ?></td>
                        <td><?php echo $event['status']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
