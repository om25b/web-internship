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
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $case_type = mysqli_real_escape_string($conn, $_POST['case_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $start_date = $_POST['start_date'] ? "'" . mysqli_real_escape_string($conn, $_POST['start_date']) . "'" : 'NULL';
    $end_date = $_POST['end_date'] ? "'" . mysqli_real_escape_string($conn, $_POST['end_date']) . "'" : 'NULL';

    // Validate client_id and lawyer_id exist
    $client_check = mysqli_query($conn, "SELECT client_id FROM client WHERE client_id = $client_id");
    $lawyer_check = mysqli_query($conn, "SELECT lawyer_id FROM lawyer WHERE lawyer_id = $lawyer_id");

    if (mysqli_num_rows($client_check) == 0) {
        $message = "Error: Invalid Client ID.";
    } elseif (mysqli_num_rows($lawyer_check) == 0) {
        $message = "Error: Invalid Lawyer ID.";
    } else {
        $sql = "INSERT INTO cases (client_id, lawyer_id, title, case_type, description, status, start_date, end_date) 
                VALUES ($client_id, $lawyer_id, '$title', '$case_type', '$description', '$status', $start_date, $end_date)";

        if (mysqli_query($conn, $sql)) {
            $message = "Case registered successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}

// Fetch clients and lawyers for dropdowns
$clients = mysqli_query($conn, "SELECT client_id, name FROM client");
$lawyers = mysqli_query($conn, "SELECT lawyer_id, name FROM lawyer");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Case Registration - Law Firm Management</title>
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
        <h2>Case Registration</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="client_id">Client</label>
                <select id="client_id" name="client_id" required>
                    <option value="">Select Client</option>
                    <?php while ($client = mysqli_fetch_assoc($clients)): ?>
                        <option value="<?php echo $client['client_id']; ?>">
                            <?php echo $client['client_id'] . ' - ' . htmlspecialchars($client['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lawyer_id">Lawyer</label>
                <select id="lawyer_id" name="lawyer_id" required>
                    <option value="">Select Lawyer</option>
                    <?php while ($lawyer = mysqli_fetch_assoc($lawyers)): ?>
                        <option value="<?php echo $lawyer['lawyer_id']; ?>">
                            <?php echo $lawyer['lawyer_id'] . ' - ' . htmlspecialchars($lawyer['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Case Title</label>
                <input type="text" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="case_type">Case Type</label>
                <input type="text" id="case_type" name="case_type">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date">
            </div>
            <button type="submit">Register Case</button>
        </form>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>