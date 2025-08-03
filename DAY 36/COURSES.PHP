<!DOCTYPE html>
<html lang="en">
  <head>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   </head>
  <body>
    <br><br>
        <form action="" method="POST">
        <div class="container">
            <div class="row">
                <table id="example" class="table table-striped table-bordered" >
                    <thead>
                        <tr>
                            <th>Course ID</th>
                            <th>Name</th>
                            <th>Duration</th>
                            <th>Fees</th>
                        </tr>
                    </thead>
                        <tbody>
                    <?php
                     require('connect.php');
                    $sql = "SELECT course_id, name, duration, fees FROM courses";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $course_id = $row['course_id'];
                        $name = $row['name'];
                        $duration = $row['duration'];
                        $fees = $row['fees'];
                    ?> 
                        <tr>
                            <td><?php echo $course_id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $duration; ?></td>
                            <td><?php echo $fees; ?></td>
                        </tr>
                <?php   }  //End of while loop
                ?>     
                    </tbody>   
                </table>
            </div>
        </div>
        </form> </body>
</html>
