<!DOCTYPE html>
<html>
<head>
    <title>MySQL Data in DataTable</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <th>Registration Details</th>
    <?php
require('connect.php');
$sql = "SELECT id, name, email, address, phone FROM registration";
 $result = mysqli_query($conn, $sql);
?>
<table id="userTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>". $row["id"] ."</td>
                        <td>". $row["name"] ."</td>
                        <td>". $row["email"] ."</td>
                        <td>". $row["address"] ."</td>
                        <td>". $row["phone"] ."</td>
                      </tr>";
            }
        }
        ?>
    </tbody>
</table>
    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>
</body>
</html>