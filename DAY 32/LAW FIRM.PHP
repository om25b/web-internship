<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lawyer Registration Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Lawyer Registration Form</h3>
            <form action="insert.php" method="get">

  
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="name" name="name" class="form-control form-control-lg" required />
                    <label class="form-label" for="name">Full Name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                    <label class="form-label" for="email">Email</label>
                  </div>
                </div>
              </div>
  
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="phone" name="phone" class="form-control form-control-lg" required />
                    <label class="form-label" for="phone">Phone</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" id="license" name="license" class="form-control form-control-lg" required />
                    <label class="form-label" for="license">License Number</label>
                  </div>
                </div>
              </div>
  
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <select class="form-control form-control-lg" name="specialization" required>
                      <option value="" disabled selected>Select Specialization</option>
                      <option value="Criminal Law">Criminal Law</option>
                      <option value="Corporate Law">Corporate Law</option>
                      <option value="Family Law">Family Law</option>
                      <option value="Civil Rights">Civil Rights</option>
                      <option value="Immigration Law">Immigration Law</option>
                    </select>
                    <label class="form-label">Specialization</label>
                  </div>
                </div>
  
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="number" id="experience" name="experience" class="form-control form-control-lg" required />
                    <label class="form-label" for="experience">Experience (in years)</label>
                  </div>
                </div>
              </div>
  
              <div class="row">
                <div class="col-md-12 mb-4">
                  <div class="form-outline">
                    <input type="text" id="office_address" name="office_address" class="form-control form-control-lg" required />
                    <label class="form-label" for="office_address">Office Address</label>
                  </div>
                </div>
              </div>
  
              <div class="mt-4 pt-2">
                <input class="btn btn-primary btn-lg" type="submit" value="Register" />
              </div>
  
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
