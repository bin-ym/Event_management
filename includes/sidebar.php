<div class="sidebar">
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <?php
        if ($_SESSION['user_role'] == 'admin') {
            echo '<li><a href="manage_categories.php">Manage Categories</a></li>';
            echo '<li><a href="manage_users.php">Manage Users</a></li>';
            echo '<li><a href="../admin/view_reports.php">View Reports</a></li>';
            echo '<li><a href="../admin/user_requests.php">User Package Requests</a></li>';
            echo '<li><a href="feedback.php">Feedback</a></li>';
        } elseif ($_SESSION['user_role'] == 'manager') {
            echo '<li><a href="events.php">Events</a></li>';
            echo '<li><a href="report.php">Report</a></li>';
           // echo '<li><a href="calendar.php">Calendar</a></li>';
            echo '<li><a href="view_bookings.php">View bookings</a></li>';
        } elseif ($_SESSION['user_role'] == 'user') {
            echo '<li><a href="package.php">Packages</a></li>';
            echo '<li><a href="set_package.php">Set Your Package</a></li>';
            echo '<li><a href="profile.php">Profile</a></li>';
            echo '<li><a href="feedback.php">Feedback</a></li>';
            
        }
        ?>
        <li><a href="../logout.php">Logout</a></li> <!-- Logout link -->
    </ul>
</div>

