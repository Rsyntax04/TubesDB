<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GROSIR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="design\style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/234e93a26a.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $uname_error = "";
            $pass_error = "";
            $uname = $_POST['Username'];
            $pass = $_POST['Password'];
            try{
                include("sqlcon.php");
                $query ="SELECT * FROM Pelanggan WHERE username = '$uname'";
            // $rs = odbc_exec($connection, $query);
            } catch (PDOException $e){
                die("Query Failed: ".$e->getMessage());
            }
        }
    ?>
    <div class="login mt-5 ms-5 d-flex flex-column">
        <div class="mb-5">  
            <a href="index.php" class="mb-5">
                <i class="fa-solid fa-circle-arrow-left fa-3x" style="color: #4e5e79;"></i>
            </a>
        </div>
        <div class="cardlogin card">
            <div class="bodycardlgn">
                <p class="fw-bold tittlelogin fw-bold">
                    Welcome back!
                </p>
                <div class="d-flex flex-row bwhlgn">
                    <p class="me-1">Login below or </p>
                    <a href="register.php" id="btnreg">create an account </a>
                </div>
                <form action="post" class="d-flex flex-column " id="formlgn">
                    <input type="text" name = "username" id="username" class="form-control form-control-lg" placeholder="Username" style="height:40px; margin-bottom:6.5%;" required> 
                    <div class="d-flex flex-row pass form-control form-control-lg">
                        <input type="password" name = "Password" id = "Password" placeholder="Password" style=" margin-top:1%; border:0; width:100%; outline:0;" required>
                        <img src="img\eye-slash-solid.svg" id="eyeicon">
                    </div>
                    <span class = "text-light"><?php if(!empty($pass_error)){echo $pass_error;}?></span>
                    <input type="submit" name = 'Login' value="Login" id = "login" style="height:40px; width : 30%;" class="btn btn-outline-light">
                </form>
            </div>
        </div>
    </div>
    <script>
        let eyeicon = document.getElementById('eyeicon');
        let Password = document.getElementById('Password');

        eyeicon.onclick = function(){
            if(Password.type == 'password'){
                Password.type = 'text';
                eyeicon.src = "img/eye-solid.svg";
            }else{
                Password.type = 'password'
                eyeicon.src = 'img/eye-slash-solid.svg'
            }
        }
    </script>
</body>
</html>