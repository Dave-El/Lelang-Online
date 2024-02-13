<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="192x192" href="db_img/bid.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/popper.js"></script> 
    <script src="assets/js/bootstrap.js"></script>
    <title>Lelang Online</title>
    <style>
        body {
            background-color: lightskyblue;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container-card {
            background-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border-radius: 8px;
            text-align: left;
            max-width: 500px; 
            width: 100%; 
        }

        .center-text {
            text-align: center;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
        
        .sticky-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: transparent;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-card">
        <div class="center-text">
            <strong style="font-size: 200%;" class="text-dark">Lelang Online</strong><p>
            <span style="font-size: 120%;">Tidak punya akun?</span>
            <a href="#" data-toggle="modal" data-target="#Register">
                Register
            </a>
        </div>
    
        <form action="login.php" method="post" style="margin-top: 10px;">
            <div class="form-group">
                <label for="username" style="text-align: left;">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password" style="text-align: left;">Password:</label>
                <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <!-- <div class="input-group-append">
                        <button class="btn btn-outline-info" type="button" onclick="showPass()" ondblclick="hidePass()">Show</button>
                    </div> -->
                </div>
            </div>
            <button type="submit" class="btn btn-outline-info" style="margin-top: 10px;">Masuk</button>
        </form>
    </div>
    <footer class="bg-transparent sticky-footer" >
       	<div class="container my-auto">
			<center>
                <strong>Copyright @</strong>Dave Elyada Gerika. 2024
			</center>
       	</div>
	</footer>
    <div class="modal fade" id="Register">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title">Register</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <form action="register.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="password" id="pwd" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-outline-dark">Daftar</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- <script>
        function showPass() {
            document.getElementById("pwd").type = 'text';
        }

        function hidePass() {
            document.getElementById("pwd").type = 'password';
        }
    </script> -->

</body>
</html>