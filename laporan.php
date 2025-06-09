<?php 
include 'config/koneksi.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
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
	<br><br><br><br>
	<br><br><br><br>
	<form method="post">
		<center><table >
			<h1>Laporan</h1>
			<tr>
				<td><input type="date" name="tgl_awal" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" placeholder="Tanggal Awal"></td>
				<td><input type="date" name="tgl_akhir" style=" width: 80%;padding: 12px;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;resize: vertical;" placeholder="Tanggal Akhir"></td>
				<td><input type="submit" name="filter" value="Filter" style=" background-color: rgb(10,101,146);color: white;padding: 12px 20px;border: none;border-radius: 4px;cursor: pointer;float: right;"></td>
			</tr>
		</table></center>
		<center><table>
			<tr>
				<th>Nomor</th>
				<th>Kode Transaksi</th>
				<th>Nama Menu</th>
				<th>Harga</th>
				<th>Subtotal</th>
				<th>Tanggal Transaksi</th>
				<th>No Meja</th>
			</tr>
			<?php 
			if(isset($_POST['filter'])){
				$tanggal_awal = $_POST['tgl_awal'];
				$tanggal_akhir = $_POST['tgl_akhir'];
				$sql = mysqli_query($conn, "SELECT * FROM laporan WHERE tgl_transaksi BETWEEN '$tanggal_awal' and '$tanggal_akhir'");
			}
			$i = 0;
			$mysql = mysqli_query($conn,"SELECT*FROM laporan");
			while ($rows = mysqli_fetch_array($mysql)) {
				$i++;
			 ?>
			<tr>
				<td><?= $i; ?></td>
				<td><?= $rows[0] ?></td>
				<td><?= $rows[1] ?></td>
				<td>Rp.<?= number_format($rows[2],2,',','.');  ?></td>
				<td>Rp.<?= number_format($rows[3],2,',','.'); ?></td>
				<td><?= $rows[4] ?></td>
				<td><?= $rows[5] ?></td>
			</tr>
		<?php } ?>
            </table></center>
	</form>
        </div>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 	="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>