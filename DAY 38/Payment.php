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
    $case_id = (int)$_POST['case_id'];
    $amount = (float)$_POST['amount'];
    $payment_date = mysqli_real_escape_string($conn, $_POST['payment_date']);
    $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO payment (client_id, case_id, amount, payment_date, payment_mode, status) 
            VALUES ($client_id, $case_id, $amount, '$payment_date', '$payment_mode', '$status')";

    if (mysqli_query($conn, $sql)) {
        $message = "Payment registered successfully!";
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
    <title>Payment Registration - Law Firm Management</title>
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
        <h2>Payment Registration</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="pay_client_id">Client ID</label>
                <input type="number" id="pay_client_id" name="client_id" required>
            </div>
            <div class="form-group">
                <label for="pay_case_id">Case ID</label>
                <input type="number" id="pay_case_id" name="case_id" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" id="amount" name="amount" required>
            </div>
            <div class="form-group">
                <label for="payment_date">Payment Date</label>
                <input type="date" id="payment_date" name="payment_date" required>
            </div>
            <div class="form-group">
                <label for="payment_mode">Payment Mode</label>
                <select id="payment_mode" name="payment_mode">
                    <option value="Cash">Cash</option>
                    <option value="UPI">UPI</option>
                    <option value="Card">Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pay_status">Status</label>
                <select id="pay_status" name="status">
                    <option value="Paid">Paid</  option>
                    <option value="Pending">Pending</option>
                </select>
            </div>
            <button type="submit">Register Payment</button>
        </form>
    </div>
</body>
</html>