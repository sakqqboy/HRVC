<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Planning view</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link href="css/layout/font.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="css/layout/layout.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="css/fs.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="css/fs_view.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="css/fs.module.css?v=<?= date("YmdHis"); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>

    <!-- Section: Design Block -->
    <section class="">
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <h1 class="my-5 display-3 fw-bold ls-tight">
                            The best offer <br />
                            <span class="text-primary">for your business</span>
                        </h1>
                        <p style="color: hsl(217, 10%, 50.8%)">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                            quibusdam tempora at cupiditate quis eum maiores libero
                            veritatis? Dicta facilis sint aliquid ipsum atque?
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <form>
                                    <h1 class="my-5 display-3 fw-bold ls-tight text-center">
                                        Sign
                                        <span class="text-primary">IN</span>
                                    </h1>
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" id="username" class="form-control" />
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" class="form-control" />
                                    </div>

                                    <!-- Checkbox -->
                                    <!-- <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                                        <label class="form-check-label" for="form2Example33">
                                            Subscribe to our newsletter
                                        </label>
                                    </div> -->

                                    <!-- Submit button -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-primary btn-block mb-4" onclick="Login()">
                                            Sign In
                                        </button>
                                    </div>


                                    <!-- Register buttons -->
                                    <!-- <div class="text-center">
                                        <p>or sign up with:</p>
                                        <button type="button" class="btn btn-link btn-floating mx-1">
                                            <i class="fab fa-facebook-f"></i>
                                        </button>

                                        <button type="button" class="btn btn-link btn-floating mx-1">
                                            <i class="fab fa-google"></i>
                                        </button>

                                        <button type="button" class="btn btn-link btn-floating mx-1">
                                            <i class="fab fa-twitter"></i>
                                        </button>

                                        <button type="button" class="btn btn-link btn-floating mx-1">
                                            <i class="fab fa-github"></i>
                                        </button>
                                    </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <script>
        function Login() {

            let username = $('#username').val();
            let password = $('#password').val();
            var $baseUrl = window.location.protocol + "/ / " + window.location.host;
            if (window.location.host == 'localhost') {
                $baseUrl = window.location.protocol + "//" + window.location.host + '/HRVC/frontend/modules/fs/views/bigsara/new_template/';
            } else {
                $baseUrl = window.location.protocol + "//" + window.location.host + '/';
            }
            $url = $baseUrl;
            if (username == "") {
                Swal.fire({
                    title: "Warning !",
                    text: "Please enter your username.",
                    icon: "warning"
                });
                return false;
            }
            if (password == "") {
                Swal.fire({
                    title: "Warning !",
                    text: "Please enter your password.",
                    icon: "warning"
                });
                return false;
            }
            $.ajax({
                type: 'POST',
                //url: 'auth.php',
                url: 'http://localhost/HRVC/frontend/modules/fs/views/bigsara/new_template/auth.php',
                data: {
                    username: username,
                    password: password
                },
                dataType: 'json',
                cache: false,
                success: function(data) {
                    if (data.result == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login successful',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            window.location.href = $baseUrl + "main/index.php";
                        });
                    }
                    if (data.result == 2) {
                        Swal.fire({
                            title: 'Warning !',
                            text: "The password is incorrect.",
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    if (data.result == 3) {
                        Swal.fire({
                            title: 'Warning !',
                            text: "No user found in the system.",
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                    if (data.result == 9) {
                        Swal.fire({
                            title: 'Warning !',
                            text: "Unable to contact database Please contact the system administrator.",
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect. Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error. ' + jqXHR.responseText;
                    }
                    Swal.fire({
                        title: 'Warning !',
                        text: "There was a recording problem. Please contact the system administrator. " + msg,
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })

            // $.ajax({
            //     url: 'ajax/url/url.php',
            //     type: 'POST',
            //     dataType: 'json',
            //     contentType: false,
            //     cache: false,
            //     processData: false,
            //     data: formData,
            //     success: function(data) {

            //     }
            // });
        }
    </script>
</body>

</html>