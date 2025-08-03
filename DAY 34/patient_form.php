<!DOCTYPE html>
<html>
<head>
  <title>Patient Record Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2 class="text-center">Add Patient Record</h2>
  <form action="insert_patient.php" method="get" style="background-color: royalblue;">
    <div class="form-group">
      <label>Name:</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
      <label>Age:</label>
      <input type="number" class="form-control" name="age" required>
    </div>
    <div class="form-group">
      <label>Gender:</label><br>
      <label class="radio-inline"><input type="radio" name="gender" value="Male" required> Male</label>
      <label class="radio-inline"><input type="radio" name="gender" value="Female"> Female</label>
      <label class="radio-inline"><input type="radio" name="gender" value="Other"> Other</label>
    </div>
    <div class="form-group">
      <label>Phone:</label>
      <input type="text" class="form-control" name="phone" required>
    </div>
    <div class="form-group">
      <label>Symptoms:</label>
      <input type="text" class="form-control" name="symptoms" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Patient</button>
  </form>
</div>
</body>
</html>
