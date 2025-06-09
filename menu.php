<?php 

include 'config/koneksi.php';

if (isset($_POST['simpan'])) {
  $tmp = $_FILES['foto']['tmp_name'];
  $folder = "image/";
  $nama_file = $_FILES['foto']['name'];

  move_uploaded_file($tmp,"$folder/$nama_file");
  $a = mysqli_query($conn, "INSERT INTO tb_menu VALUES(null,'$_POST[menu]','$_POST[jenis]','$_POST[harga]','$_POST[status]','$nama_file','$_POST[kategori]')");
  echo "<script>alert('Berhasil Tersimpan');document.location.href='?menu=menu'</script>";
}

if (isset($_GET['hapus'])) {
  $b = mysqli_query($conn,"DELETE FROM tb_menu WHERE kd_menu = '$_GET[id]'");
  echo "<script>alert('Berhasil Dihapus');document.location.href='?menu=menu''</script>";
}

if (isset($_GET['edit'])) {
  $edit = "SELECT * FROM tb_menu WHERE kd_menu = '$_GET[id]'";
  $take = mysqli_query($conn,$edit);
    $ambil = mysqli_fetch_array($take);
}

if(isset($_POST['update'])){
  $tmp = $_FILES['foto']['tmp_name'];
  $folder = "image/";
  $nama_file = $_FILES['foto']['name'];

  move_uploaded_file($tmp,"$folder/$nama_file");
  $c = mysqli_query($conn,"UPDATE tb_menu SET menu = '$_POST[menu]', jenis = '$_POST[jenis]',harga = '$_POST[harga]', status = '$_POST[status]', foto = '$nama_file', kategori = '$_POST[kategori]' WHERE menu = '$_POST[menu]'");
  echo "<script>alert('Berhasil Diubah');document.location.href='?menu=menu''</script>";
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>transaksi</title>
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

  <h1 style="font-family:sans-serif; color:rgba(10,101,146);">Kelola Menu</h1>
    <form class="container" method="post" enctype="multipart/form-data">
      <div>
        <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="">Menu * </label>
        </div>
        <div class="col-sm-10">
            <input required name="menu" type="text"
                class="form-control"
                placeholder="Masukkan Menu"
                value="<?php echo @$ambil[1];?>">
        </div>
        </div>
      </div>

      <div>
        <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="">Jenis * </label>
        </div>
        <div class="col-sm-10">
          <select name="jenis">
              <option>Makanan</option>
              <option>Minuman</option>
          </select>
        </div>
        </div>
      </div>
      
      <div>
              <div class="mb-3 row">
              <div class="col-sm-2">
                  <label for="">Harga * </label>
              </div>
              <div class="col-sm-10">
                  <input required name="harga" type="text"
                      class="form-control"
                      placeholder="Masukkan Harga"
                      value="<?php echo @$ambil[3];?>">
              </div>
              </div>
      </div>

       <div>
        <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="">Status * </label>
        </div>
        <div class="col-sm-10">
            <input required name="status" type="text"
                class="form-control"
                placeholder=""
                value="<?php echo @$ambil[4];?>">
        </div>
        </div>
      </div>

         <div class="mb-3">
            <div class="col-sm-2">
              <label class="form-label">Photo</label>
            </div>
            <div class="col-sm-10">
                <input type="file" name="foto" class="form-control" value="<?php echo @$ambil[5];?>" >
            </div>
        </div>

        <div>
        <div class="mb-3 row">
        <div class="col-sm-2">
            <label for="">Kategori * </label>
        </div>
        <div class="col-sm-10">
          <select name="kategori">
            <?php 
            $i = 0;
            $a = "SELECT * FROM tb_kategori";
            $b = mysqli_query($conn,$a);
            while ($row = mysqli_fetch_array($b)) {
              $i++;
             ?>
            <option value="<?= $row[0];?>"><?= $row[1];?></option>
          <?php } ?>
          </select>
        </div>
        </div>
      </div>
    <td>
                        <a class="btn btn-outline-success btn-sm" type="submit" value="simpan" name="simpan" >Simpan</a>
                        <a onclick="return confirm('Are you sure??')"
                            href="" class="btn btn-outline-danger btn-sm" type="submit" name="update" value="Update">Delete</a>
                    </td>
      </table><br>
      <div align="center">
      <td><input type="text" name="tcari" style="margin-left: 40px;margin-right: 10px; margin-top: 30px; width: 400px" placeholder="Cari" value="<?php echo @$_POST['tcari']; ?>" class="cari" ><input type="submit" name="cari" class="button" value="Search"></td>
    </div>
    </form>
    <form method="post">
      <table cellpadding="10" border="1" style="margin-top: 30px;border-collapse: collapse;" align="center">
        <tr>
          <th>Kode Menu</th>
          <th>Menu</th>
          <th>Jenis</th>
          <th>Harga</th>
          <th>Status</th>
          <th>Foto</th>
          <th>Kode Kategori</th>
          <th>Aksi</th>
        </tr>
        <?php
          $sql = "SELECT * FROM tb_menu";
          if (isset($_POST['cari'])) {
              $sql="SELECT * FROM tb_menu WHERE kd_menu LIKE '$_POST[tcari]%' OR menu LIKE '$_POST[tcari]%' OR jenis LIKE '$_POST[tcari]%' OR harga LIKE '$_POST[tcari]%' OR status LIKE '$_POST[tcari]%'";
            }else{
              $sql="SELECT * FROM tb_menu";
            }
          $qry = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_array($qry)){
          ?>
        <tr>
          <td><?php echo $row[0]; ?></td>
          <td><?php echo $row[1]; ?></td>
          <td><?php echo $row[2]; ?></td>
          <td>Rp.<?= number_format($row[3],2,',','.'); ?></td>
          <td><?php echo $row[4]; ?></td>
          <td><img src="image/<?php echo $row[5];?>" style="width: 90px; height: 50px;"></td>
          <td><?php echo $row[6]; ?></td>
          <td><a href="?menu=menu&edit&id=<?php echo $row[0];?>">Edit</a> | <a href="?menu=menu&hapus&id=<?php echo $row[0];?>">Hapus</a></td>
        </tr>
      <?php } ?>
      </table>
    </form></cente>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
</body>
</html>