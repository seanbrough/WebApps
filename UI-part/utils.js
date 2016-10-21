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