<?php

// Function to generate the calendar
function generateCalendar($month, $year, $events = []) {

  // Get the first day of the month
  $firstDay = mktime(0, 0, 0, $month, 1, $year);

  // Get number of days in the month
  $daysInMonth = date('t', $firstDay);

  // Get the day of the week for the first day
  $dayOfWeek = date('w', $firstDay);

  // Create table header
  $calendar = "<table style='width:100%; margin-bottom:20px;'>";
  $calendar .= "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

  // Add empty cells before the first day
  for ($i = 0; $i < $dayOfWeek; $i++) {
    $calendar .= "<td></td>";
  }

  // Loop through each day in the month
  for ($i = 1; $i <= $daysInMonth; $i++) {
    $currentDate = $year . '-' . sprintf("%02d", $month) . '-' . sprintf("%02d", $i);

    $eventClass = "";
    if (isset($events[$currentDate])) {
      $eventClass = " event-highlight";
    }

    // Check if it's the current day
    $isCurrentDay = (date('Y-m-d') === $currentDate) ? ' current-day' : '';

    $calendar .= "<td class='$eventClass$isCurrentDay'>" . $i . "</td>";

    // Add a new table row after every Saturday
    if (($i + $dayOfWeek) % 7 === 0) {
      $calendar .= "</tr><tr>";
    }
  }

  // Add empty cells after the last day
  for ($i = ($dayOfWeek + $daysInMonth) % 7; $i < 6; $i++) {
    $calendar .= "<td></td>";
  }

  // Close the table
  $calendar .= "</table>";

  return $calendar;
}

// Get current month and year (or from user input)
$currentMonth = (isset($_GET['month'])) ? (int)$_GET['month'] : date('m');
$currentYear = (isset($_GET['year'])) ? (int)$_GET['year'] : date('Y');

// Define any events (replace with your event fetching logic)
    $events = array();
    $e_sel = "SELECT * FROM tbl_event ORDER BY event_date ASC";
    $e_sele= $db->prepare($e_sel);
    $e_sele->execute();
    while($e_row=$e_sele->fetch()){
        $events[$e_row['event_date']] = $e_row['event_date'];
    }
// $events = [
//   '2024-03-15' => 'Meeting',
//   '2024-04-22' => 'Deadline',
// ];

// Previous and next month buttons
$prevMonth = $currentMonth - 1;
$prevYear = $currentYear;
if ($prevMonth < 1) {
  $prevMonth = 12;
  $prevYear--;
}

$nextMonth = $currentMonth + 1;
$nextYear = $currentYear;
if ($nextMonth > 12) {
  $nextMonth = 1;
  $nextYear++;
}

// Generate the calendar
$calendar = generateCalendar($currentMonth, $currentYear, $events);

?>


  <style>
    table { border-collapse: collapse; }
    th, td { padding: 5px; text-align: center; }
    .event-highlight { background-color: #000066; color:#FFF;}
    .current-day { font-weight: bold; }
  </style>
<?php
    echo'<div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-12">';
?>
    <p style="margin-top:50px; text-align:center;">
        <h1 style="margin:auto; text-align:center;">School Calendar </h1>
    </p>
    <div style="text-align:center; margin-bottom:20px;">
        <a href="?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>">Previous Month</a> | 
        <a href="?month=<?php echo $currentMonth; ?>&year=<?php echo $currentYear; ?>"  ><b><?php echo date('F Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)); ?></b></a> |
        <a href="?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">Next Month</a>
    </div>
  <?php echo $calendar; ?>

  <div class="col-lg-12 col-md-12 mb-12"> 
    <h4 style="margin:auto; text-align:center;">Event List</h4>
    <div class="ts-intro">
        <?php
            if(isset($_GET['month'])&&isset($_GET['year'])){
                $currentMonth = $_GET['month'];
                $currentYear  = $_GET['year'];
            }
            else{
                $currentMonth = date('m');
                $currentYear  = date('Y');
            }
            $ee_sel = "SELECT * FROM tbl_event WHERE year(event_date)=$currentYear AND month(event_date)=$currentMonth";
            $ee_sele= $db->prepare($ee_sel);
            $ee_sele->execute();
            while($ee_row=$ee_sele->fetch()){
        ?>
        <h4 class="into-sub-title" style="font-size:20px; text-align:center;"><?php echo $ee_row['event_title']?><br>
        <small style="text-align:center;"><?php echo date("F j, Y", strtotime($ee_row['event_date']))?></small></h4>
        <p style="text-align:center;"><?php echo $ee_row['description']?></p>
        <?php
            }
        ?>
    </div><!-- Intro box end -->
  </div>
  <?php
            echo'</div>';
        echo'</div>';
    echo'</div>';
?>