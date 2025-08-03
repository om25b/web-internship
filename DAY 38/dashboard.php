<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Law Firm Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6b48ff, #ff4e50);
            color: #333;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: #fff;
            position: fixed;
            height: 100%;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        h1 {
            color: #fff;
            margin-bottom: 20px;
            text-align: center;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
        .card h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #3498db;
            color: #fff;
        }
        tr:hover {
            background: #f5f6fa;
        }
        .action-btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
            margin-right: 5px;
        }
        .edit-btn {
            background: #27ae60;
        }
        .edit-btn:hover {
            background: #219653;
        }
        .delete-btn {
            background: #e74c3c;
        }
        .delete-btn:hover {
            background: #c0392b;
        }
        form {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background: #2980b9;
        }
        p {
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#lawyers">Lawyers</a>
        <a href="#clients">Clients</a>
        <a href="#cases">Cases</a>
        <a href="#appointments">Appointments</a>
        <a href="#hearings">Hearings</a>
        <a href="#documents">Documents</a>
        <a href="#payments">Payments</a>
    </div>
    <div class="main-content">
        <h1>Law Firm Dashboard</h1>

        <?php
        require('connect.php');

        // Initialize message variable
        $message = "";

        // Handle form submissions for editing records
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['edit_lawyer'])) {
                $lawyer_id = (int)$_POST['lawyer_id'];
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
                $experience_years = !empty($_POST['experience_years']) ? (int)$_POST['experience_years'] : null;
                $sql = "UPDATE lawyer SET name='$name', email='$email', phone='$phone', specialization='$specialization', experience_years=" . ($experience_years ? $experience_years : 'NULL') . " WHERE lawyer_id=$lawyer_id";
                if (mysqli_query($conn, $sql)) {
                    $message = "Lawyer updated successfully!";
                } else {
                    $message = "Error updating lawyer: " . mysqli_error($conn);
                }
            } elseif (isset($_POST['edit_client'])) {
                $client_id = (int)$_POST['client_id'];
                $name = mysqli_real_escape_string($conn, $_POST['name']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $phone = mysqli_real_escape_string($conn, $_POST['phone']);
                $address = mysqli_real_escape_string($conn, $_POST['address']);
                $aadhar_no = !empty($_POST['aadhar_no']) ? mysqli_real_escape_string($conn, $_POST['aadhar_no']) : null;
                if ($aadhar_no) {
                    $aadhar_check = mysqli_query($conn, "SELECT aadhar_no FROM client WHERE aadhar_no='$aadhar_no' AND client_id != $client_id");
                    if (mysqli_num_rows($aadhar_check) > 0) {
                        $message = "Error: Aadhar number '$aadhar_no' already exists.";
                    } else {
                        $sql = "UPDATE client SET name='$name', email='$email', phone='$phone', address='$address', aadhar_no=" . ($aadhar_no ? "'$aadhar_no'" : 'NULL') . " WHERE client_id=$client_id";
                        if (mysqli_query($conn, $sql)) {
                            $message = "Client updated successfully!";
                        } else {
                            $message = "Error updating client: " . mysqli_error($conn);
                        }
                    }
                } else {
                    $sql = "UPDATE client SET name='$name', email='$email', phone='$phone', address='$address', aadhar_no=NULL WHERE client_id=$client_id";
                    if (mysqli_query($conn, $sql)) {
                        $message = "Client updated successfully!";
                    } else {
                        $message = "Error updating client: " . mysqli_error($conn);
                    }
                }
            } elseif (isset($_POST['edit_case'])) {
                $case_id = (int)$_POST['case_id'];
                $client_id = (int)$_POST['client_id'];
                $lawyer_id = (int)$_POST['lawyer_id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $case_type = mysqli_real_escape_string($conn, $_POST['case_type']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $start_date = !empty($_POST['start_date']) ? "'" . mysqli_real_escape_string($conn, $_POST['start_date']) . "'" : 'NULL';
                $end_date = !empty($_POST['end_date']) ? "'" . mysqli_real_escape_string($conn, $_POST['end_date']) . "'" : 'NULL';
                $client_check = mysqli_query($conn, "SELECT client_id FROM client WHERE client_id=$client_id");
                $lawyer_check = mysqli_query($conn, "SELECT lawyer_id FROM lawyer WHERE lawyer_id=$lawyer_id");
                if (mysqli_num_rows($client_check) == 0 || mysqli_num_rows($lawyer_check) == 0) {
                    $message = "Error: Invalid Client ID or Lawyer ID.";
                } else {
                    $sql = "UPDATE cases SET client_id=$client_id, lawyer_id=$lawyer_id, title='$title', case_type='$case_type', description='$description', status='$status', start_date=$start_date, end_date=$end_date WHERE case_id=$case_id";
                    if (mysqli_query($conn, $sql)) {
                        $message = "Case updated successfully!";
                    } else {
                        $message = "Error updating case: " . mysqli_error($conn);
                    }
                }
            } elseif (isset($_POST['edit_appointment'])) {
                $appointment_id = (int)$_POST['appointment_id'];
                $client_id = (int)$_POST['client_id'];
                $lawyer_id = (int)$_POST['lawyer_id'];
                $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
                $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $client_check = mysqli_query($conn, "SELECT client_id FROM client WHERE client_id=$client_id");
                $lawyer_check = mysqli_query($conn, "SELECT lawyer_id FROM lawyer WHERE lawyer_id=$lawyer_id");
                if (mysqli_num_rows($client_check) == 0 || mysqli_num_rows($lawyer_check) == 0) {
                    $message = "Error: Invalid Client ID or Lawyer ID.";
                } else {
                    $sql = "UPDATE appointment SET client_id=$client_id, lawyer_id=$lawyer_id, appointment_date='$appointment_date', purpose='$purpose', status='$status' WHERE appointment_id=$appointment_id";
                    if (mysqli_query($conn, $sql)) {
                        $message = "Appointment updated successfully!";
                    } else {
                        $message = "Error updating appointment: " . mysqli_error($conn);
                    }
                }
            } elseif (isset($_POST['edit_hearing'])) {
                $hearing_id = (int)$_POST['hearing_id'];
                $case_id = (int)$_POST['case_id'];
                $hearing_date = mysqli_real_escape_string($conn, $_POST['hearing_date']);
                $court_name = mysqli_real_escape_string($conn, $_POST['court_name']);
                $judge_name = mysqli_real_escape_string($conn, $_POST['judge_name']);
                $outcome = mysqli_real_escape_string($conn, $_POST['outcome']);
                $case_check = mysqli_query($conn, "SELECT case_id FROM cases WHERE case_id=$case_id");
                if (mysqli_num_rows($case_check) == 0) {
                    $message = "Error: Invalid Case ID.";
                } else {
                    $sql = "UPDATE hearing SET case_id=$case_id, hearing_date='$hearing_date', court_name='$court_name', judge_name='$judge_name', outcome='$outcome' WHERE hearing_id=$hearing_id";
                    if (mysqli_query($conn, $sql)) {
                        $message = "Hearing updated successfully!";
                    } else {
                        $message = "Error updating hearing: " . mysqli_error($conn);
                    }
                }
            } elseif (isset($_POST['edit_document'])) {
                $document_id = (int)$_POST['document_id'];
                $case_id = (int)$_POST['case_id'];
                $document_name = mysqli_real_escape_string($conn, $_POST['document_name']);
                $document_type = mysqli_real_escape_string($conn, $_POST['document_type']);
                $upload_date = mysqli_real_escape_string($conn, $_POST['upload_date']);
                $file_path = !empty($_POST['file_path']) ? mysqli_real_escape_string($conn, $_POST['file_path']) : '';
                $case_check = mysqli_query($conn, "SELECT case_id FROM cases WHERE case_id=$case_id");
                if (mysqli_num_rows($case_check) == 0) {
                    $message = "Error: Invalid Case ID.";
                } else {
                    $sql = "UPDATE document SET case_id=$case_id, document_name='$document_name', document_type='$document_type', upload_date='$upload_date', file_path='$file_path' WHERE document_id=$document_id";
                    if (mysqli_query($conn, $sql)) {
                        $message = "Document updated successfully!";
                    } else {
                        $message = "Error updating document: " . mysqli_error($conn);
                    }
                }
            } elseif (isset($_POST['edit_payment'])) {
                $payment_id = (int)$_POST['payment_id'];
                $client_id = (int)$_POST['client_id'];
                $case_id = (int)$_POST['case_id'];
                $amount = (float)$_POST['amount'];
                $payment_date = mysqli_real_escape_string($conn, $_POST['payment_date']);
                $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
                $status = mysqli_real_escape_string($conn, $_POST['status']);
                $client_check = mysqli_query($conn, "SELECT client_id FROM client WHERE client_id=$client_id");
                $case_check = mysqli_query($conn, "SELECT case_id FROM cases WHERE case_id=$case_id");
                if (mysqli_num_rows($client_check) == 0 || mysqli_num_rows($case_check) == 0) {
                    $message = "Error: Invalid Client ID or Case ID.";
                } else {
                    $sql = "UPDATE payment SET client_id=$client_id, case_id=$case_id, amount=$amount, payment_date='$payment_date', payment_mode='$payment_mode', status='$status' WHERE payment_id=$payment_id";
                    if (mysqli_query($conn, $sql)) {
                        $message = "Payment updated successfully!";
                    } else {
                        $message = "Error updating payment: " . mysqli_error($conn);
                    }
                }
            }
        }

        // Handle delete requests
        if (isset($_GET['delete'])) {
            $delete_type = $_GET['delete'];
            $id = (int)$_GET['id'];
            if ($delete_type == 'lawyer') {
                $sql = "DELETE FROM lawyer WHERE lawyer_id=$id";
            } elseif ($delete_type == 'client') {
                $sql = "DELETE FROM client WHERE client_id=$id";
            } elseif ($delete_type == 'case') {
                $sql = "DELETE FROM cases WHERE case_id=$id";
            } elseif ($delete_type == 'appointment') {
                $sql = "DELETE FROM appointment WHERE appointment_id=$id";
            } elseif ($delete_type == 'hearing') {
                $sql = "DELETE FROM hearing WHERE hearing_id=$id";
            } elseif ($delete_type == 'document') {
                $sql = "DELETE FROM document WHERE document_id=$id";
            } elseif ($delete_type == 'payment') {
                $sql = "DELETE FROM payment WHERE payment_id=$id";
            }
            if (mysqli_query($conn, $sql)) {
                $message = ucfirst($delete_type) . " deleted successfully!";
            } else {
                $message = "Error deleting " . $delete_type . ": " . mysqli_error($conn);
            }
        }

        // Display edit form based on GET parameter
        if (isset($_GET['edit'])) {
            $edit_type = $_GET['edit'];
            $id = (int)$_GET['id'];
            if ($edit_type == 'lawyer') {
                $sql = "SELECT * FROM lawyer WHERE lawyer_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
        ?>
                <div class="card">
                    <h2>Edit Lawyer</h2>
                    <form method="POST">
                        <input type="hidden" name="lawyer_id" value="<?php echo $row['lawyer_id']; ?>">
                        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
                        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
                        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>"><br>
                        Specialization: <input type="text" name="specialization" value="<?php echo htmlspecialchars($row['specialization']); ?>"><br>
                        Experience Years: <input type="number" name="experience_years" value="<?php echo htmlspecialchars($row['experience_years'] ?? ''); ?>"><br>
                        <input type="submit" name="edit_lawyer" value="Update Lawyer">
                    </form>
                </div>
        <?php
            } elseif ($edit_type == 'client') {
                $sql = "SELECT * FROM client WHERE client_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
        ?>
                <div class="card">
                    <h2>Edit Client</h2>
                    <form method="POST">
                        <input type="hidden" name="client_id" value="<?php echo $row['client_id']; ?>">
                        Name: <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
                        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
                        Phone: <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>"><br>
                        Address: <textarea name="address"><?php echo htmlspecialchars($row['address']); ?></textarea><br>
                        Aadhar Number: <input type="text" name="aadhar_no" value="<?php echo htmlspecialchars($row['aadhar_no'] ?? ''); ?>"><br>
                        <input type="submit" name="edit_client" value="Update Client">
                    </form>
                </div>
        <?php
            } elseif ($edit_type == 'case') {
                $sql = "SELECT * FROM cases WHERE case_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $clients = mysqli_query($conn, "SELECT client_id, name FROM client");
                $lawyers = mysqli_query($conn, "SELECT lawyer_id, name FROM lawyer");
        ?>
                <div class="card">
                    <h2>Edit Case</h2>
                    <form method="POST">
                        <input type="hidden" name="case_id" value="<?php echo $row['case_id']; ?>">
                        Client: <select name="client_id" required>
                            <?php while ($client = mysqli_fetch_assoc($clients)) { ?>
                                <option value="<?php echo $client['client_id']; ?>" <?php if ($client['client_id'] == $row['client_id']) echo 'selected'; ?>>
                                    <?php echo $client['client_id'] . ' - ' . htmlspecialchars($client['name']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Lawyer: <select name="lawyer_id" required>
                            <?php while ($lawyer = mysqli_fetch_assoc($lawyers)) { ?>
                                <option value="<?php echo $lawyer['lawyer_id']; ?>" <?php if ($lawyer['lawyer_id'] == $row['lawyer_id']) echo 'selected'; ?>>
                                    <?php echo $lawyer['lawyer_id'] . ' - ' . htmlspecialchars($lawyer['name']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Title: <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>"><br>
                        Case Type: <input type="text" name="case_type" value="<?php echo htmlspecialchars($row['case_type']); ?>"><br>
                        Description: <textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea><br>
                        Status: <select name="status">
                            <option value="Open" <?php if ($row['status'] == 'Open') echo 'selected'; ?>>Open</option>
                            <option value="Closed" <?php if ($row['status'] == 'Closed') echo 'selected'; ?>>Closed</option>
                            <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        </select><br>
                        Start Date: <input type="date" name="start_date" value="<?php echo htmlspecialchars($row['start_date'] ?? ''); ?>"><br>
                        End Date: <input type="date" name="end_date" value="<?php echo htmlspecialchars($row['end_date'] ?? ''); ?>"><br>
                        <input type="submit" name="edit_case" value="Update Case">
                    </form>
                </div>
        <?php
            } elseif ($edit_type == 'appointment') {
                $sql = "SELECT * FROM appointment WHERE appointment_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $clients = mysqli_query($conn, "SELECT client_id, name FROM client");
                $lawyers = mysqli_query($conn, "SELECT lawyer_id, name FROM lawyer");
        ?>
                <div class="card">
                    <h2>Edit Appointment</h2>
                    <form method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                        Client: <select name="client_id" required>
                            <?php while ($client = mysqli_fetch_assoc($clients)) { ?>
                                <option value="<?php echo $client['client_id']; ?>" <?php if ($client['client_id'] == $row['client_id']) echo 'selected'; ?>>
                                    <?php echo $client['client_id'] . ' - ' . htmlspecialchars($client['name']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Lawyer: <select name="lawyer_id" required>
                            <?php while ($lawyer = mysqli_fetch_assoc($lawyers)) { ?>
                                <option value="<?php echo $lawyer['lawyer_id']; ?>" <?php if ($lawyer['lawyer_id'] == $row['lawyer_id']) echo 'selected'; ?>>
                                    <?php echo $lawyer['lawyer_id'] . ' - ' . htmlspecialchars($lawyer['name']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Appointment Date: <input type="datetime-local" name="appointment_date" value="<?php echo htmlspecialchars($row['appointment_date']); ?>" required><br>
                        Purpose: <input type="text" name="purpose" value="<?php echo htmlspecialchars($row['purpose']); ?>"><br>
                        Status: <select name="status">
                            <option value="Scheduled" <?php if ($row['status'] == 'Scheduled') echo 'selected'; ?>>Scheduled</option>
                            <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="Cancelled" <?php if ($row['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select><br>
                        <input type="submit" name="edit_appointment" value="Update Appointment">
                    </form>
                </div>
        <?php
            } elseif ($edit_type == 'hearing') {
                $sql = "SELECT * FROM hearing WHERE hearing_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $cases = mysqli_query($conn, "SELECT case_id, title FROM cases");
        ?>
                <div class="card">
                    <h2>Edit Hearing</h2>
                    <form method="POST">
                        <input type="hidden" name="hearing_id" value="<?php echo $row['hearing_id']; ?>">
                        Case: <select name="case_id" required>
                            <?php while ($case = mysqli_fetch_assoc($cases)) { ?>
                                <option value="<?php echo $case['case_id']; ?>" <?php if ($case['case_id'] == $row['case_id']) echo 'selected'; ?>>
                                    <?php echo $case['case_id'] . ' - ' . htmlspecialchars($case['title']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Hearing Date: <input type="date" name="hearing_date" value="<?php echo htmlspecialchars($row['hearing_date']); ?>" required><br>
                        Court Name: <input type="text" name="court_name" value="<?php echo htmlspecialchars($row['court_name']); ?>"><br>
                        Judge Name: <input type="text" name="judge_name" value="<?php echo htmlspecialchars($row['judge_name']); ?>"><br>
                        Outcome: <textarea name="outcome"><?php echo htmlspecialchars($row['outcome']); ?></textarea><br>
                        <input type="submit" name="edit_hearing" value="Update Hearing">
                    </form>
                </div>
        <?php
            } elseif ($edit_type == 'document') {
                $sql = "SELECT * FROM document WHERE document_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $cases = mysqli_query($conn, "SELECT case_id, title FROM cases");
        ?>
                <div class="card">
                    <h2>Edit Document</h2>
                    <form method="POST">
                        <input type="hidden" name="document_id" value="<?php echo $row['document_id']; ?>">
                        Case: <select name="case_id" required>
                            <?php while ($case = mysqli_fetch_assoc($cases)) { ?>
                                <option value="<?php echo $case['case_id']; ?>" <?php if ($case['case_id'] == $row['case_id']) echo 'selected'; ?>>
                                    <?php echo $case['case_id'] . ' - ' . htmlspecialchars($case['title']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Document Name: <input type="text" name="document_name" value="<?php echo htmlspecialchars($row['document_name']); ?>" required><br>
                        Document Type: <input type="text" name="document_type" value="<?php echo htmlspecialchars($row['document_type']); ?>"><br>
                        Upload Date: <input type="date" name="upload_date" value="<?php echo htmlspecialchars($row['upload_date']); ?>" required><br>
                        File Path: <input type="text" name="file_path" value="<?php echo htmlspecialchars($row['file_path']); ?>"><br>
                        <input type="submit" name="edit_document" value="Update Document">
                    </form>
                </div>
        <?php
            } elseif ($edit_type == 'payment') {
                $sql = "SELECT * FROM payment WHERE payment_id=$id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $clients = mysqli_query($conn, "SELECT client_id, name FROM client");
                $cases = mysqli_query($conn, "SELECT case_id, title FROM cases");
        ?>
                <div class="card">
                    <h2>Edit Payment</h2>
                    <form method="POST">
                        <input type="hidden" name="payment_id" value="<?php echo $row['payment_id']; ?>">
                        Client: <select name="client_id" required>
                            <?php while ($client = mysqli_fetch_assoc($clients)) { ?>
                                <option value="<?php echo $client['client_id']; ?>" <?php if ($client['client_id'] == $row['client_id']) echo 'selected'; ?>>
                                    <?php echo $client['client_id'] . ' - ' . htmlspecialchars($client['name']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Case: <select name="case_id" required>
                            <?php while ($case = mysqli_fetch_assoc($cases)) { ?>
                                <option value="<?php echo $case['case_id']; ?>" <?php if ($case['case_id'] == $row['case_id']) echo 'selected'; ?>>
                                    <?php echo $case['case_id'] . ' - ' . htmlspecialchars($case['title']); ?>
                                </option>
                            <?php } ?>
                        </select><br>
                        Amount: <input type="number" step="0.01" name="amount" value="<?php echo htmlspecialchars($row['amount']); ?>" required><br>
                        Payment Date: <input type="date" name="payment_date" value="<?php echo htmlspecialchars($row['payment_date']); ?>" required><br>
                        Payment Mode: <select name="payment_mode">
                            <option value="Cash" <?php if ($row['payment_mode'] == 'Cash') echo 'selected'; ?>>Cash</option>
                            <option value="UPI" <?php if ($row['payment_mode'] == 'UPI') echo 'selected'; ?>>UPI</option>
                            <option value="Card" <?php if ($row['payment_mode'] == 'Card') echo 'selected'; ?>>Card</option>
                            <option value="Bank Transfer" <?php if ($row['payment_mode'] == 'Bank Transfer') echo 'selected'; ?>>Bank Transfer</option>
                        </select><br>
                        Status: <select name="status">
                            <option value="Paid" <?php if ($row['status'] == 'Paid') echo 'selected'; ?>>Paid</option>
                            <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        </select><br>
                        <input type="submit" name="edit_payment" value="Update Payment">
                    </form>
                </div>
        <?php
            }
        }

        // Display message if any
        if ($message) {
            echo "<p>$message</p>";
        }
        ?>

        <!-- Lawyers Card -->
        <div class="card" id="lawyers">
            <h2>Lawyers</h2>
            <table>
                <tr>
                    <th>Lawyer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Specialization</th>
                    <th>Experience Years</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT lawyer_id, name, email, phone, specialization, experience_years FROM lawyer";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $lawyer_id = $row['lawyer_id'];
                        $name = htmlspecialchars($row['name']);
                        $email = htmlspecialchars($row['email']);
                        $phone = htmlspecialchars($row['phone']);
                        $specialization = htmlspecialchars($row['specialization']);
                        $experience_years = htmlspecialchars($row['experience_years'] ?? 'N/A');
                ?>
                        <tr>
                            <td><?php echo $lawyer_id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $specialization; ?></td>
                            <td><?php echo $experience_years; ?></td>
                            <td>
                                <a href="?edit=lawyer&id=<?php echo $lawyer_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=lawyer&id=<?php echo $lawyer_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this lawyer?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7">No lawyers found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- Clients Card -->
        <div class="card" id="clients">
            <h2>Clients</h2>
            <table>
                <tr>
                    <th>Client ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Aadhar Number</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT client_id, name, email, phone, address, aadhar_no FROM client";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $client_id = $row['client_id'];
                        $name = htmlspecialchars($row['name']);
                        $email = htmlspecialchars($row['email']);
                        $phone = htmlspecialchars($row['phone']);
                        $address = htmlspecialchars($row['address']);
                        $aadhar_no = htmlspecialchars($row['aadhar_no'] ?? 'N/A');
                ?>
                        <tr>
                            <td><?php echo $client_id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $aadhar_no; ?></td>
                            <td>
                                <a href="?edit=client&id=<?php echo $client_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=client&id=<?php echo $client_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this client?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7">No clients found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- Cases Card -->
        <div class="card" id="cases">
            <h2>Cases</h2>
            <table>
                <tr>
                    <th>Case ID</th>
                    <th>Client ID</th>
                    <th>Lawyer ID</th>
                    <th>Title</th>
                    <th>Case Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT case_id, client_id, lawyer_id, title, case_type, description, status, start_date, end_date FROM cases";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $case_id = $row['case_id'];
                        $client_id = $row['client_id'];
                        $lawyer_id = $row['lawyer_id'];
                        $title = htmlspecialchars($row['title']);
                        $case_type = htmlspecialchars($row['case_type']);
                        $description = htmlspecialchars($row['description']);
                        $status = htmlspecialchars($row['status']);
                        $start_date = htmlspecialchars($row['start_date'] ?? 'N/A');
                        $end_date = htmlspecialchars($row['end_date'] ?? 'N/A');
                ?>
                        <tr>
                            <td><?php echo $case_id; ?></td>
                            <td><?php echo $client_id; ?></td>
                            <td><?php echo $lawyer_id; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $case_type; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $start_date; ?></td>
                            <td><?php echo $end_date; ?></td>
                            <td>
                                <a href="?edit=case&id=<?php echo $case_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=case&id=<?php echo $case_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this case?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="10">No cases found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- Appointments Card -->
        <div class="card" id="appointments">
            <h2>Appointments</h2>
            <table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Client ID</th>
                    <th>Lawyer ID</th>
                    <th>Appointment Date</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT appointment_id, client_id, lawyer_id, appointment_date, purpose, status FROM appointment";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $appointment_id = $row['appointment_id'];
                        $client_id = $row['client_id'];
                        $lawyer_id = $row['lawyer_id'];
                        $appointment_date = htmlspecialchars($row['appointment_date']);
                        $purpose = htmlspecialchars($row['purpose']);
                        $status = htmlspecialchars($row['status']);
                ?>
                        <tr>
                            <td><?php echo $appointment_id; ?></td>
                            <td><?php echo $client_id; ?></td>
                            <td><?php echo $lawyer_id; ?></td>
                            <td><?php echo $appointment_date; ?></td>
                            <td><?php echo $purpose; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <a href="?edit=appointment&id=<?php echo $appointment_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=appointment&id=<?php echo $appointment_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this appointment?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7">No appointments found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- Hearings Card -->
        <div class="card" id="hearings">
            <h2>Hearings</h2>
            <table>
                <tr>
                    <th>Hearing ID</th>
                    <th>Case ID</th>
                    <th>Hearing Date</th>
                    <th>Court Name</th>
                    <th>Judge Name</th>
                    <th>Outcome</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT hearing_id, case_id, hearing_date, court_name, judge_name, outcome FROM hearing";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $hearing_id = $row['hearing_id'];
                        $case_id = $row['case_id'];
                        $hearing_date = htmlspecialchars($row['hearing_date']);
                        $court_name = htmlspecialchars($row['court_name']);
                        $judge_name = htmlspecialchars($row['judge_name']);
                        $outcome = htmlspecialchars($row['outcome']);
                ?>
                        <tr>
                            <td><?php echo $hearing_id; ?></td>
                            <td><?php echo $case_id; ?></td>
                            <td><?php echo $hearing_date; ?></td>
                            <td><?php echo $court_name; ?></td>
                            <td><?php echo $judge_name; ?></td>
                            <td><?php echo $outcome; ?></td>
                            <td>
                                <a href="?edit=hearing&id=<?php echo $hearing_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=hearing&id=<?php echo $hearing_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this hearing?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7">No hearings found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- Documents Card -->
        <div class="card" id="documents">
            <h2>Documents</h2>
            <table>
                <tr>
                    <th>Document ID</th>
                    <th>Case ID</th>
                    <th>Document Name</th>
                    <th>Document Type</th>
                    <th>Upload Date</th>
                    <th>File Path</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT document_id, case_id, document_name, document_type, upload_date, file_path FROM document";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $document_id = $row['document_id'];
                        $case_id = $row['case_id'];
                        $document_name = htmlspecialchars($row['document_name']);
                        $document_type = htmlspecialchars($row['document_type']);
                        $upload_date = htmlspecialchars($row['upload_date']);
                        $file_path = htmlspecialchars($row['file_path'] ?? 'N/A');
                ?>
                        <tr>
                            <td><?php echo $document_id; ?></td>
                            <td><?php echo $case_id; ?></td>
                            <td><?php echo $document_name; ?></td>
                            <td><?php echo $document_type; ?></td>
                            <td><?php echo $upload_date; ?></td>
                            <td><?php echo $file_path; ?></td>
                            <td>
                                <a href="?edit=document&id=<?php echo $document_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=document&id=<?php echo $document_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this document?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7">No documents found.</td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <!-- Payments Card -->
        <div class="card" id="payments">
            <h2>Payments</h2>
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Client ID</th>
                    <th>Case ID</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                    <th>Payment Mode</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT payment_id, client_id, case_id, amount, payment_date, payment_mode, status FROM payment";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $payment_id = $row['payment_id'];
                        $client_id = $row['client_id'];
                        $case_id = $row['case_id'];
                        $amount = htmlspecialchars($row['amount']);
                        $payment_date = htmlspecialchars($row['payment_date']);
                        $payment_mode = htmlspecialchars($row['payment_mode']);
                        $status = htmlspecialchars($row['status']);
                ?>
                        <tr>
                            <td><?php echo $payment_id; ?></td>
                            <td><?php echo $client_id; ?></td>
                            <td><?php echo $case_id; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $payment_date; ?></td>
                            <td><?php echo $payment_mode; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <a href="?edit=payment&id=<?php echo $payment_id; ?>" class="action-btn edit-btn"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=payment&id=<?php echo $payment_id; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this payment?')"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="8">No payments found.</td>
                    </tr>
                <?php
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
</body>
</html>