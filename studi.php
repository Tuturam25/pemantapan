<?php
include 'koneksi.php';

if (isset($_GET['ubah'])) {
    $kueri = mysqli_query($koneks, "select * from programstudi where id_studi = $_GET[ubah]");
    $rows = mysqli_fetch_assoc($kueri);
} else {
    $kueri = mysqli_query($koneks, 'select * from programstudi');
}

if (isset($_POST['ubah'])) {
    mysqli_query($koneks, "update programstudi set kodeProgramStudi = '$_POST[kps]', namaProgramStudi = '$_POST[nps]' where id_studi = $_POST[id]");
    header('location: studi.php');
}

if (isset($_POST['tambah'])) {
    mysqli_query($koneks, "insert into programstudi values('', '$_POST[kps]', '$_POST[nps]')");
    header('location: studi.php');
}
if (isset($_GET['hapus'])) {
    mysqli_query($koneks, "delete from programstudi where id_studi = $_GET[hapus]");
    header('location: studi.php');
}
?>

<a href="admin.php">halaman mahasiswa</a>

<?php if (!isset($_GET['tambah'])) { ?>
    <a href="?tambah">tambah</a>
<?php } ?>
<?php if (isset($_GET['tambah'])) : ?>
    <a href="admin.php">batal</a>
    <form action="" method="post">
        <label for="">kode program studi</label>
        <input type="text" name="kps">
        <label for="">nama program studi</label>
        <input type="text" name="nps">
        <button name="tambah">tambah</button>
    </form>
<?php endif;
if (!isset($_GET['ubah'])) : ?>
    <table border="1">
        <tr>
            <th>kode program studi</th>
            <th>nama program studi</th>
            <th>aksi</th>
        </tr>
        <?php foreach ($kueri as $row) : ?>
            <tr>
                <td><?= $row['kodeProgramStudi'] ?></td>
                <td><?= $row['namaProgramStudi'] ?></td>
                <td>
                    <a href="?ubah=<?= $row['id_studi'] ?>">ubah</a>
                    <a href="?hapus=<?= $row['id_studi'] ?>">hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php elseif (isset($_GET['ubah'])) : ?>
    <br>
    <a href="studi.php">kembali</a>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $rows['id_studi'] ?>">
        <label for="">kode program studi</label>
        <input type="text" name="kps" value="<?= $rows['kodeProgramStudi'] ?>">
        <label for="">nama program studi</label>
        <input type="text" name="nps" value="<?= $rows['namaProgramStudi'] ?>">
        <button name="ubah">ubah</button>
    </form>
<?php endif ?>