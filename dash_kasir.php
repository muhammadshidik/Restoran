<?php
session_start();
if ($_SESSION['level'] == ""){
  header("location:index.php");
  exit;
}elseif ($_SESSION['level'] == "admin") {
  header("location:dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>

</head>
<style type="text/css">
* {margin:0; padding:0;}
nav{
	position: fixed;
	background-color: rgb(10,101,146);
	 width: 100%;
	 height: 50px;
	 font-family: sans-serif;	 
}
nav ul ul {
 display: none;
}

nav ul li:hover > ul{
display: block;
width: 150px;
}

nav ul {
 background: rgb(10,101,146);
 list-style: none;
 position: relative;
 display: inline-table;
 width: 100%;
}
        

nav ul li{
 float:left;
}

nav ul li:hover{
 background:#666;

}

nav ul li:hover a{
 color:#fff;

}

nav ul li a{
 display: block;
 padding: 20px;
 color: #fff;
 text-decoration: none;

}
</style>

<body>
	<div class="container">
		<nav>
		<ul>
			<li><a href="dash_kasir.php">Dashboard</a></li>
			<li><a href="transaksi.php">Transaksi</a></li>
			<li><a href="logout.php" onclick="return confirm('Apa anda yakin ?')">Log Out</a></li>
		</ul>
	</nav>
	<br><br><br><br><br><br><br><br><br><br><br><br>
	<center><h1 style="font-family: arial;">Selamat Datang di Dashboard </h1></center>
	</div>
</body>
</html>