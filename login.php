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
            <form method="post" action="validation/login.php">
              <h1>Login</h1>
              <hr />
              <p>Artisan Elegance, Shipped to You.</p>
              <label>Email</label>
              <input type="email" placeholder="abc@exampl.com" name="email" id="email"/>
              <label>Password</label>
              <input type="password" placeholder="enter your password!"  name="password" id="password"/>
              <button class="submit">Submit</button>
              <p class="forgot-pass">
                <a href="#">Forgot Password?</a>
              </p>
          </form>
        </div>
        <div class="pic">
          <img src="images/ph.png"  alt=""/>
        </div>
      </div>
    </div>
    <?php include 'includes/footer.php'; ?> 

  </body>
</html>