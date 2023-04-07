<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>REVEBE|DIGITAL AGENCY</title>
    <link rel="stylesheet" href="./public/assets/css/auth.css" />
    <link rel="shortcut icon" href="{{ URL::asset('public/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <!-- font awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

    button.alertbtn{
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
        font-size: 22px;
    }
</style>

<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-8 ResponsiveImage" style="padding: 0px 0px 0px 0px">
            <div class="BgImg"></div>
        </div>
        <div class="col d-flex align-items-center">
            <div class="contact-form">
                <img
                    src="./public/assets/images/background_image/revebe2-removebg-preview.png"
                    alt=""
                    class="p-4 mx-5"
                    style="width: 50%"
                />
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close alertbtn" data-dismiss="alert" aria-hidden="true">×
                        </button>
                        <i class="fa fa-exclamation"></i> {{ $error }}
                    </div>
                @endforeach
                <form  class="form-group"  method="POST" action="{{ route('login') }}">
                    @csrf

                    <label
                        class="control-label border border-none"
                        for="fname"
                    ></label>
                    <div class="col-sm-10 d-flex align-items-center">
                        <i class="fa-sharp fa-solid fa-user mx-2"></i>
                        <input
                            type="text"
                            class="form-control "
                            id="email"
                            placeholder="Enter Email Address"
                            name="email"
                        />
                    </div>

                    <label
                        class="control-label col-sm-2 border-none"
                        for="lname"
                    ></label>
                    <div class="col-sm-10 d-flex align-items-center">
                        <i class="fa-sharp fa-solid fa-lock mx-2"></i>

                        <input
                            type="password"
                            class="form_togglePassword"
                            id="passwordField"
                            placeholder="Enter Password"
                            name="password"
                            required
                        />
                        <i  class="bi bi-eye-slash password_eye "></i>
                        <!-- <i class="bi bi-eye-slash password_eye"></i> -->
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="mt-4 mx-4">
                            <input
                                type="checkbox"
                                value="lsRememberMe"
                                id="remember"
                                name="remember"

                            />
                            <label class="form-check-label" for="remember" >Remember me</label>
                        </div>

                        <div class="mt-4 mx-4">

                            <label for="rememberMe" class="me-5"><a href="/forgot-password" class="">Forget password?</a></label>


                        </div>
                    </div>
                    <div class="btn_custom">
                        <button type="submit" class="btn_login mt-4 mx-4">Log in</button>
                    </div>



                </form>


                <div class="icons_custom d-flex justify-content-center mt-3">
                    <!-- for the facebook -->
                    <a href="https://m.facebook.com/revebedigitalagency/" class="fa-brands fa-facebook-f fs-5 m-1 iconIcon" style="color: rgb(21, 64, 255)" ></a>

                    <a href="https://pk.linkedin.com/in/revebe-digital-agency-138732246" class="fa-brands fa-linkedin-in fs-5 iconIcon m-1" style="color: #0077b5" ></a>

                    <a href="https://wa.link/eaiu1h" class="fa-brands fa-whatsapp fs-5 iconIcon m-1 " style="color:green ;" ></a>



                </div>

                <footer class="justify-content-center text-center mt-5">
                    <div class="phone fs-5">Phone : 03300001490</div>
                    <div class="phone fs-5">Email : <a href="#">Support@revebe.com</a> </div>
                    <div class="phone">
                        <span class="text-dark fs-5 fw-bold"> Copyrights</span>
                        <span class="fs-5"> © 2022 - <a href="#"></a> </span>
                        <span class="fw-bold fs-5 companyTExt_hover"> <a href="https://www.revebe.com" style="text-decoration: none;">Revebe Digital Agency</a></span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
<script>
    password_eye = document.querySelector(".password_eye ");
    passwordField = document.querySelector("#passwordField");

    password_eye.addEventListener("click", () => {
        type =
            passwordField.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordField.setAttribute("type", type);
        if(type =="text" ){
            password_eye.className = "bi bi-eye-fill password_eye";

        }else{
            password_eye.className = "bi bi-eye-slash password_eye";

        }

    });


</script>
</body>
</html>
