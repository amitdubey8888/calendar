<?php
    $user='root';
    $pass='';
    $db='calendar';
    $db=new mysqli('localhost',$user,$pass,$db) or die("Unable to connect");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
    .add_event{
        width:50%;
        margin:auto;
        margin-top:1%;
    }
    .display_event{
        width:75%;
        margin:auto;
        margin-top:1%;  
    }
    label{
        text-align:left;
        font-weight:500;
        width: 100%;
    }
    .event-title{
        text-align:center;
        width:100%;
    }
    </style>
</head>
<body>
    <center class="add_event">
    <form id="eventForm" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <h4 class="event-title">Add Event</h4>
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
        </div>
        <div class="form-group">
            <label for="start_date_time">Event Start Date & Time</label>
            <input type="text" class="form-control" name="start_date_time" id="start_date_time" placeholder="Enter Start Date & Time" required>
        </div>
        <div class="form-group">
            <label for="end_date">Event End Date & TIme</label>
            <input type="text" class="form-control" name="end_date_time" id="end_date_time" placeholder="Enter End Date & Time" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Event</button>
    </form>
    </center><br>
    <center class="display_event">
        <h4 class="event-title">Event List</h4><br>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Title</th>
                <th scope="col">Start Date & Time</th>
                <th scope="col">End Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i=0;
                    $getdata = "SELECT * FROM data";
                    $sql = mysqli_query($db, "SELECT * FROM data");
                    while($row = mysqli_fetch_assoc($sql)){ 
                      $i++;  
                ?>
                <tr>
                <th scope="row"><?=$i;?>.</th>
                <td><?=$row['title'];?></td>
                <td><?=$row['start_date_time'];?></td>
                <td><?=$row['end_date_time'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </center>
     <script>
        $(function() {
            $('input[name="start_date_time"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            });
            $('input[name="end_date_time"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                }
            });
        });
    </script>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $title=$_POST['title'];
        $start_date_time=isset($_POST['start_date_time'])?$_POST['start_date_time']:'null';
        $end_date_time=isset($_POST['end_date_time'])?$_POST['end_date_time']:'null';
        $sql="INSERT INTO data (title,start_date_time,end_date_time) VALUES ('$title','$start_date_time','$end_date_time')";
        mysqli_query($db,$sql);
    }
?>