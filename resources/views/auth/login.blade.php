<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ID-Maker - Log in</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login-util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login-main.css') }}">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>




.swal-small .swal2-popup {
        font-size: 14px; /* Adjust the font size */
        width: 300px; /* Adjust the width */
    }


      /* Wrapper for input fields */
.wrap-input100 {
position: relative;
margin-bottom: 30px;
}

/* Input field style */
.input100 {
width: 100%;
padding: 10px;
font-size: 16px;
background: transparent;
border: 1px solid #ccc;
border-radius: 4px;
outline: none;
box-sizing: border-box;
}

/* Label style - Always above the input field */
.label-input100 {
font-size: 16px;
color: #333;
margin-bottom: 10px;
display: block;
font-weight: bold;
position: absolute;
top: -25px;
left: 0;
}

/* Input fields when focused */
.input100:focus {
border-color: #4CAF50; /* Focus color */
}

/* Error message style */
.invalid-feedback {
font-size: 12px;
color: red;
margin-top: 10px; /* Increased gap between error message and input field */
margin-left: 5px; /* Optional: Adds a little space to the left of the error message */
}

/* For 'Remember me' checkbox */
.contact100-form-checkbox {
display: flex;
align-items: center;
}

.input-checkbox100 {
margin-right: 10px;
}

/* Focus line effect for input fields */
.focus-input100 {
position: absolute;
bottom: 0;
left: 0;
width: 100%;
height: 2px;
background-color: transparent;
}

.input100:focus + .focus-input100 {
background-color: #4CAF50; /* Focus color */
}
    </style>
</head>
<body style="background-color: #666666;">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title p-b-43">
                        Welcome Admin!
                    </span>

                    <!-- Email Input -->
                <!-- Email Input -->
<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
    <label for="email" class="label-input100">Email</label>
    <input id="email" class="input100" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    <span class="focus-input100"></span>
</div>

                    <!-- Password Input -->
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <label for="password" class="label-input100">Password</label>
                        <input id="password" class="input100" type="password" name="password" required autocomplete="current-password">
                        <span class="focus-input100"></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me Checkbox and Forgot Password Link -->
                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <span>Remember me</span>
                        </div>
                        <div>
                            <a href="{{ route('password.request') }}" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Login') }}
                        </button>
                    </div>

                </form>

                <div class="login100-more" style="background-image:url('{{ asset('img/cover-mlg.png') }}');">
                </div>
            </div>
        </div>
    </div>





    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'These credentials do not match our records',
                position: 'top-end',  /* Position to top-right */
                showConfirmButton: false, /* Hide confirm button */
                timer: 3000, /* Auto close after 3 seconds */
                toast: true, /* Make it a toast notification */
                customClass: {
                    popup: 'swal-small' /* Optional: custom class for styling */
                },
                showClass: {
                    popup: 'swal2-zoom' /* Zoom in effect */
                },
                hideClass: {
                    popup: 'swal2-fade' /* Fade out effect */
                }
            });
        @endif
    </script>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script src="{{ asset('js/login-main.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
