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
	</form>
<?php require_once("./footer.php"); ?>