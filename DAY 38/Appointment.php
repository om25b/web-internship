<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "law_firm";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = (int)$_POST['client_id'];
    $lawyer_id = (int)$_POST['lawyer_id'];
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO appointment (client_id, lawyer_id, appointment_date, purpose, status) 
            VALUES ($client_id, $lawyer_id, '$appointment_date', '$purpose', '$status')";

    if (mysqli_query($conn, $sql)) {
        $message = "Appointment registered successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Registration - Law Firm Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: #fff;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            color: #333;
            font-weight: bold;
            margin-bottom: 8px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #4b6cb7;
            box-shadow: 0 0 5px rgba(75, 108, 183, 0.5);
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4b6cb7, #182848);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: linear-gradient(135deg, #182848, #4b6cb7);
        }
        .message {
            text-align: center;
            margin-top: 15px;
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Appointment Registration</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="app_client_id">Client ID</label>
                <input type="number" id="app_client_id" name="client_id" required>
            </div>
            <div class="form-group">
                <label for="app_lawyer_id">Lawyer ID</label>
                <input type="number" id="app_lawyer_id" name="lawyer_id" required>
            </div>
            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="datetime-local" id="appointment_date" name="appointment_date" required>
            </div>
            <div class="form-group">
                <label for="purpose">Purpose</label>
                <input type="text" id="purpose" name="purpose">
            </div>
            <div class="form-group">
                <label for="app_status">Status</label>
                <select id="app_status" name="status">
                    <option value="Scheduled">Scheduled</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <button type="submit">Register Appointment</button>
        </form>
    </div>
</body>
</html>