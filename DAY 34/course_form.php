<!DOCTYPE html>
<html>
<head>
  <title>Course Management Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>
<body>
<div class="container">
  <h2 class="text-center">Add Course</h2>
  <form action="insert_course.php" method="get" style="background-color: yellow;">
    <div class="form-group">
      <label>Course Name:</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
      <label>Duration (e.g. 6 months):</label>
      <input type="text" class="form-control" name="duration" required>
    </div>
    <div class="form-group">
      <label>Fees (in ₹):</label>
      <input type="number" class="form-control" name="fees" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Course</button>
  </form>
</div>
</body>
</html>
