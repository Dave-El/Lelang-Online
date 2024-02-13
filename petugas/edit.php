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
			<a class="navbar-brand" href="index.php"><span style="font-weight: bold;">LELANG<span style="color: lightskyblue;">ONLINE</span></span></a>
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
            $id_barang=$_GET['id_barang'];
            $querya="SELECT * FROM tb_barang WHERE id_barang='$id_barang'";
            $resulta=mysqli_query($conn,$querya);
            $counta=mysqli_num_rows($resulta);
            $dataa=mysqli_fetch_array($resulta);
        ?>
        <div class="container-fluid">
			<div class="alert alert-dark">
				<form action="update.php" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="id_barang">ID Barang:</label>
						<input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="ID Barang" value="<?php echo $dataa['id_barang']; ?>" readonly>
					</div>
					<div class="form-group">
						<label for="nama_barang">Nama Barang:</label>
						<input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $dataa['nama_barang']; ?>">
					</div>
					<div class="form-group">
						<label for="tgl">Tanggal:</label>
						<input type="date" class="form-control" name="tgl" id="tgl" value="<?php echo $dataa['tgl']; ?>">
					</div>
					<div class="form-group">
						<label for="harga_awal">Harga Awal:</label>
						<input type="text" class="form-control" name="harga_awal" id="harga_awal" placeholder="Harga Awal" value="<?php echo $dataa['harga_awal']; ?>">
					</div>
					<div class="form-group">
						<label for="foto">Foto:</label>
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Foto">
							Ganti
						</button>
						<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#foto">Lihat</button>
						<div id="foto" class="collapse">
							<img src="<?php echo "../db_img/".$dataa['foto']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo $dataa['foto']; ?>" style="width: 70%;height: auto;margin-top: 10px;">
						</div>
					</div>
					<div class="form-group">
						<label for="deskripsi_barang">Deskripsi Barang:</label>
						<textarea class="form-control" name="deskripsi_barang" id="deskripsi_barang" rows="4" cols="50"><?php echo $dataa['deskripsi_barang']; ?></textarea>
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
		<div class="modal fade" id="Foto">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">
							Ganti Foto
						</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<img src="<?php echo "../db_img/".$dataa['foto']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo $dataa['foto']; ?>" style="width: 70%;height: auto;">
						<form action="update.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<input type="hidden" class="form-control" name="id_barang" id="id_barang" value="<?php echo $dataa['id_barang']; ?>" readonly>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="nama_barang" id="nama_barang" value="<?php echo $dataa['nama_barang']; ?>">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="tgl" id="tgl" value="<?php echo $dataa['tgl']; ?>">
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="harga_awal" id="harga_awal" value="<?php echo $dataa['harga_awal']; ?>">
							</div>
							<div class="form-group">
								<label for="foto">Foto:</label>
								<input type="file" class="form-file" name="foto" id="foto" placeholder="Foto">
							</div>
							<div class="form-group">
							<input type="hidden" class="form-control" name="deskripsi_barang" id="deskripsi_barang" value="<?php echo $dataa['deskripsi_barang']; ?>">
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