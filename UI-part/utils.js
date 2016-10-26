function validate_reg_form(form){
     var email = document.getElementById('inputEmail').value;
     var password = document.getElementById('inputPassword').value;
     var confirmPassword = document.getElementById('inputConfirmPassword').value;
     if(email.length === 0){
          alert("Email required.");
          return false;
     }
     if(password.length === 0){
          alert("Password required.");
          return false;
     }
     else if(password !== confirmPassword){
          alert("Passwords do not match");
          return false;
     }
     else{
          return true;
     }
}

function shareCard() {
     var shareEmail = prompt("Share to user with this email address:");
     if (shareEmail.length === 0){
          alert("Please enter user's email address");
     }
     else {
          document.getElementsByName('share_email').value = shareEmail;
     }
}