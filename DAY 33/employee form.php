<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Employee Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2 class="text-center">Employee Registration Form</h2>
  <form action="insert.php" method="get">

    <div class="form-group">
      <label for="name">Employee Name:</label>
      <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="form-group">
      <label for="address">Address:</label>
      <input type="text" class="form-control" id="address" name="address" required>
    </div>

    <div class="form-group">
      <label for="phone">Phone Number:</label>
      <input type="text" class="form-control" id="phone" name="phone" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</body>
</html>
