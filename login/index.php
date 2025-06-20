<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rukara Model School | Login </title>

    <!-- CSS -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Google Fonts - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        } 
        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center; 
            background:url('/RMS-Project/assets/images/logo.jpg')  ;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment:fixed ;
            background-origin: border-box;
            column-gap: 30px;
        }

        .form {
            position: absolute;
            max-width: 430px;
            width: 100%;
            padding: 30px;
            border-radius: 6px;
            background: rgba(123, 245, 219, 0.7);
            border: 2px solid rgb(113, 100, 100);
        }

        .form.signup {
            opacity: 0;
            pointer-events: none;
        }

        .forms.show-signup .form.signup {
            opacity: 1;
            pointer-events: auto;
        }

        .forms.show-signup .form.login {
            opacity: 0;
            pointer-events: none;
        }

        header {
            font-size: 28px;
            font-weight: 600;
            color: #232836;
            text-align: center;
        }

        form {
            margin-top: 30px;
        }

        .form .field {
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 20px;
            border-radius: 6px;
        }

        .field input,
        .field button,
        .field select {
            height: 100%;
            width: 100%;
            border: none;
            font-size: 16px;
            font-weight: 400;
            border-radius: 6px;
        }

        .field input {
            outline: none;
            padding: 0 15px;
            border: 1px solid #CACACA;
        }

        .field input:focus {
            border-bottom-width: 2px;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #8b8b8b;
            cursor: pointer;
            padding: 5px;
        }

        .field button {
            color: #fff;
            background-color: #0171d3;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .field button:hover {
            background-color: #016dcb;
        }

        .form-link {
            text-align: center;
            margin-top: 10px;
        }

        .form-link span,
        .form-link a {
            font-size: 14px;
            font-weight: 400;
            color: #232836;
        }

        .form a {
            color: #0171d3;
            text-decoration: none;
        }

        .form-content a:hover {
            text-decoration: underline;
        }

        .line {
            position: relative;
            height: 1px;
            width: 100%;
            margin: 36px 0;
            background-color: #d4d4d4;
        }

        .line::before {
            content: 'Or';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #FFF;
            color: #8b8b8b;
            padding: 0 15px;
        }

        .media-options a {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        a.facebook {
            color: #fff;
            background-color: #4267b2;
        }

        a.facebook .facebook-icon {
            height: 28px;
            width: 28px;
            color: #0171d3;
            font-size: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
        }

        .facebook-icon,
        img.google-img {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
        }

        img.google-img {
            height: 20px;
            width: 20px;
            object-fit: cover;
        }

        a.google {
            border: 1px solid #CACACA;
        }

        a.google span {
            font-weight: 500;
            opacity: 0.6;
            color: #232836;
        }

        @media screen and (max-width: 400px) {
            .form {
                padding: 20px 10px;
            }

        }
    </style>

</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <header>Login</header>

                <form action="login.php" method="POST">
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input" required>
                    </div>

                    <div class="field input-field">
                        <input type="password" placeholder="Password" name="password" class="password" required>
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="form-link">
                        <a href="#" class="forgot-pass">Forgot password?</a>
                    </div>
                    <!-- <div disabled class="g-recaptcha" 
         data-sitekey="6Ld4_C8rAAAAAM11e-O_4z0o4JuwD3MS6p1J8-PO"
         data-callback="onRecaptchaSuccess"
         data-expired-callback="onRecaptchaExpired">
    </div> --> 
                    <div class="field button-field">
                        <button type="submit" name="login">Login</button>
                    </div>
                </form>
                <div class="form-link">
                    <span>Login if you have been registered</span>
                    <!-- <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span> -->
                </div>
            </div>
        </div>
        <!-- Signup Form -->
        <div  class="form signup">
            <div class="form-content">
                <header>Signup</header>
                <form action="signup.php" method="POST">
                    <div class="field input-field">
                        <input type="text" name="name" placeholder="Full names" class="input">
                    </div>
                    <div class="field input-field">
                        <input type="email" name="email" placeholder="Email" class="input">
                    </div>
                    <div class="field input-field">
                        <input type="password" name="password" placeholder="Create password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>

                    <div class="field input-field">
                        <input type="password" name="confirm_password" placeholder="Confirm password" class="password">
                        <i class='bx bx-hide eye-icon'></i>
                    </div>
                    <div class="field input-field">
                        <select name="role" id="">
                            <option value=" " hidden>Select your role</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher </option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div class="field button-field">
                        <button>Signup</button>
                    </div>
                </form>

                <div class="form-link">
                    <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript -->
    <script src="js/script.js"></script>
    <script>
        window.addEventListener('load', function() {
            const loginForm = document.querySelector('.login-form form');
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const recaptchaResponse = grecaptcha.getResponse();
                if (!recaptchaResponse) {
                    alert('Please complete the reCAPTCHA verification');
                    return;
                }
                // If verification successful, proceed with form submission
                this.submit();
            });
        });

        function onRecaptchaSuccess() {
            // Enable submit button or proceed with form submission
            console.log('reCAPTCHA verified');
        }

        function onRecaptchaExpired() {
            console.log('reCAPTCHA expired');
        }
    </script>
    <!-- //robot check -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>