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
									<a class="nav-link" href="#">Data Petugas</a>
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
							echo"
							<script>
								alert('Tindakan ilegal...menuju ke Login');
								location.href='../index.php';
							</script>";
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
			$querya="SELECT * FROM tb_petugas WHERE id_level='2'";
			$resulta=mysqli_query($conn,$querya);
			$counta=mysqli_num_rows($resulta);
		?>
		<div class="container-fluid">
			<div class="alert alert-dark">
				<h2>Data Petugas</h2>
				<hr>
				<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#TambahData">
					Tambah Data
				</button>
				<input class="form-control" id="search" type="text" placeholder="Search.." style="width: auto;margin-bottom: 10px;float: right;">
				<div class="table-responsive">
					<table class="table table-bordered table-dark table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>ID Petugas</th>
								<th>Nama Petugas</th>
								<th>Username</th>
								<th>ID Level</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody id="petugas">
							<?php
								$no=1;
								while($dataa=mysqli_fetch_array($resulta))
								{
							?>
							<tr class="text-center">
								<td><?php echo $no; ?></td>
								<td><?php echo $dataa['id_petugas']; ?></td>
								<td><?php echo $dataa['nama_petugas']; ?></td>
								<td><?php echo $dataa['username']; ?></td>
								<td><?php echo $dataa['id_level']; ?></td>
								<td>
									<a class="badge badge-success" href="edit_petugas.php?id_petugas=<?php echo $dataa['id_petugas']; ?>">Edit</a>
									<a class="badge badge-danger" href="delete_petugas.php?id_petugas=<?php echo $dataa['id_petugas']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Data ini?')">Hapus</a>
								</td>
							</tr>
							<?php
								$no++;
								}
							?>
						</tbody>
					</table>
				</div>
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
		<div class="modal fade" id="TambahData">
			<div class="modal-dialog">
				<div class="modal-content">
      
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Daftar Petugas</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<form action="register_petugas.php" method="POST">
							<div class="form-group">
								<label for="nama_petugas">Nama Petugas:</label>
								<input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Nama Petugas" required>
							</div>
							<div class="form-group">
								<label for="username">Username:</label>
								<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
							</div>
							<div class="form-group">
								<label for="password">Password:</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
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
		<script>
			$(document).ready(function(){
				$("#search").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#petugas tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
		</script>
		<footer class="bg-transparent" >
       	<div class="container my-auto">
			<center>
			<strong>Copyright @</strong>Dave Elyada Gerika. 2024
			</center>
       	</div>
		</footer>
	</body>
</html>