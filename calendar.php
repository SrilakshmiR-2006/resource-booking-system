<!DOCTYPE html>
<html>
<head>
    <title>Resource Booking Calendar</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
</head>

<body>

<h2>Resource Booking Calendar</h2>

<div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        selectable: true,

        events: 'fetch_events.php',

        dateClick: function(info) {
            let date = info.dateStr;

            let resource = prompt("Enter Resource ID:\n1 = Lab 1\n2 = Lab 2\n3 = Lab 3\n4 = Skill Lab 1\n5 = Skill Lab 2\n6 = Multimedia Room\n7 = Quadrangle\n8 = Conference Hall");

            let start = prompt("Start Time (HH:MM:SS):");
            let end = prompt("End Time (HH:MM:SS):");

            if(resource && start && end){
                window.location.href = 
                "save_booking.php?resource_id="+resource+
                "&date="+date+
                "&start="+start+
                "&end="+end+
                "&user=1";
            }
        }

    });

    calendar.render();
});
</script>

</body>
</html>