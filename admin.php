<?php
include 'koneksi.php';

if (isset($_GET['ubah'])) {
    $kueri = mysqli_query($koneks, "select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi where id_mhs = $_GET[ubah]");
    $rows = mysqli_fetch_assoc($kueri);
} else {
    $kueri = mysqli_query($koneks, 'select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi');
}

if (isset($_POST['ubah'])) {
    mysqli_query($koneks, "update mahasiswa set namaMahasiswa = '$_POST[nama]', npm = '$_POST[npm]', email = '$_POST[email]', usia = '$_POST[usia]', programStudi = '$_POST[program]' where id_mhs = $_POST[id]");
    header('location: admin.php');
}

if (isset($_POST['tambah'])) {
    mysqli_query($koneks, "insert into mahasiswa values('','$_POST[nama]', '$_POST[npm]', '$_POST[email]', '$_POST[usia]', '$_POST[program]')");
    header('location: admin.php');
}
if (isset($_GET['hapus'])) {
    mysqli_query($koneks, "delete from mahasiswa where id_mhs = $_GET[hapus]");
    header('location: admin.php');
}
?>

<a href="index.php">halaman mahasiswa</a>
<a href="studi.php">halaman studi</a>


<?php if (!isset($_GET['tambah'])) { ?>
    <a href="?tambah">tambah</a>
<?php } ?>
<?php if (isset($_GET['tambah'])) : ?>
    <a href="admin.php">batal</a>
    <form action="" method="post">
        <label for="">nama mahasiswa</label>
        <input type="text" name="nama">
        <label for="">npm</label>
        <input type="text" name="npm">
        <label for="">email</label>
        <input type="text" name="email">
        <label for="">usia</label>
        <input type="text" name="usia">
        <label for="">program studi</label>
        <select name="program" id="">
            <?php foreach (mysqli_query($koneks, 'select * from programstudi') as $row) { ?>
                <option value="<?= $row['id_studi'] ?>"><?= $row['namaProgramStudi'] ?></option>
            <?php } ?>
        </select>
        <button name="tambah">tambah</button>
    </form>
<?php endif;
if (!isset($_GET['ubah'])) : ?>
    <table border="1">
        <tr>
            <th>nama mahasiswa</th>
            <th>nama npm</th>
            <th>email</th>
            <th>usia</th>
            <th>program studi</th>
            <th>aksi</th>
        </tr>
        <?php foreach ($kueri as $row) : ?>
            <tr>
                <td><?= $row['namaMahasiswa'] ?></td>
                <td><?= $row['npm'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['usia'] ?></td>
                <td><?= $row['namaProgramStudi'] ?></td>
                <td>
                    <a href="?ubah=<?= $row['id_mhs'] ?>">ubah</a>
                    <a href="?hapus=<?= $row['id_mhs'] ?>">hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php elseif (isset($_GET['ubah'])) : ?>
    <br>
    <a href="admin.php">kembali</a>
    <form action="" method="post">
        <label for="">nama mahasiswa</label>
        <input type="hidden" name="id" value="<?= $rows['id_mhs'] ?>">
        <input type="text" name="nama" value="<?= $rows['namaMahasiswa'] ?>">
        <label for="">npm</label>
        <input type="text" name="npm" value="<?= $rows['npm'] ?>">
        <label for="">email</label>
        <input type="text" name="email" value="<?= $rows['email'] ?>">
        <label for="">usia</label>
        <input type="text" name="usia" value="<?= $rows['usia'] ?>">
        <label for="">program studi</label>
        <select name="program" id="">
            <?php foreach (mysqli_query($koneks, 'select * from programstudi') as $row) { ?>
                <option value="<?= $row['id_studi'] ?>" <?php if ($row['id_studi'] == $rows['id_studi']) echo 'selected' ?>><?= $row['namaProgramStudi'] ?></option>
            <?php } ?>
        </select>
        <button name="ubah">ubah</button>
    </form>
<?php endif ?>