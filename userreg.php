<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    
    <link rel="stylesheet" type="text/css" href="userreg.css">
</head>
<body>
    <form id="myform">
    <div>
        <h2>User Registration</h2>
    </div>
        <br>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div><br>

        <div>
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
        </div><br>
        
        <div>
            <label for="middle_name">Middle Name:</label>
            <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" required>
        </div><br>
        
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
        </div><br>
        
        <div>
            <label for="gender"> Gender:</label>
            <input type="radio" name="gender" id="male" value="Male" required >Male
            <input type="radio" name="gender" id="female" value="Female" required >Female
        </div><br>
        
        <div>
            <label for="birthdate">Birthdate:</label>
            <input type="date" id="birthdate" placeholder="Birthdate" required>
        </div><br>
        <div>
            <label for="age"> Age:</label>
            <input type="text" name="age" id="age" placeholder="Age" readonly>
        </div><br>
        
        <div>
            <label for="email_address"> Email Address:</label>
            <input type="text" name="email_address" id="email_address" placeholder="Email address" required>
        </div><br>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}$" title="at least 8 letters, 1 uppercase, 1 lower case, 1 special characters" placeholder="Password" required>
        </div><br>

        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
        </div><br>

        <div id="passwordError"style="color: red;"></div>
        <div id="button">
            <button type="button" name="submit" onclick="submitForm()">Submit</button>
            <button type="button" onclick="cancelForm()" class="cancel">Cancel</button>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>

    <script>
        function submitForm() {
            if (validatePassword()) {
                $.ajax({
                    type: "POST",
                    url: "insert.php",
                    data: $("#myform").serialize(),
                    success: function(response){
                        console.log(response)
                    },
                    error: function(error, xhr, status){
                        console.log("Error!");
                    }
                });
            }
        }

        document.getElementById('birthdate').addEventListener('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
        });

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            if (password !== confirmPassword) {
                document.getElementById("passwordError").innerText = "Your passwords does not match! Try again.";
                return false;
            } else {
                document.getElementById("passwordError").innerText = "";
                return true;
            }
        }

        function cancelForm() {
        document.getElementById("myform").reset();
        console.log("Form cancelled");
        }
    </script>
</body>
</html>