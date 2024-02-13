<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			Lelang Online</title>
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" sizes="192x192" href="../db_img/bid.png">
		<link rel="stylesheet" href="../assets/css/bootstrap.css"> 
		<script src="../assets/js/jquery.js"></script> 
		<script src="../assets/js/popper.js"></script> 
		<script src="../assets/js/bootstrap.js"></script>
		<!-- Script to store the table data in a JavaScript variable -->
		<script>
		var tableData = <?php echo json_encode($tableData); ?>;
		</script>
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
			<a class="navbar-brand" href="#"><span style="font-weight: bold;">LELANG<span style="color: lightskyblue;">ONLINE</span></span></a>
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
									<a class="nav-link" href="#">Beranda</a>
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
									<a class="nav-link" href="#">Beranda</a>
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
		<div class="container-fluid">
			<div class="alert alert-dark" style="overflow:auto;">
				<h2>Data Lelang</h2>
				<hr>
				<button type="button" class="btn btn-outline-info float-left" data-toggle="modal" data-target="#TambahData">
					Tambah Data
				</button>
				<?php if(isset($_GET['barang']) && isset($_GET['harga']) ) echo '<div class="spinner-grow text-primary float-left"></div>' ?>
				<input class="form-control float-right" id="search" type="text" placeholder="Search.." style="width: auto;margin-bottom: 10px;">
				<div class="table-responsive">
					<table class="table table-bordered table-dark table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>ID Lelang</th>
								<th>ID Barang</th>
								<th>Tanggal Lelang</th>
								<th>Penawaran terakhir</th>
								<th>ID Petugas</th>
								<th>Status</th>
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
								$jumkon=20;
								$offset=($nohal-1)*$jumkon;
								$jumhal_sql="SELECT COUNT(*) FROM tb_lelang";
								$hasil=mysqli_query($conn,$jumhal_sql);
								$jumbar=mysqli_fetch_array($hasil)[0];
								$jumhal=ceil($jumbar / $jumkon);
								$no=1;
								$sqla="SELECT * FROM tb_lelang LIMIT $offset, $jumkon";
								$querya=mysqli_query($conn,$sqla);
								$tableData = [];
								while($dataa=mysqli_fetch_array($querya))
								{
									$tableData[] = $dataa;
							?>
							<tr class="text-center">
								<td><?php echo $no; ?></td>
								<td><?php echo $dataa['id_lelang']; ?></td>
								<td><?php echo $dataa['id_barang']; ?></td>
								<td><?php echo $dataa['tgl_lelang']; ?></td>
								<td><?php echo number_format($dataa['harga_akhir'], 0, '','.'); ?></td>
								<td><?php echo $dataa['id_petugas']; ?></td>
								<td>
									<?php
										// 	if($level==2)
										//{
											$id_lelang=$dataa['id_lelang'];
											if($dataa['status']=="dibuka")
											{
												echo '<a href="#" class="badge badge-pill badge-success">Dibuka</a><br>';
												echo '<a href="status_lelang.php?id_lelang='.$id_lelang.'&status=ditutup" class="badge badge-pill badge-secondary">Ditutup</a><br>';
												echo '<a href="status_lelang.php?id_lelang='.$id_lelang.'&status=terlelang" class="badge badge-pill badge-secondary">Terlelang</a>';
											}
											else if($dataa['status']=="terlelang")
											{
												echo '<a href="status_lelang.php?id_lelang='.$id_lelang.'&status=dibuka" class="badge badge-pill badge-secondary">Dibuka</a><br>';
												echo '<a href="status_lelang.php?id_lelang='.$id_lelang.'&status=ditutup" class="badge badge-pill badge-secondary">Ditutup</a><br>';
												echo '<a href="#" class="badge badge-pill badge-info">Terlelang</a>';
											}
											else
											{
												echo '<a href="status_lelang.php?id_lelang='.$id_lelang.'&status=dibuka" class="badge badge-pill badge-secondary">Dibuka</a><br>';
												echo '<a href="#" class="badge badge-pill badge-danger">Ditutup</a><br>';
												echo '<a href="status_lelang.php?id_lelang='.$id_lelang.'&status=terlelang" class="badge badge-pill badge-secondary">Terlelang</a>';
											}
										//}
										// else
										// {
										// 	if($dataa['status']=="dibuka")
										// 	{
										// 		echo '<span class="badge badge-pill badge-success">Dibuka</span><br>';
										// 		echo '<span class="badge badge-pill badge-secondary">Ditutup</span><br>';
										// 		echo '<span class="badge badge-pill badge-secondary">Terlelang</span>';
										// 	}
										// 	else if($dataa['status']=="terlelang")
										// 	{
										// 		echo '<span class="badge badge-pill badge-secondary">Dibuka</span><br>';
										// 		echo '<span class="badge badge-pill badge-secondary">Ditutup</span><br>';
										// 		echo '<span class="badge badge-pill badge-info">Terlelang</span>';
										// 	}
										// 	else
										// 	{
										// 		echo '<span class="badge badge-pill badge-secondary">Dibuka</span><br>';
										// 		echo '<span class="badge badge-pill badge-danger">Ditutup</span><br>';
										// 		echo '<span class="badge badge-pill badge-secondary">Terlelang</span>';
										// 	}
										// }
									?>
								</td>
								<td>
									<a class="badge badge-primary" href="page_lelang.php?id_lelang=<?php echo $dataa['id_lelang']; ?>&id_barang=<?php echo $dataa['id_barang']; ?>">
										Monitoring
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
				<!-- TABEL ADA DI ANTARA 2 SCRIPT YG DI BLOK INI -->
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
						<h4 class="modal-title">Tambah Data Lelang</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
        
					<!-- Modal body -->
					<div class="modal-body">
						<form action="simpan_data_lelang.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label for="id_barang">ID Barang:</label>
								<input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="ID Barang" value="<?php if(empty($_GET['barang'])){ echo ""; }else{ echo $_GET['barang']; } ?>" required>
							</div>
							<div class="form-group">
								<label for="tgl_lelang">Tanggal:</label>
								<input type="date" class="form-control" name="tgl_lelang" id="tgl_lelang" value="<?php echo date('Y-m-d'); ?>" required>
							</div>
							<div class="form-group">
								<label for="harga_akhir">Penawaran terakhir:</label>
								<input type="text" class="form-control" name="harga_akhir" id="harga_akhir" placeholder="Harga Akhir" value="<?php if(empty($_GET['harga'])){ echo ""; }else{ echo $_GET['harga']; } ?>" required>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="ID User" required>
							</div>
							<div class="form-group">
								<label for="id_petugas">ID Petugas:</label>
								<input type="text" class="form-control" name="id_petugas" id="id_petugas" placeholder="ID Petugas" value="<?php echo $data['id_petugas']; ?>" required>
							</div>
							<div class="form-group">
								<input type="hidden" class="form-control" name="status" id="status" placeholder="Status" required>
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
	<footer class="bg-transparent">
		<div class="container my-auto">
			<center>
            <strong>Copyright @</strong>Dave Elyada Gerika. 2024
			</center>
		</div>
    </footer>
	</body>
	

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
</html>