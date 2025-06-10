<?php
session_start();
include 'config/koneksi.php';

if ($_SESSION['level'] == "") {
    header("location:index.php");
    exit;
} elseif ($_SESSION['level'] == "kasir") {
    header("location:dash_kasir.php");
    exit;
}
if (isset($_POST['simpan'])) {
    $sql = mysqli_query($conn, "INSERT INTO tb_user VALUES(null,'$_POST[nama]','$_POST[nohp]','$_POST[username]','$_POST[password]','$_POST[level]')");

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
if (isset($_GET['edit'])) {
    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE kd_user = '$_GET[id]'");
    $edit = mysqli_fetch_array($sql);
}
if (isset($_POST['updateuser'])) {
    $sql = mysqli_query($conn, "UPDATE tb_user SET nama='$_POST[nama]',no_hp='$_POST[nohp]', username='$_POST[username]',password='$_POST[password]',level='$_POST[level]' WHERE kd_user='$_GET[id]'");
    if ($sql) {

        echo "<script>alert('Data Berhasil Terupdate');document.location.href='user.php'</script>";
    } else {
        echo printf("Error : %s\n", mysqli_error($conn));
        exit();
    }
}
if (isset($_GET['hapus'])) {
    $sql = mysqli_query($conn, "DELETE FROM tb_user WHERE kd_user = '$_GET[id]'");

    echo "<script>alert('Data Terhapus');document.location.href='?menu=user'</script>";
}
?>




<div class="table-responsive">
    <div align="right" class="mb-3">
        <a href="" class="btn btn-primary">Tambah</a>
    </div>
    <table align="right" class="mb-3">
        <thead>
            <tr align="center">
                <th>Kode User</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Username</th>
                <th>Password</th>
                <th>Level</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM q_user";
            if (isset($_POST['cari'])) {
                $sql = "SELECT * FROM q_user WHERE kd_user LIKE '$_POST[tcari]%' OR nama LIKE '$_POST[tcari]%' OR no_hp LIKE '$_POST[tcari]%' OR username LIKE '$_POST[tcari]%'";
            } else {
                $sql = "SELECT * FROM q_user";
            }
            $qry = mysqli_query($conn, $sql);
            while ($r = mysqli_fetch_array($qry)) {
            ?>
                <tr>
                    <td><?php echo $r['kd_user']; ?></td>
                    <td><?php echo $r['nama']; ?></td>
                    <td><?php echo $r['no_hp']; ?></td>
                    <td><?php echo $r['username']; ?></td>
                    <td><?php echo $r['password']; ?></td>
                    <td><?php echo $r['level']; ?></td>
                    <td><a onclick="return confirm('Yakin Ingin Menghapus?')" href="user.php?hapus&id=<?php echo $r['kd_user']; ?>">HAPUS</a></td>
                    <td><a href="user.php?edit&id=<?php echo $r['kd_user']; ?>">EDIT</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>