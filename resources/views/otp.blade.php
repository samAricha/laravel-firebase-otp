<!doctype html>
<html>
    <head>
        <title>OTP</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
        <style type="text/css">
            .hide {
                display: none;
            }
        </style>
    </head>
<body>  
    <div class="container">
        <h1 class="text-center m-3">Phone number authentication</h1>
        <div class="alert alert-danger hide" id="error-message"></div>
        <div class="alert alert-success hide" id="sent-message"></div>
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="phone-number" class="form-label">Phone Number:</label>
                        <input type="text" id="phone-number" class="form-control" placeholder="+254XXXXXXXXXX">
                    </div>
                    <div id="recaptcha-container"></div>
                    <button type="button" class="btn btn-info" onclick="otpSend();">Send OTP</button>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="otp-code" class="form-label">OTP code:</label>
                        <input type="text" id="otp-code" class="form-control" placeholder="Enter OTP Code">
                    </div>
                    <button type="button" class="btn btn-info" onclick="otpVerify();">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>  
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>
    <script type="text/javascript">
        const config = {
            apiKey: "AIzaSyA5j8gB94XE6cjAe9AmBMd5Id-4jWrFVOs",
            authDomain: "http://127.0.0.1:8000/",
            projectId: "laravel-otp-6bc83",
            storageBucket: "laravel-otp-6bc83.appspot.com",
            messagingSenderId: "877648639038",
            appId: "1:877648639038:web:9b2cc63572b512f6810d6f",
            measurementId: "G-K0PWTR6JMW"
        };
        
        firebase.initializeApp(config);
    </script>
    <script type="text/javascript">  
        // reCAPTCHA widget    
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': (response) => {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                onSignInSubmit();
            }
        });

        function otpSend() {
            var phoneNumber = document.getElementById('phone-number').value;
            var cutNum = substr($phoneNumber, 1);
            var validPhone = '+254'.$cutNum;
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                    // SMS sent. Prompt user to type the code from the message, then sign the
                    // user in with confirmationResult.confirm(code).
                    window.confirmationResult = confirmationResult;

                    document.getElementById("sent-message").innerHTML = "Message sent succesfully.";
                    document.getElementById("sent-message").classList.add("d-block");
                }).catch((error) => {
                    document.getElementById("error-message").innerHTML = error.message;
                    document.getElementById("error-message").classList.add("d-block");
                });
        }

        function otpVerify() {
            var code = document.getElementById('otp-code').value;
            confirmationResult.confirm(code).then(function (result) {
                // User signed in successfully.
                var user = result.user;

                document.getElementById("sent-message").innerHTML = "You are succesfully logged in.";
                document.getElementById("sent-message").classList.add("d-block");
                window.location='https://cryptic-earth-93328.herokuapp.com/home';
      
            }).catch(function (error) {
                document.getElementById("error-message").innerHTML = error.message;
                document.getElementById("error-message").classList.add("d-block");
            });
            
        }
    </script>
</body>
</html>