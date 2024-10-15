<?php
	session_start();
    include './new-header.php';
?>
	<form method="get" action="tampil_antri.php" class="content-centered col-8">
		<h3 class="">Feedback</h3>
		<div class="form-group w-100">
			<label>No Antrian</label>
			<input type="text" name="id" class="form-control form-control-user" required>
		</div>
		<button type="submit" class="btn btn-new-primary w-100">Cari</button>
		<?php
		
			$idCustomer = $_SESSION['id_customer'];
			$datas = mysqli_query($koneksi, "SELECT * from tb_aduan WHERE id_customer = '$idCustomer' ORDER BY waktu_kirim ASC");
			foreach ( $datas as $row){
				echo
				"<div class='card-antrian'>
					<div class='d-flex flex-column justify-content-center'>
						<div>".$row['perihal']."</div>
						<div>".$row['waktu_kejadian']."</div>
					</div>
					<div class='d-flex flex-column justify-content-center'>
						<a class='btn btn-new-primary' href='./tampil_antri.php?id=".$row['id_aduan']."'>Detail</a>
					</div>
				</div>";
			}
		?>

	</form>
<?php require_once("./footer.php"); ?>