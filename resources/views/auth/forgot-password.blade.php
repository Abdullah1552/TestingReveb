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
</style>

<body>
<form id="forget-password-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 ResponsiveImage" style="padding: 0px 0px 0px 0px">
                <div class="BgImg"></div>
            </div>
            <div class="col d-flex align-items-center">
                <div class="contact-form">
                    <div class="form-group">
                        <img
                                src="./public/assets/images/background_image/revebe2-removebg-preview.png"
                                alt=""
                                class="p-4 mx-5"
                                style="width: 50%"
                        />
                        <p class="d-flex justify-content-center"><span class="forgotPassword fs-2 fw-bold mt-2 ">Forgot Password</span>
                        </p>
                        <div class="col-sm-10 d-flex align-items-center">
                            <i class="fa-sharp fa-solid fa-user mx-2"></i>
                            <input
                                    type="email"
                                    class="form-control "
                                    id="fname"
                                    placeholder="Enter Email Address"
                                    name="email"
                                    required
                            />
                        </div>
                    </div>

                    <div class="btn_custom d-flex justify-content-center">
                        <button class="btn_login mt-2" style="font-size: 12px;
    padding: 9px 15px;">Email Password Reset Link</button>
                    </div>

                    <footer class="justify-content-center text-center mt-3">
                        <div class="phone fs-5">Phone : 03300001490</div>
                        <div class="phone fs-5">Email : <a href="#">Support@revebe.com</a></div>
                        <div class="phone">
                            <span class="text-dark fs-5 fw-bold"> Copyrights</span>
                            <span class="fs-5"> © 2022 - <a href="#"></a> </span>
                            <span class="fw-bold fs-5 companyTExt_hover"> <a href="http://www.revebe.com"
                                                                             style="text-decoration: none;">Revebe Digital Agency</a></span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="{{ URL::asset('public/assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/inc.func.js?v=1620732365') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/assets/js/toastr.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $("#forget-password-form").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url:"/api/auth/forget-password",
                data:$(this).serialize(),
                type:"post",
                success:function (ajaxResponse) {
                    ajaxSuccessToastr(ajaxResponse);
                    setInterval(function () {
                        window.location.href="/";
                    }, 1500);
                },
                error:function (ajaxResponse) {
                    ajaxErrorToastr(ajaxResponse);

                }
            });
        });
    });
</script>
</body>
</html>
