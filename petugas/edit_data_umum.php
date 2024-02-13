<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			Lelang Online
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
            background-color: paleturquoise;
        	}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
			<a class="navbar-brand" href="index.php"><span style="font-weight: bold;">LELANG<span style="color:lightskyblue;">ONLINE</span></span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<?php
					session_start();
					include '../dbconnect.php';
					if(!isset($_SESSION['id_level']))
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
						$level=$_SESSION['id_level'];
						$sql = "SELECT * FROM tb_petugas WHERE username='$username' AND password='$password'";
						$query = mysqli_query($conn,$sql);
						$count = mysqli_num_rows($query);
						$data = mysqli_fetch_array($query);
						
						if($level==1)
						{
							echo
							'
							<ul class="navbar-nav mr-auto">
								<li class="nav-item">
									<a class="nav-link" href="index.php">Beranda</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="data_barang.php">Data Barang</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="data_petugas.php">Data Petugas</a>
								</li>
<li class="nav-item">
									<a class="nav-link" href="laporan.php">Laporan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="export.php">Export</a>
								</li>
							</ul>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Profile">
								Akun
							</button>
							';
						}
						else if($level==2)
						{
							echo
							'
							<ul class="navbar-nav mr-auto">
								<li class="nav-item">
									<a class="nav-link" href="index.php">Beranda</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="data_barang.php">Data Barang</a>
								</li>
<li class="nav-item">
									<a class="nav-link" href="laporan.php">Laporan</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="export.php">Export</a>
								</li>
							</ul>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Profile">
								Akun
							</button>
							';
						}
						else
						{
							echo"
							<script>
								alert('Tindakan ilegal...menuju ke Login');
								location.href='../index.php';
							</script>";
						}
					}
				?>
			</div>
		</nav>
        <?php
            include '../dbconnect.php';
            $id_petugas=$_GET['id_petugas'];
            $querya="SELECT * FROM tb_petugas WHERE id_petugas='$id_petugas'";
            $resulta=mysqli_query($conn,$querya);
            $counta=mysqli_num_rows($resulta);
            $dataa=mysqli_fetch_array($resulta);
        ?>
        <div class="container-fluid">
			<div class="alert alert-dark">
				<form action="update_data_umum.php" method="POST">
					<div class="form-group">
						<input type="hidden" class="form-control" name="id_petugas" id="id_petugas" placeholder="ID Petugas" value="<?php echo $dataa['id_petugas']; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_petugas">Nama Petugas:</label>
						<input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Nama Petugas" value="<?php echo $dataa['nama_petugas']; ?>">
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
						<input type="hidden" class="form-control" name="id_level" id="id_level" placeholder="ID Level" value="<?php echo $dataa['id_level']; ?>" readonly>
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
							<a class="badge badge-success" href="edit_data_umum.php?id_petugas=<?php echo $data['id_petugas']; ?>">
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
                                if($level==1)
                                {
                                    echo "Administrator";
                                }
                                else if($level==2)
                                {
                                    echo "Petugas";
                                }
                                else
                                {
                                    echo "User";
                                }
                            ?>
						</center>
						<hr>
						<strong>Data Umum</strong>
                        <br>
						<?php
							echo "<strong>Nama Lengkap:</strong> ";
							echo $data['nama_petugas'];
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
								<input type="hidden" class="form-control" name="id_petugas" id="id_petugas" placeholder="ID Petugas" value="<?php echo $dataa['id_petugas']; ?>" readonly>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Nama Petugas" value="<?php echo $dataa['nama_petugas']; ?>">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $dataa['username']; ?>">
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="id_level" id="id_level" placeholder="ID Level" value="<?php echo $dataa['id_level']; ?>" readonly>
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
		<footer class="bg-transparent" >
       	<div class="container my-auto">
			<center>
			<strong>Copyright @</strong>Dave Elyada Gerika. 2024
			</center>
       	</div>
		</footer>
	</body>
</html>