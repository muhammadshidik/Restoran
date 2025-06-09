<?php
session_start();
include 'config/koneksi.php';

if ($_SESSION['level'] == ""){
  header("location:index.php");
  exit;
}elseif ($_SESSION['level'] == "kasir") {
  header("location:dash_kasir.php");
  exit;
}
if (isset($_POST['simpan'])) {
		$sql = mysqli_query($conn,"INSERT INTO tb_user VALUES(null,'$_POST[nama]','$_POST[nohp]','$_POST[username]','$_POST[password]','$_POST[level]')");

		echo "<script>alert('Data Tersimpan');document.location.href='?menu=user'</script>";
	}
  $perintah = new oop();
  $table = "tb_user";
  $redirect = "?menu=user";
  @$where = "nama = $_GET[id]";


  /*if(isset($_POST['simpan'])) {
  	$nama = $_POST['nama'];
  	$nohp = $_POST['nohp'];
  	$username = $_POST['username'];
  	$password = $_POST['password'];
  	$level = $_POST['level'];

  	$value = "'','$nama','$nohp','$username','$password','$level'";
  	$cek = $perintah->countWhere("username","username",$table,"username",$username);
  	if ($cek['username'] > 0) {
        echo "<script>alert('username tidak boleh sama');document.location.href='user.php'</script>";
      }
      else{
        $perintah->simpan($table,$value,"user.php");
      }
  }*/
  if(isset($_GET['edit'])){
		$sql = mysqli_query($conn,"SELECT * FROM tb_user WHERE kd_user = '$_GET[id]'");
		$edit = mysqli_fetch_array($sql);
	}
	if (isset($_POST['updateuser'])) {
		$sql = mysqli_query($conn,"UPDATE tb_user SET nama='$_POST[nama]',no_hp='$_POST[nohp]', username='$_POST[username]',password='$_POST[password]',level='$_POST[level]' WHERE kd_user='$_GET[id]'");
		if($sql){

		echo "<script>alert('Data Berhasil Terupdate');document.location.href='user.php'</script>";
		}else{
			echo printf("Error : %s\n", mysqli_error($conn));
			exit();
		}
	}
	 if(isset($_GET['hapus'])){
		$sql = mysqli_query($conn,"DELETE FROM tb_user WHERE kd_user = '$_GET[id]'");

		echo "<script>alert('Data Terhapus');document.location.href='?menu=user'</script>";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Kelola User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dapur Mama Niar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Menu</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="kategori.php">Kategori</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="laporan.php">Laporan</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="user.php">Kelola User</a>
        </li>
       
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button class="btn btn-outline-success me-5" type="submit">Search</button>
          <button class="btn btn-dark" type="submit" href="logout.php" onclick="return confirm('Apa anda yakin ?')">Keluar</button>
      </form>
    </div>
  </div>
</nav>
	<br>
	<br>
	<br><br>
	<h1 style="font-family:sans-serif; color:rgba(10,101,146);">Kelola User</h1>
	  
      
		<center><form  method="post">
    <div class="row">
      <div class="col-25">
        <label for="nama">Nama Lengkap</label>
      </div>
      <div class="col-75">
        <input style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" type="text" id="nama" name="nama" placeholder="Masukan nama.." required value="<?php echo @$edit['nama']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="ry">No HP</label>
      </div>
      <div class="col-75">
        <input style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" type="text" id="ry" name="nohp" placeholder="No HP" required value="<?php echo @$edit['no_hp'];?>">
      </div>
    </div>
       <div class="row">
      <div class="col-25">
        <label for="us">Username</label>
      </div>
      <div class="col-75">
        <input style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" type="text" id="us" name="username" placeholder="Username" required value="<?php echo @$edit['username'];?>">
      </div>
    </div>
     <div class="row">
      <div class="col-25">
        <label for="pw">Password</label>
      </div>
      <div class="col-75">
        <input style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" type="text" id="pw" name="password" placeholder="Password" required value="<?php echo @$edit['password'];?>">
      </div>
    </div>
       <!--<div class="row">
      <div class="col-25">
        <label for="lvl">Level</label>
      </div>
      <div class="col-75">
        <input type="text" id="lvl" name="level" required>
      </div>
    </div>-->
    <div class="row">
    <div class="col-25">
    <label for="lvl">Level</label>
	</div>
    <div class="col-75">
        <select style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" name="level" id="lvl" value="<?php echo @$edit[5]; ?>">
          <option>admin</option>
          <option>kasir</option>
        </select>
    </div>
  </div>
      <br>
    <div class="row">
      <input type="submit" value="Simpan" name="simpan">
      <input type="submit" name="updateuser" value="Update">
    </div>
    
   </form></center>
        <br>
      <br>
      <form method="post">
      <div class="s" style="float: right;">
      <input type="text" name="tcari" style="width:50%;padding:5px;box-sizing: border-box; resize: vertical; text-align: right;border-radius: 2px;" value="<?php echo @$_POST['tcari']; ?>"class="cari">
      <input type="submit" name="cari" value="Cari" style=" width: 80px; border: 0; background-color: rgb(10,101,146); height: 31px; color: white; border-radius: 4px;" >
    </div>
    </form><br>
    <form>    
      <center><table align="center">
  <br>
  <br>
  <br>
    <tr align="center">
    	<th>Kode User</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Username</th>
        <th>Password</th>
        <th>Level</th>
        <th colspan="2" align="center">Aksi</th>

    </tr>
    <?php 	
    $sql = "SELECT * FROM q_user";
    if (isset($_POST['cari'])) {
        $sql="SELECT * FROM q_user WHERE kd_user LIKE '$_POST[tcari]%' OR nama LIKE '$_POST[tcari]%' OR no_hp LIKE '$_POST[tcari]%' OR username LIKE '$_POST[tcari]%'";
      }else{
        $sql="SELECT * FROM q_user";
      }		
 			$qry= mysqli_query($conn,$sql);
 			while($r=mysqli_fetch_array($qry)){
			?>
<tr>
				<td><?php echo $r['kd_user'];?></td>
				<td><?php echo $r['nama'];?></td>
				<td><?php echo $r['no_hp'];?></td>
				<td><?php echo $r['username'];?></td>
				<td><?php echo $r['password'];?></td>
				<td><?php echo $r['level'];?></td>
				<td><a onclick="return confirm('Yakin Ingin Menghapus?')" href="user.php?hapus&id=<?php echo $r['kd_user'];?>">HAPUS</a></td>
					<td><a href="user.php?edit&id=<?php echo $r['kd_user'];?>">EDIT</a></td>
			</tr>
			<?php } ?>
  </table></center>
  </form>

  <br>
  <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>