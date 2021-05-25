<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="css/style.css" />


</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap');

    * {
        font-family: "Montserrat", Sans-Serif;
        color: black;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background-image: url("public/img/andrew-neel--FVaZbu6ZAE-unsplash.jpg");
        background-size: cover;
    }



    .login-box {
        padding: 6em;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 700px;
        border-radius: 30px;
        padding: 20px;
        justify-content: center;
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);

    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        border: none;
        -webkit-text-fill-color: black;
        transition: background-color 5000s ease-in-out 0s;


    }

    .form {
        padding: 6em;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 700px;
        border-radius: 30px;
        padding: 20px;
        justify-content: center;
        text-align: center;
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
    }

    h1 {
        color: white;
        text-transform: uppercase;
        font-weight: 500;
    }



    .textbox {
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        margin: 8px 0;
        border-bottom: 1px solid white;
    }

    .textbox i {
        width: 26px;
        float: left;
        text-align: center;
    }

    .gender {
        float: left;
        display: block;
    }

    a {
        text-decoration: none;
        font-size: 25px;
        color: black;
    }

    a:hover {
        text-decoration: none;
        color: white;
    }

    .textbox input {
        border: none;
        outline: none;
        background: none;
        color: black;
        font-size: 18px;
        width: 80%;
        float: left;
        margin: 0 10px;
    }

    .textbox label {
        border: none;
        outline: none;
        background: none;
        color: white;
        font-size: 18px;
        width: 80%;
        float: left;
        margin: 0 10px;
    }

    .btn {
        width: 50%;
        height: 5vh;
        padding: 10px 25px 8px;
        color: black;
        background-color: whitesmoke;
        text-shadow: rgba(0, 0, 0, 0.24) 0 1px 0;
        font-size: 25px;
        border-radius: 25px;
        margin-top: 10px;
        cursor: pointer;
        border: none;
        text-align: center;
        justify-content: center;
    }

    .btn:hover {
        background: rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        color: whitesmoke;
    }

    #male,
    #female,
    span {
        display: block;
        float: left;
    }

    h3 {
        font-size: 2rem;
    }

    .form p {
        font-size: 1.25rem;
        color: black;
    }

    ::placeholder {
        color: black;
    }
</style>

