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
    $sql = mysqli_query($conn,"INSERT INTO tb_kategori VALUES(null,'$_POST[kategori]')");

    echo "<script>alert('Data Tersimpan');document.location.href='?menu=kategori'</script>";
  }
  $perintah = new oop();
  $table = "tb_kategori";
  $redirect = "?menu=kategori";
  @$where = "kd_kategori = $_GET[id]";
  if(isset($_GET['edit'])){
    $sql = mysqli_query($conn,"SELECT * FROM tb_kategori WHERE kd_kategori = '$_GET[id]'");
    $edit = mysqli_fetch_array($sql);
  }
   if(isset($_GET['hapus'])){
    $sql = mysqli_query($conn,"DELETE FROM tb_kategori WHERE kd_kategori = '$_GET[id]'");

    echo "<script>alert('Data Terhapus');document.location.href='?menu=kategori'</script>";
  }
 if (isset($_POST['updateuser'])) {
    $sql = mysqli_query($conn,"UPDATE tb_kategori SET kd_kategori='$_POST[kd_kategori]',kategori='$_POST[kategori]' WHERE kd_kategori='$_GET[id]'");
    if($sql){

    echo "<script>alert('Data Berhasil Terupdate');document.location.href='kategori.php'</script>";
    }else{
      echo printf("Error : %s\n", mysqli_error($conn));
      exit();
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</head>

<body>
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
	<br><br><br><br><br><br><br>
  <form method="POST">
		<div class="row">
			<div class="col-25">
				<label for="kt">Kategori</label>
			</div>
			<div class="col-75">
				<input type="text" name="kategori" required style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" id="kt" value="<?php echo @$edit[1]; ?>"> 
        </div>
    </div>
    <br>
    <br>
    <div class="row"><center>
    	<input type="submit" value="Simpan" name="simpan">
      <input type="submit" name="updateuser" value="Update">
    </div></center>
  </form>
  </body>
    <center><table align="center">
      <br>
      <br>
     <center><table align="center">
      <br>
      <br>
      <tr align="center">
        <th>Kode kategori</th>
        <th>Kategori</th>
        <th colspan="2">Aksi</th>
      </tr>
      <?php
      $sql = "SELECT * FROM tb_kategori";
    if (isset($_POST['cari'])) {
        $sql="SELECT * FROM tb_kategori WHERE kd_kategori LIKE '$_POST[tcari]%' OR kategori LIKE '$_POST[tcari]%'";
      }else{
        $sql="SELECT * FROM tb_kategori";
      }   
      $sql= mysqli_query($conn,"SELECT * FROM tb_kategori");
      while($r=mysqli_fetch_array($sql)){
      ?>
      <tr>
        <td><?php echo $r['kd_kategori'];?></td>
        <td><?php echo $r['kategori'];?></td>
        <td><a onclick="return confirm('Yakin Ingin Menghapus?')" href="kategori.php?hapus&id=<?php echo $r['kd_kategori'];?>">HAPUS</a></td>
          <td><a class="btn btn-warning" href="kategori.php?edit&id=<?php echo $r['kd_kategori'];?>">EDIT</a></td>
      </tr>
      <?php } ?>
    </table></center>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>

</body>
</html>