<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			LELANGBARANG
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" sizes="192x192" href="../db_img/bid.png">
		<link rel="stylesheet" href="../assets/css/bootstrap.css"> 
		<script src="../assets/js/jquery.js"></script> 
		<script src="../assets/js/popper.js"></script> 
		<script src="../assets/js/bootstrap.js"></script>
		<style>
			/* Make the image fully responsive */
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
        	}
			body {
            background-color: azure;
        	}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<a class="navbar-brand" href="index.php"><span style="font-weight: bold;">LELANG<span style="color: lightskyblue;">ONLINE</span></span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<?php
					session_start();
					include '../dbconnect.php';
					if(!isset($_SESSION['status']))
					{
						echo"
						<script>
							alert('Tindakan ilegal...menuju ke Login');
							location.href='../index.php';
						</script>";
					}
					else
					{
						$username=$_SESSION['username'];
						$password=$_SESSION['password'];
						$status=$_SESSION['status'];
						$sql = "SELECT * FROM tb_masyarakat WHERE username='$username' AND password='$password'";
						$query = mysqli_query($conn,$sql);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						
                        echo
                        '
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Beranda</a>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#Profile">
                            Akun
                        </button>
                        ';
					}
				?>
			</div>
		</nav>
        <?php
            include '../dbconnect.php';
            $id_user=$_GET['id_user'];
            $querya="SELECT * FROM tb_masyarakat WHERE id_user='$id_user'";
            $resulta=mysqli_query($conn,$querya);
            $counta=mysqli_num_rows($resulta);
            $dataa=mysqli_fetch_array($resulta);
        ?>
        <div class="container-fluid">
			<div class="alert alert-dark">
				<form action="update_data_umum.php" method="POST">
					<div class="form-group">
						<input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="id_user" value="<?php echo $dataa['id_user']; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_lengkap">Nama Lengkap:</label>
						<input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $dataa['nama_lengkap']; ?>">
					</div>
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $dataa['username']; ?>">
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Password">
							Ganti
						</button>
					</div>
					<div class="form-group">
						<label for="telp">No Telp:</label>
						<input type="text" class="form-control" name="telp" id="telp" placeholder="No Telp" value="<?php echo $dataa['telp']; ?>">
					</div>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
        </div>
				
		<!-- The Modal -->
		<div class="modal fade" id="Profile">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">
							Akun&nbsp;
							<a class="badge badge-success" href="edit_data_umum.php?id_user=<?php echo $data['id_user']; ?>">
								Edit
							</a>
						</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<center>
							<strong><?php echo $username; ?></strong>
							<br>
                            <?php 
								echo "Pengguna";
                            ?>
						</center>
						<hr>
						<strong>Data Umum</strong>
                        <br>
						<?php
							echo "<strong>Nama Lengkap:</strong> ";
                            echo $data['nama_lengkap'];
                            echo "<br>";
                            echo "<strong>No. Telepon:</strong> ";
							echo $data['telp'];
						?>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<a href="../logout.php">
							<button type="button" class="btn btn-danger" onclick="return confirm('Yakin anda ingin Keluar?')">
								Keluar
							</button>
						</a>
					</div>
        
				</div>
			</div>
		</div>

		<!-- The Modal -->
		<div class="modal fade" id="Password">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">
							Ganti Password
						</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<form action="update_data_umum.php" method="POST">
							<div class="form-group">
								<input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="ID User" value="<?php echo $dataa['id_user']; ?>" readonly>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $dataa['nama_lengkap']; ?>">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $dataa['username']; ?>">
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="telp" id="telp" placeholder="No Telp" value="<?php echo $dataa['telp']; ?>">
							</div>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
					</div>
        
				</div>
			</div>
		</div>
		<footer class="sticky-footer bg-transparent">
			<div class="container my-auto">
				<strong>Copyright @</strong>Dave Elyada Gerika. 2024
			</div>
    	</footer>
	</body>
</html>