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
									<a class="nav-link" href="#">Data Barang</a>
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
									<a class="nav-link" href="#">Data Barang</a>
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
		<div class="container-fluid">
			<div class="alert alert-dark">
				<h2>Data Barang</h2>
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
								<th>ID Barang</th>
								<th>Nama Barang</th>
								<th>Tanggal</th>
								<th>Harga Awal</th>
								<th>Foto</th>
								<th>Deskripsi Barang</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody id="barang">
							<?php
								include '../dbconnect.php';
								if(isset($_GET['nohal']))
								{
									$nohal=$_GET['nohal'];
								} 
								else
								{
									$nohal=1;
								}
								$jumkon=50;
								$offset=($nohal-1)*$jumkon;
								$jumhal_sql="SELECT COUNT(*) FROM tb_barang";
								$hasil=mysqli_query($conn,$jumhal_sql);
								$jumbar=mysqli_fetch_array($hasil)[0];
								$jumhal=ceil($jumbar / $jumkon);
								$no=1;
								if($level==1)
								{
									$sqla="SELECT* FROM tb_barang LIMIT $offset, $jumkon";
								}
								else
								{
									$sqlb = "SELECT * FROM tb_lelang";
									$queryb = mysqli_query($conn,$sqlb);
									$countb = mysqli_num_rows($queryb);
									$datab=mysqli_fetch_array($queryb);

									if($countb==0)
									{
										$sqla="SELECT * FROM tb_barang LIMIT $offset, $jumkon";
									}
									else
									{
										$sqla="SELECT * FROM tb_barang WHERE id_barang NOT IN (SELECT id_barang FROM tb_lelang) LIMIT $offset, $jumkon";
									}
								}
								$querya=mysqli_query($conn,$sqla);
								while($dataa=mysqli_fetch_array($querya))
								{
							?>
							<tr class="text-center">
								<td><?php echo $no; ?></td>
								<td><?php echo $dataa['id_barang']; ?></td>
								<td><?php echo $dataa['nama_barang']; ?></td>
								<td><?php echo ($dataa['tgl']); ?></td>
								<td><?php echo number_format($dataa['harga_awal'], 0, '','.'); ?></td>
								<td>
									<button class="btn btn-info" data-toggle="collapse" data-target="#collapse<?php echo $no; ?>">Lihat</button>
									<div id="collapse<?php echo $no; ?>" class="collapse">
										<img src="<?php echo "../db_img/".$dataa['foto']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo "../db_img/".$dataa['foto']; ?>" style="width: 70%; height: auto; max-width: 200px; max-height: 200px; margin-top: 10px;">
									</div>
								</td>
								<td><?php echo $dataa['deskripsi_barang']; ?></td>
								<td>
									<a class="badge badge-primary" href="index.php?barang=<?php echo $dataa['id_barang']; ?>&harga=<?php echo $dataa['harga_awal']; ?>">
										Lelang
									</a>
									<a class="badge badge-success" href="edit.php?id_barang=<?php echo $dataa['id_barang']; ?>">
										Edit
									</a>
									<a class="badge badge-danger" href="delete.php?id_barang=<?php echo $dataa['id_barang']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus Data ini?')">
										Hapus
									</a>
								</td>
							</tr>
							<?php
								$no++;
								}
							?>
						</tbody>
					</table>
				</div>
				<ul class="pagination pagination-sm flex-wrap justify-content-sm-end">
					<li class="page-item"><a class="page-link" href="?nohal=1">First</a></li>
					<li class="page-item <?php if($nohal <= 1){ echo 'disabled'; } ?>">
						<a class="page-link" href="<?php if($nohal <= 1){ echo '#'; } else { echo "?nohal=".($nohal - 1); } ?>">Prev</a>
					</li>
					<?php
						for($i=1;$i<=$jumhal;$i++)
						{
							$id=$i;
					?>
					<li id="<?php echo $id; ?>" class="page-item <?php if($nohal == $id){echo "active"; }; ?> <?php if($id != $nohal){echo "d-none"; }; ?>"><a class="page-link" href="?nohal=<?php echo $i; ?>"><?php echo $i; echo "/$jumhal";?></a></li>
					<?php
							
						}
					?>
					<li class="page-item <?php if($nohal >= $jumhal){ echo 'disabled'; } ?>">
						<a class="page-link" href="<?php if($nohal >= $jumhal){ echo '#'; } else { echo "?nohal=".($nohal + 1); } ?>">Next</a>
					</li>
					<li class="page-item"><a class="page-link" href="?nohal=<?php echo $jumhal; ?>">Last</a></li>
				</ul>
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
						<h4 class="modal-title">Tambah Data Barang</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<form action="simpan_data.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="nama_barang">Nama Barang:</label>
								<input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" required>
							</div>
							<div class="form-group">
								<label for="tgl">Tanggal:</label>
								<input type="date" class="form-control" name="tgl" id="tgl" value="<?php echo date('Y-m-d'); ?>" required>
							</div>
							<div class="form-group">
								<label for="harga_awal">Harga Awal:</label>
								<input type="text" class="form-control" name="harga_awal" id="harga_awal" placeholder="Harga Awal" required>
							</div>
							<div class="form-group">
								<label for="foto">Foto:</label>
								<input type="file" class="form-file" name="foto" id="foto" placeholder="Foto">
							</div>
							<div class="form-group">
								<label for="deskripsi_barang">Deskripsi Barang:</label>
								<textarea name="deskripsi_barang" class="form-control" id="deskripsi_barang" cols="10" rows="5"></textarea>
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
					$("#barang tr").filter(function() {
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