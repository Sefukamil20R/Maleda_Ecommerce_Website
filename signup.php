<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Sign up</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="CSS/footer-style.css">
  	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="CSS/login.css" />
    <link rel="stylesheet" href="CSS/header-style.css">
  </head>

  <body>
     <?php include 'includes/header.php'; ?>
    <div class="body">
      <div class="form-container">
        <div class="login-form">
          <form action="validation/signup_validation.php" method="post">
            <h1>Signup</h1>
            <hr />
            <p>Artisan Elegance, Shipped to You.</p>
            <label for="email">Email</label>
            <input
              id="email"
              name="email"
              type="email"
              placeholder="abc@example.com"
            />
            <label for="password">Password</label>
            <input
              id="password"
              name="password"
              type="password"
              placeholder="Enter your password!"
            />
            <label for="address">Address</label>
            <input
              id="address"
              name="address"
              type="text"
              placeholder="Enter your adress"
            />
            <label for="phone">Phone</label>
            <input
              id="phone"
              name="phone"
              type="tel"
              placeholder="Enter your phone number"
            />
            <button class="submit">Submit</button>
              <p class="forgot-pass">
                  <a href="login.php">Already have an account?</a>
              </p>
          </form>
        </div>
        <div class="pic">
          <img src="images/ph.png" />
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?> 

  </body>
</html>