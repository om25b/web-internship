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
                            <th>Patient ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Symptoms</th>
                        </tr>
                    </thead>
                        <tbody>
                    <?php
                     require('connect.php');
                    $sql = "SELECT patient_id, name, age, gender, phone, symptoms FROM patients";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $patient_id = $row['patient_id'];
                        $name = $row['name'];
                        $age = $row['age'];
                        $gender = $row['gender'];
                        $phone = $row['phone'];
                        $symptoms = $row['symptoms'];
                    ?> 
                        <tr>
                            <td><?php echo $patient_id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $age; ?></td>
                            <td><?php echo $gender; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $symptoms; ?></td>
                        </tr>
                <?php   } 
                ?>     
                    </tbody>   
                </table>
            </div>
        </div>
        </form> </body>
</html>
