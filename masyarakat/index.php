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
            background-color: azure;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color:lightslategrey;">
			<a class="navbar-brand" href="#"><span style="font-weight: bold;">LELANG<span style="color: lightskyblue;">ONLINE</span></span></a>
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
							alert('Silahkan login dahulu');
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
                                <a class="nav-link" href="#">Beranda</a>
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
		<div class="container-fluid">
			<div class="alert mt-2" style="overflow:auto;">
				<div class="container-fluid d-inline-block">
					<div class="row">
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
							$sqla="SELECT * FROM tb_lelang WHERE status='dibuka' LIMIT $offset, $jumkon";
							$querya=mysqli_query($conn,$sqla);

							while($dataa=mysqli_fetch_array($querya))
							{
								$id_barang=$dataa['id_barang'];	
								$sqlb="SELECT * FROM tb_barang WHERE id_barang='$id_barang'";
								$queryb=mysqli_query($conn,$sqlb);
								$datab=mysqli_fetch_array($queryb)
						?>
						<div class="col-sm-4 my-3">
							<a href="page_lelang.php?id_lelang=<?php echo $dataa['id_lelang']; ?>&id_barang=<?php echo $dataa['id_barang']; ?>" class="text-white text-decoration-none">
								<div class="text-center border border-light border-bottom-0 rounded">
									<img src="<?php echo "../db_img/".$datab['foto']; ?>" alt="<?php echo $datab['foto']; ?>" class="img-fluid py-2 rounded" style="width: 185px;height: 150px;">
								</div>
								<div class="text-center py-1 rounded small" style="background-color: green">
									<strong>
										<?php echo $datab['nama_barang']; ?> 
									</strong>
									<br><?php  echo "Harga Awal Rp ".number_format($datab['harga_awal'],  0, '','.'); ?>
									<br><?php  echo "Penawaran Tertinggi Rp ".number_format($dataa['harga_akhir'],  0, '','.'); ?>
								</div>
							</a>
						</div>
						<?php
							}
						?>
					</div>
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
	</body>
</html>