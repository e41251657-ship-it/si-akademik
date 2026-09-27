<!DOCTYPE html>
<html>
<head>
    <title>Cek Method</title>
</head>
<body>

<form method="POST">
    <button type="submit">
        Kirim POST
    </button>
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo "<h3>Halaman dibuka menggunakan GET</h3>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<h3>Form dikirim menggunakan POST</h3>";
}

?>

</body>
</html>