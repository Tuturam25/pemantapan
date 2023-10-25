<?php
include 'koneksi.php';

if (!$_GET) {
    $kueri = mysqli_query($koneks, 'select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi');
} else {
    $kueri = mysqli_query($koneks, "select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi where namaMahasiswa like '%$_GET[nama]%'");
}

?>

<a href="admin.php">halaman admin</a>
<br>
<sub>cari berdasarkan nama mahasiswa</sub>
<form action="">
    <input type="search" name="nama">
    <button>cari</button>
</form>
<?php if (isset($_GET['nama']) and mysqli_num_rows($kueri) > 0) { ?>
    <a href="index.php">reset</a>
    <table>
        <tr>
            <th>nama mahasiswa</th>
            <th>nama npm</th>
            <th>email</th>
            <th>usia</th>
            <th>program studi</th>
        </tr>
        <?php foreach ($kueri as $row) : ?>
            <tr>
                <td><?= $row['namaMahasiswa'] ?></td>
                <td><?= $row['npm'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['usia'] ?></td>
                <td><?= $row['namaProgramStudi'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php } elseif (isset($_GET['nama']) and mysqli_num_rows($kueri) == 0) { ?>
    <h1>data tidak ditemukan</h1>
<?php } else { ?>
    <table>
        <tr>
            <th>nama mahasiswa</th>
            <th>nama npm</th>
            <th>email</th>
            <th>usia</th>
            <th>program studi</th>
        </tr>
        <?php foreach ($kueri as $row) : ?>
            <tr>
                <td><?= $row['namaMahasiswa'] ?></td>
                <td><?= $row['npm'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['usia'] ?></td>
                <td><?= $row['namaProgramStudi'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php } ?>