<?php
session_start();
if ($_SESSION['user_role'] != 'manager') {
    header('Location: ../index.php');
    exit;
}
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/db.php');

// Fetch events assigned to the manager
$manager_id = $_SESSION['user_id'];
$sql = "SELECT * FROM events WHERE manager_id = $manager_id";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

?>
<div class="content">
    <h2>Event Calendar</h2>
    <div id="calendar"></div>
</div>

<script src="../js/scripts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                <?php foreach ($events as $event) {
                    echo "{ title: '{$event['event_name']}', start: '{$event['date']}' },";
                } ?>
            ]
        });
        calendar.render();
    });
</script>
<?php
$conn->close();
include('../includes/footer.php');
?>
