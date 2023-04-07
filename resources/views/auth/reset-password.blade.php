<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>REVEBE|DIGITAL AGENCY</title>
    <link rel="stylesheet" href="./public/assets/css/auth.css"/>
    <link
            rel="shortcut icon"
            href="./images/logo/bootstrap-logo.svg"
            type="image/x-icon"
    />
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
    />
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('public/assets/css/toastr.min.css') }}"/>
    <!-- font awesome -->

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

    <!-- favicon -->

    <link
            rel="shortcut icon"
            href="./public/assets/images/background_image/revebe2-removebg-preview.png"
            type="image/x-icon"
    />

    <!-- the bootstrap_icon_eye in the password input tag -->
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
</head>
<style>
    form .password_eye {
        margin-left: -30px;
        cursor: pointer;
    }

    .passwordEye {
        margin-left: -30px;
        cursor: pointer;
    }
</style>

<body>
<form id="resetForm">
    @csrf
    <input type="hidden" name="token" value="{{$token}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 ResponsiveImage" style="padding: 0px 0px 0px 0px">
                <div class="BgImg"></div>
            </div>
            <div class="col d-flex align-items-center">
                <div class="contact-form">
                    <div class="form-group">
                        <img
                                src="./public/assets/images/background_image/revebe2.png"
                                alt=""
                                class="p-3 mx-5"
                                style="width: 75%;"
                        />
                        <p class="d-flex justify-content-center"><span class="forgotPassword fs-2 fw-bold mt-1 ">Reset Password</span>
                        </p>

                            <div class="col-sm-10 d-flex align-items-center">
                                <i class="fa-sharp fa-solid fa-lock mx-2"></i>

                                <input
                                        type="password"
                                        class="form_togglePassword "
                                        id="passwordField"
                                        placeholder="Password"
                                        name="password"
                                        required
                                />
                                <!-- icon for the password -->
                                <i class="bi bi-eye-slash password_eye "></i>
                            </div>

                            <label
                                    class="control-label col-sm-2 border-none"
                                    for="lname"
                            ></label>
                            <div class="col-sm-10 d-flex align-items-center">
                                <i class="fa-sharp fa-solid fa-lock mx-2"></i>
                                <!-- confirm password -->
                                <input
                                        type="password"
                                        class="form_togglePassword "
                                        id="confirmPasswordField"
                                        placeholder="Confirm Password"
                                        name="confirm-password"
                                        required
                                />
                                <!-- icon for the password eye -->
                                <i class="bi bi-eye-slash passwordEye"></i>
                                <!-- <i class="bi bi-eye-slash password_eye"></i> -->
                            </div>
                    </div>
                    <label
                            class="control-label col-sm-2 border-none"
                            for="lname"></label>


                    <div class="btn_custom d-flex justify-content-center">
                        <button class="btn_login mt-2">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ URL::asset('public/assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/inc.func.js?v=1620732365') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/toastr.min.js') }}"></script>

<script>
    password_eye = document.querySelector(".password_eye");
    passwordField = document.querySelector("#passwordField");

    password_eye.addEventListener("click", () => {
        type =
            passwordField.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordField.setAttribute("type", type);
        if (type == "text") {
            password_eye.className = "bi bi-eye-fill password_eye";

        } else {
            password_eye.className = "bi bi-eye-slash password_eye";

        }
    });
    passwordEye = document.querySelector(".passwordEye");
    confirmPasswordField = document.querySelector("#confirmPasswordField");

    passwordEye.addEventListener("click", () => {
        type =
            confirmPasswordField.getAttribute("type") === "password"
                ? "text"
                : "password";
        confirmPasswordField.setAttribute("type", type);
        if (type == "text") {
            passwordEye.className = "bi bi-eye-fill passwordEye";

        } else {
            passwordEye.className = "bi bi-eye-slash passwordEye";

        }
    });


</script>

<script>
    $(document).ready(function () {
        $("#resetForm").submit(function (e) {

            console.log($('form').serialize());
            debugger
            e.preventDefault();
             $.ajax({
                    url: "/api/auth/reset-password",
                    data: $(this).serialize(),
                    type: "post",
                    success: function (ajaxResponse) {
                        ajaxSuccessToastr(ajaxResponse);

                        setInterval(function () {
                            window.location.href="/";
                        }, 1500);

                    },
                    error: function (ajaxResponse) {
                        ajaxErrorToastr(ajaxResponse);

                    }
                });
        });
    });
</script>

</body>
</html>
