<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

        ?>
<html>

<body>
    <form action="upload_file_action.php" method="post" enctype="multipart/form-data" id="form">
        <input type="text" name="link" />
        <input type="file" name="file" />
        <button type="submit">Kirim</button>
    </form>
</body>

</html>
<?php

?>