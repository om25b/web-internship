<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Law Firm Management System</title>
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
          .nav-container {
              background: rgba(255, 255, 255, 0.95);
              padding: 30px;
              border-radius: 10px;
              box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
              width: 100%;
              max-width: 500px;
              text-align: center;
          }
          h1 {
              color: #333;
              margin-bottom: 20px;
          }
          a {
              display: block;
              margin: 10px 0;
              padding: 12px;
              background: linear-gradient(135deg, #4b6cb7, #182848);
              color: #fff;
              text-decoration: none;
              border-radius: 5px;
              font-size: 16px;
          }
          a:hover {
              background: linear-gradient(135deg, #182848, #4b6cb7);
          }
      </style>
  </head>
  <body>
      <div class="nav-container">
          <h1>Law Firm Management System</h1>
          <a href="lawyer.php">Register Lawyer</a>
          <a href="client.php">Register Client</a>
          <a href="case.php">Register Case</a>
          <a href="appointment.php">Register Appointment</a>
          <a href="hearing.php">Register Hearing</a>
          <a href="document.php">Register Document</a>
          <a href="payment.php">Register Payment</a>
      </div>
  </body>
  </html>