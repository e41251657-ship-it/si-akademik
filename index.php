<!DOCTYPE html>
<html>
<head>
    <title>SI Akademik</title>
</head>
<body>

<h1>Selamat Datang di SI Akademik</h1>

<hr>

<h2>Form Pencarian (GET)</h2>

<form method="GET">
    <input type="text" name="keyword" placeholder="Cari mata kuliah">
    <button type="submit">Cari</button>
</form>

<?php
if(isset($_GET['keyword'])){
    echo "<p>Keyword: " . $_GET['keyword'] . "</p>";
}
?>

<hr>

<h2>Form Login (POST)</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>

<?php
if(isset($_POST['username'])){
    echo "<p>Login berhasil untuk user: " . $_POST['username'] . "</p>";
}
?>

</body>
</html>