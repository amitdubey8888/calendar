<?php
    $user='root';
    $pass='';
    $db='calendar';
    $db=new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
    $getdata = "SELECT * FROM data";
    $sql = mysqli_query($db, "SELECT * FROM data");
    $new_arr = [];
    while($row = mysqli_fetch_assoc($sql)){
      $data = array("title"=>$row['title'], "start"=>$row['start_date_time'], "end"=>$row['end_date_time']);
      array_push($new_arr, $data);
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
<link href='../fullcalendar.min.css' rel='stylesheet' />
<link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../fullcalendar.min.js'></script>
<script src='js/theme-chooser.js'></script>
<script>
  var arr = <?php echo json_encode($new_arr); ?>;
  console.log(arr);
  $(document).ready(function() {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth()+1;
    var y = date.getFullYear();
    if(d<10){
      d = '0'+d;
    }
    if(m<10){
      m = '0'+m;
    }
    initThemeChooser({
      init: function() {
        $('#calendar').fullCalendar({
          themeSystem: 'bootstrap4',
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
          },
          defaultDate: y+'-'+m+'-'+d,
          weekNumbers: true,
          navLinks: true,
          editable: true,
          eventLimit: true,
          events: arr
        });
      },
    });
  });
</script>
<style>

  body {
    margin: 0;
    padding: 0;
    font-size: 14px;
  }

  #top,
  #calendar.fc-unthemed {
    font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  }

  #top {
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    font-size: 12px;
    color: #000;
  }

  #top .selector {
    display: inline-block;
    margin-right: 10px;
  }

  #top select {
    font: inherit; /* mock what Boostrap does, don't compete  */
  }

  .left { float: left }
  .right { float: right }
  .clear { clear: both }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
  }
.add{
  text-decoration: none;
  font-weight: bold;
  font-size: 1.2em;
}
</style>
</head>
<body>
  <div id='top'>
    <div class='left'>
        <div id='theme-system-selector' class='selector'>
          <select><option value='bootstrap4' selected>Google Calendar</option></select>
        </div>
        <div class="add-event">
          <a href="add_event.php" class="add">Add Event</a>
        </div>
      </div>
    <div class='right'></div>
    <div class='clear'></div>
  </div>

  <div id='calendar'></div>

</body>
</html>
