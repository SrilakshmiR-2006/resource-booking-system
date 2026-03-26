<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resource Booking Calendar</title>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f5f7fb;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            font-weight: 600;
            color: #1e293b;
        }

        /* CALENDAR */
        .fc {
            background: white;
            border-radius: 10px;
            padding: 10px;
        }

        .fc-theme-standard td, 
        .fc-theme-standard th {
            border: 1px solid #e5e7eb;
        }

        .fc-daygrid-day-frame {
            background: #fafafa;
        }

        /* MODAL BACKGROUND */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(8px);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        /* MODAL BOX */
        .modal-box {
            background: #ffffff;
            padding: 30px;
            border-radius: 14px;
            width: 350px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.2);
            animation: pop 0.25s ease;
        }

        @keyframes pop {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-box h3 {
            margin-bottom: 15px;
            color: #1e293b;
        }

        .modal-box select,
        .modal-box input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }

        .modal-box button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .modal-box button[type="submit"] {
            background: #4f46e5;
            color: white;
        }

        .modal-box button[type="submit"]:hover {
            background: #4338ca;
        }

        .close-btn {
            background: #e5e7eb;
        }
    </style>
</head>

<body>

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">

    <h2 style="margin:0;">📅 Resource Booking Calendar</h2>

    <a href="logout.php" style="
        text-decoration:none;
        background:#ef4444;
        color:white;
        padding:6px 12px;
        border-radius:6px;
        font-size:14px;
    ">
        Logout
    </a>

</div>
    <div id="calendar"></div>
</div>

<!-- MODAL -->
<div id="bookingModal" class="modal">
    <div class="modal-box">

        <h3>Book Resource</h3>

        <form action="save_booking.php" method="POST">

            <input type="hidden" id="selectedDate" name="date">

            <label>Resource</label>
            <select name="resource_id" required>
                <option value="">Select</option>
                <option value="1">Lab 1</option>
                <option value="2">Lab 2</option>
                <option value="3">Lab 3</option>
                <option value="4">Skill Lab 1</option>
                <option value="5">Skill Lab 2</option>
                <option value="6">Multimedia Hall</option>
                <option value="7">Quadrangle</option>
                <option value="8">Conference Hall</option>
            </select>

            <label>Start Time</label>
            <input type="time" name="start_time" required>

            <label>End Time</label>
            <input type="time" name="end_time" required>

            <button type="submit">Book Now</button>
        </form>

        <button class="close-btn" onclick="closeModal()">Cancel</button>

    </div>
</div>

<!-- FullCalendar -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

    initialView: 'dayGridMonth',

    events: 'fetch_events.php',

    eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    },

    displayEventTime: true,

    dateClick: function(info) {
        document.getElementById('selectedDate').value = info.dateStr;
        document.getElementById('bookingModal').style.display = 'flex';
    }
});

    calendar.render();
});

function closeModal() {
    document.getElementById("bookingModal").style.display = "none";
}
</script>

</body>
</html>