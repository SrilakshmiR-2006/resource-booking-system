<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resource Booking Calendar</title>

    <!-- FullCalendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins',sans-serif;
            background: linear-gradient(135deg,#667eea,#764ba2);
            min-height:100vh;
            padding:30px;
        }

        .main-container{
            max-width:1200px;
            margin:auto;
        }

        /* TOP BAR */

        .topbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
        }

        .title{
            color:white;
            font-size:32px;
            font-weight:600;
        }

        .logout-btn{
            background:#ef4444;
            color:white;
            padding:10px 18px;
            border-radius:10px;
            text-decoration:none;
            transition:0.3s;
            font-weight:500;
        }

        .logout-btn:hover{
            background:#dc2626;
        }

        /* CALENDAR CARD */

        .calendar-card{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0 15px 40px rgba(0,0,0,0.15);
        }

        /* FULLCALENDAR */

        .fc-toolbar-title{
            color:#1e293b;
            font-weight:600;
        }

        .fc-button{
            background:#4f46e5 !important;
            border:none !important;
            border-radius:8px !important;
            padding:8px 14px !important;
        }

        .fc-button:hover{
            background:#4338ca !important;
        }

        .fc-daygrid-day{
            transition:0.2s;
        }

        .fc-daygrid-day:hover{
            background:#f3f4f6;
            cursor:pointer;
        }

        .fc-event{
            background:#10b981 !important;
            border:none !important;
            padding:3px;
            border-radius:6px;
        }

        /* MODAL */

        .modal{
            display:none;
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.35);
            backdrop-filter:blur(6px);
            justify-content:center;
            align-items:center;
            z-index:999;
        }

        .modal-content{
            width:380px;
            background:white;
            border-radius:18px;
            padding:30px;
            animation:popup 0.25s ease;
        }

        @keyframes popup{
            from{
                transform:scale(0.9);
                opacity:0;
            }
            to{
                transform:scale(1);
                opacity:1;
            }
        }

        .modal-content h3{
            margin-bottom:20px;
            color:#1e293b;
        }

        .modal-content label{
            font-size:14px;
            color:#475569;
        }

        .modal-content select,
        .modal-content input{
            width:100%;
            padding:12px;
            margin-top:8px;
            margin-bottom:15px;
            border-radius:10px;
            border:1px solid #d1d5db;
        }

        .book-btn{
            width:100%;
            background:#4f46e5;
            color:white;
            border:none;
            padding:12px;
            border-radius:10px;
            cursor:pointer;
            font-weight:500;
        }

        .book-btn:hover{
            background:#4338ca;
        }

        .cancel-btn{
            width:100%;
            margin-top:10px;
            background:#e5e7eb;
            border:none;
            padding:12px;
            border-radius:10px;
            cursor:pointer;
        }

    </style>
</head>

<body>

<div class="main-container">

    <!-- TOPBAR -->

    <div class="topbar">

        <h1 class="title">📅 Resource Booking System</h1>

        <a href="logout.php" class="logout-btn">
            Logout
        </a>

    </div>

    <!-- CALENDAR -->

    <div class="calendar-card">
        <div id="calendar"></div>
    </div>

</div>

<!-- BOOKING MODAL -->

<div class="modal" id="bookingModal">

    <div class="modal-content">

        <h3>Book Resource</h3>

        <form action="save_booking.php" method="POST">

            <input type="hidden" name="date" id="selectedDate">

            <label>Resource</label>

            <select name="resource_id" required>
                <option value="">Select Resource</option>
                <option value="1">Lab 1</option>
                <option value="2">Lab 2</option>
                <option value="3">Lab 3</option>
                <option value="4">Skill Lab 1</option>
                <option value="5">Skill Lab 2</option>
                <option value="6">Multimedia Room</option>
                <option value="7">Quadrangle</option>
                <option value="8">Conference Hall</option>
            </select>

            <label>Start Time</label>
            <input type="time" name="start_time" required>

            <label>End Time</label>
            <input type="time" name="end_time" required>

            <button type="submit" class="book-btn">
                Confirm Booking
            </button>

        </form>

        <button onclick="closeModal()" class="cancel-btn">
            Cancel
        </button>

    </div>

</div>

<!-- FullCalendar -->

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    var calendar = new FullCalendar.Calendar(
        document.getElementById('calendar'),

    {
        initialView: 'dayGridMonth',

        height: "auto",

        events: 'fetch_events.php',

        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },

        dateClick: function(info){

            document.getElementById('selectedDate').value = info.dateStr;

            document.getElementById('bookingModal').style.display = 'flex';
        }
    });

    calendar.render();
});

function closeModal(){
    document.getElementById('bookingModal').style.display = 'none';
}

</script>

</body>
</html>