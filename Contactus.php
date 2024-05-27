<?php  require 'includes/header.php' ?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="path/to/font-awesome/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Roboto:ital,wght@0,100;1,300;1,500&display=swap"
      rel="stylesheet"
    />
    
    <link rel="stylesheet" href="CSS/header-style.css" />
    <link rel="stylesheet" href="CSS/footer-style.css" />
    <link rel="stylesheet" href="CSS/style.css" />
    

    <title>MaledaHandcraft</title>
  </head>
  <body>
    

       <section class="contact"> 
        <!-- <div class="content">  -->
          <h2>Contact Us</h2>
          <!-- <p>
            Thank you for visiting our website. If you have any questions,
            feedback, or inquiries, please don't hesitate to reach out to us.
            Our dedicated team is here to assist you and provide the necessary
            information you need. Feel free to use the contact form below or use
            the provided contact details to get in touch with us. We value your
            input and look forward to hearing from you.
          </p>
        </div> -->
        <div class="container">
          <div class="contactInfo">
            <div class="box">
              <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
              <div class="text">
                <h3>Address</h3>
                <p>123 Addis Ababa, Ethiopia</p>
              </div>
            </div>
            <div class="box">
              <div class="icon"><i class="fas fa-phone"></i></div>
              <div class="text">
                <h3>Phone</h3>
                <p>+251 908070650</p>
              </div>
            </div>
            <div class="box">
              <div class="icon"><i class="fas fa-envelope"></i></div>
              <div class="text">
                <h3>Email</h3>
                <p>maleda@gamil.com</p>
              </div>
            </div>
          </div>

          <div class="contactForm">
            <form method="post">
              <h2>Send Message</h2>
              <div class="inputBox">
                <input type="text" name="" required="required" />
                <span>Full Name</span>
              </div>
              <div class="inputBox">
                <input type="text" name="" required="required" />
                <span>Email</span>
              </div>
              <div class="inputBox">
                <textarea required="required"></textarea>
                <span>Type your Message</span>
              </div>
              <div class="inputBox">
                <input type="submit" name="" required="required" value="Send" />
              </div>
            </form>
          </div>
        
      </section>

      <div class="cta-container">
        <h2>Ready to Transform Your Space?</h2>
        <p>
          Discover the artistry of handmade crafts at Maleda Handcraft. Let's
          bring your vision to life!
        </p>
        <a href="tel:+123456789" class="cta-button">Contact Us</a>
      </div>
      
         
    </div>
    <style>
      
.cta-container {
  text-align: center;
  margin-top: 50px;
  color: #983c14;
  font-size: 25px;
  background-image: url(../CSS/Image/CTA.png);
  padding: 20px 0;
  background-position: absolute;
  top: 0;
  left: 0;
}

.cta-button {
  display: inline-block;
  padding: 15px 30px;
  background-color: #983c14;
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

.cta-button:hover {
  background-color: #d9d9d9;
  color: #983c14;
} 
    </style>
  </body>
</html>
<?php  require 'includes/footer.php' ?> 
