// Add your JavaScript code here for dynamic interactions
document.addEventListener("DOMContentLoaded", function() {
    // Example: toggle sidebar menu
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    const sidebar = document.querySelector(".sidebar");
    sidebarToggle.addEventListener("click", function() {
        sidebar.classList.toggle("open");
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [] // Events will be populated by PHP
    });
    calendar.render();
});
