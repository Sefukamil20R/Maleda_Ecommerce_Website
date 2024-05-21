let PopuP = document.getElementById("Popup");

document.getElementById("submitButton").addEventListener("click", function(event) {
  event.preventDefault();

  var password = document.getElementById("password").value;
  var confirmPassword = document.getElementById("confirmPassword").value;
  var creditCardNumber = document.getElementById("creditCardNumber").value;

  
  if (password !== confirmPassword) {
    alert("Passwords do not match. Please try again.");
    return;
  }

 
  if (!isValidCreditCard(creditCardNumber)) {
    alert("Please enter a valid credit card number.");
    return;
  }

  
  console.log("Password:", password);
  console.log("Credit Card Number:", creditCardNumber);

 
  openpopup();
});

function isValidCreditCard(number) {
 
  return /^\d{16}$/.test(number);
}

function openpopup() {
  PopuP.classList.add("open-popup");
}

function closepopup() {
  PopuP.classList.remove("open-popup");
}
