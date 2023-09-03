<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="design\style.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/234e93a26a.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $namaError = "";
        $almtError = "";
        $notelpError = "";
        $emailError = "";
        $unameError = "";
        $passwordError = "";
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nama = $_POST["name"];
            $almt = $_POST["Alamat"];
            $notelp = $_POST['NOTelp'];
            $email = $_POST["Email"];
            $uname = $_POST['username'];
            $password = $_POST["Password"];
            try{
                include("sqlcon.php");
                if(empty($nama)){
                    $namaError = "Name is Required";
                }
                else{
                    $nama = trim($nama);
                    $nama = htmlspecialchars($nama);
                    if(!preg_match("/^[a-zA-Z]+$/",$nama)){
                        $namaError = "Enter Valid Name";
                    }
                }
                if(empty($almt)){
                    $almtError = "Alamat is Required";
                }

                if(empty($notelp)){
                    $notelpError = "No.Telephone is Required";

                } else if(!is_numeric($notelp)){
                    $notelpError = "No.Telephone Must be number";

                } else if(strlen($notelp) != 12){
                    $notelpError = "No.Telephone Must be 12 number";
                }

                $result = odbc_exec($connection,"SELECT Email FROM [DBTubes2].[dbo].[Pelanggan]");
                while(odbc_fetch_row($result)){
                    $email2 = odbc_result($result,'Email');
                    if($email == $email2){
                        $emailError = "Email has been used";
                    }
                }    
                if(empty($email)){
                    $emailError = "Email is Required";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailError = "Invalid email format";
                }

                if(empty($uname)){
                    $unameError = "Username is Required";
                }
                $result = odbc_exec($connection,"SELECT Usr FROM [DBTubes2].[dbo].[Pelanggan]");            
                while(odbc_fetch_row($result)){
                    $uname2 = odbc_result($result,'Usr');
                    if($uname == $uname2){
                        $unameError = "Username has been used";
                    }
                }
                if(empty($password)){
                    $passwordError = "Password is Required";
                }
            $query ="CALL  [DBTubes2].[dbo].[sp_insert_pelanggan] '$nama','$almt','$notelp,'$email','$uname','$password'";
            $rs = odbc_exec($connection,$query);
            } catch (PDOException $e){
                die("Query Failed: ".$e->getMessage());
            }
        }
    ?>
    <div class="login mt-5 ms-5 d-flex flex-column">
        <div class="mb-2">  
            <a href="login.php" class="">
                <i class="fa-solid fa-circle-arrow-left fa-3x" style="color: #4e5e79;"></i>
            </a>
        </div>
        <div class="card formregis">
            <div class="bodyformregis">
                <p class="fs-1 fw-bold text-light ms-2" >Create an account</p>
                <form action="" method="post" class="d-flex flex-column " id="formreg">
                    <div class = "d-flex flex-column" id="formreg2">
                        <input type="text" name = "name" id="name" class="form-control form-control-lg mb-2" placeholder="Nama" style="height:40px;">
                        <span class="text-danger fs-5 ms-4" style="width:70%;height:120px;"><?php echo $namaError;?></span>
                    </div>
                    <div class = "d-flex flex-column" id="formreg2">
                        <input type="text" name = "Alamat" id="Alamat" class="form-control form-control-lg mb-2" placeholder="Alamat" style="height:40px;">
                        <span class="text-danger fs-5 ms-4" style="width:70%;height:120px;"><?php echo $almtError;?></span>
                    </div>
                    <div class = "d-flex flex-column" id="formreg2">
                        <input type="text" name = "NOTelp" id="NOTelp" class="form-control form-control-lg mb-2" placeholder="No.Telpon" style="height:40px;">
                        <span class="text-danger fs-5 ms-4" style="width:70%;height:120px;"> <?php echo $notelpError;?></span>
                    </div>
                    <div class = "d-flex flex-column" id="formreg2">
                        <input type="text" name = "Email" id="Email" class="form-control form-control-lg mb-2" placeholder="Email" style="height:40px;">
                        <span class="text-danger fs-5 ms-4" style="width:70%;height:120px;"> <?php echo $emailError;?></span>
                    </div>
                    <div class = "d-flex flex-column" id="formreg2">
                        <input type="text" name = "username" id="username" class="form-control form-control-lg mb-2" placeholder="Username" style="height:40px;">
                        <span class="text-danger fs-5 ms-4" style="width:70%;height:120px;"> <?php echo $unameError;?></span>
                    </div>
                    <div class = "d-flex flex-column" id="formreg2">
                        <div class="d-flex flex-row form-control form-control-lg" style="height:50px; align-item:center;" >
                            <input type="password" name = "Password" id = "Password" placeholder="Password" style="height:30px; width:350px;outline:0; border:0;">
                            <img src="img\eye-slash-solid.svg" id="eyeiconreg">
                        </div>
                        <span class="text-danger fs-5 ms-4" style="width:70%;height:120px;"><?php echo $passwordError;?></span>
                    </div>
                    <input type="submit" name = "insert" value="Sign in" style="height:50px; width : 50%; margin-left:10%;" class="btn btn-outline-light fs-4">
                </form>
            </div>
        </div>
    </div>
    <script>
        let eyeicon = document.getElementById('eyeiconreg');
        let Password = document.getElementById('Password');

        eyeicon.onclick = function(){
            if(Password.type == 'password'){
                Password.type = 'text';
                eyeiconreg.src = "img/eye-solid.svg";
            }else{
                Password.type = 'password'
                eyeiconreg.src = 'img/eye-slash-solid.svg'
            }
        }
    </script>
</body>
</html>