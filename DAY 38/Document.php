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
    $case_id = (int)$_POST['case_id'];
    $document_name = mysqli_real_escape_string($conn, $_POST['document_name']);
    $document_type = mysqli_real_escape_string($conn, $_POST['document_type']);
    $upload_date = mysqli_real_escape_string($conn, $_POST['upload_date']);
    
    $file_path = '';
    if (isset($_FILES['file_path']) && $_FILES['file_path']['name'] != '') {
        $target_dir = "Uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_path = $target_dir . basename($_FILES["file_path"]["name"]);
        if (move_uploaded_file($_FILES["file_path"]["tmp_name"], $file_path)) {
            $message = "File uploaded successfully!";
        } else {
            $message = "Error uploading file.";
        }
    }

    $sql = "INSERT INTO document (case_id, document_name, document_type, upload_date, file_path) 
            VALUES ($case_id, '$document_name', '$document_type', '$upload_date', '$file_path')";

    if (mysqli_query($conn, $sql)) {
        $message = "Document registered successfully!";
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
    <title>Document Registration - Law Firm Management</title>
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
        <h2>Document Registration</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="doc_case_id">Case ID</label>
                <input type="number" id="doc_case_id" name="case_id" required>
            </div>
            <div class="form-group">
                <label for="document_name">Document Name</label>
                <input type="text" id="document_name" name="document_name" required>
            </div>
            <div class="form-group">
                <label for="document_type">Document Type</label>
                <input type="text" id="document_type" name="document_type">
            </div>
            <div class="form-group">
                <label for="upload_date">Upload Date</label>
                <input type="date" id="upload_date" name="upload_date" required>
            </div>
            <div class="form-group">
                <label for="file_path">Upload File</label>
                <input type="file" id="file_path" name="file_path">
            </div>
            <button type="submit">Register Document</button>
        </form>
    </div>
</body>
</html>