<body>
    <div class="bg">
        <?php
        require('config/connect.php');
        //insert vào database
        if (isset($_POST['add_acc'])) {
            $name = stripslashes($_POST['name']);
            $name = mysqli_real_escape_string($conn, $name);

            $rawdate = $_POST['date'];
            $date = date('Y-m-d', strtotime($rawdate));

            $gioitinh = 0;
            $gender = $_POST['gender'];
            if ($gender == 'Nam') $gioitinh = 1;

            $address = $_POST['address'];

            $email = stripslashes($_POST['email']);
            $email = mysqli_real_escape_string($conn, $email);

            $phone = $_POST['phone'];

            $password = stripslashes($_POST['password']);
            $password = mysqli_real_escape_string($conn, $password);
            $pass_check = stripslashes($_POST['pass_check']);
            $pass_check = mysqli_real_escape_string($conn, $pass_check);
            if ($password == $pass_check) {
                $query = "INSERT into account (name, email, phone, password, address, sex, birthday, type) VALUES ('$name', '$email','$phone', '$password', '$address', '$gioitinh', '$date', 0)";
                // $result = mysqli_query($conn,$query);
                $result = $conn->query($query);
                if ($result) {
                    echo "<div class='form'><h3>Bạn đã đăng ký thành công!</h3><br/>Click để <a href='login.php'>Đăng nhập ngay</a><p>Chúc bạn một buổi mua sách vui vẻ!</p></div>";
                } else {
                    echo $conn->error;
                }
            }
        } else {
        ?>
            <div class="form">
                <form name="registration" action="" autocomplete="off" method="post" id="forms">
                    <div class="login-box">
                        <h1>Đăng ký</h1>
                        <div class="textbox">
                            <i class="fas fa-user-circle"></i>
                            <input type="text" placeholder="Họ và tên" id="name" name="name" required>
                        </div>
                        <div class="textbox">
                            <i class="fas fa-birthday-cake"></i>
                            <input type="date" placeholder="Ngày sinh" id="date" name="date" required>
                        </div>
                        <div class="textbox">
                            <i class="fas fa-venus-mars"></i>
                            <input type="text" placeholder="Giới tính (Nam hoặc Nữ)" id="gender" name="gender" value="Nam" required>
                            <span id='messagee'></span>
                        </div>
                        <div class="textbox">
                            <i class="fas fa-map-marked-alt"></i>
                            <input type="text" placeholder="Địa chỉ" id="address" name="address" required>
                        </div>
                        <div class="textbox">
                            <i class="far fa-envelope"></i>
                            <input type="email" style="color:white" placeholder="Email" autocomplete="off" id="email" name="email" required><br>
                            <span id='message1'></span>
                            <!-- <small class="error_email" style="color: red, font-size: 15px"></small>
            <small class="right_email" style="color: green, font-size: 15px"></small> -->
                        </div>
                        <div class="textbox">
                            <i class="fas fa-phone-square-alt"></i>
                            <input type="number" placeholder="Số điện thoại" id="phone" name="phone" required>
                        </div>
                        <div class="textbox">
                            <i class="fas fa-lock"></i>
                            <input type="Password" placeholder="Mật khẩu" autocomplete="off" id="password" name="password" required>
                        </div>
                        <div class="textbox">
                            <i class="fas fa-lock"></i>
                            <input type="Password" placeholder="Xác nhận mật khẩu" id="pass_check" name="pass_check" required>
                            <span id='message'></span>
                        </div>

                        <input class="btn" type="submit" name="add_acc" value="Đăng ký">
                        <p>Nếu bạn đã có tài khoản, hãy đăng nhập!</p>
                        <a href="login.php">Đăng nhập</a><br>
                        <a href="index.php">Trang chủ</a>
                    </div>
                </form>


                <script src="https://kit.fontawesome.com/be19f55546.js" crossorigin="anonymous"></script>
                <script src="public/js/vendor/jquery-1.12.0.min.js"></script>
                <script>
                    $('#pass_check').on('keyup', function() {
                        if ($('#password').val() == $('#pass_check').val()) {
                            $('#message').html('Mật khẩu hợp lệ').css('color', 'green');
                        } else
                            $('#message').html('Mật khẩu xác nhận chưa chính xác').css('color', 'red');
                    });

                    $('#gender').on('keyup', function() {
                        if (($('#gender').val() == "Nam") || ($('#gender').val() == "Nữ")) {
                            $('#messagee').html('Hợp lệ').css('color', 'green');
                        } else
                            $('#messagee').html('Giới tính là Nam hoặc Nữ').css('color', 'red');
                    });
                </script>

                <!-- ajax kiểm tra mail tồn tại -->
                <script src="public/vendor/jquery/jquery.min.js"></script>
                <script>
                    $('#email').keyup(function(e) {
                        var email = $("#email").val();
                        $.ajax({
                            type: "POST",
                            url: "admin/code.php",
                            data: {
                                "check_submit_btn": 1,
                                "email_id": email,
                            },
                            success: function(response) {
                                if (response == 0) {
                                    // $('.error_email').text("Email đã tồn tại.");
                                    // $('.right_email').text("");
                                    $('#message1').html('Email đã tồn tại').css('color', 'red');
                                } else if (response == 1) {
                                    // $('.error_email').text("");
                                    // $('.right_email').text("Email hợp lệ");
                                    $('#message1').html('Email hợp lệ').css('color', 'green');
                                }
                            }
                        });
                    });;
                </script>
            </div>
        <?php } ?>
    </div>
</body>

</html>