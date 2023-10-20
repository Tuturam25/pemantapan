<?php 
    include 'koneksi.php';

    $kueri = mysqli_query($koneks, 'select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi');
    if(isset($_GET['tambah'])) {
        $cek =  mysqli_fetch_assoc($kueri);
    }
?>

<a href="index.php">halaman mahasiswa</a>

<?php if(!isset($_GET['tambah'])) { ?>
    <a href="?tambah">tambah</a>
<?php } ?>
    <?php if(isset($_GET['tambah'])) : ?>
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
                <?php foreach(mysqli_query($koneks, 'select * from programstudi') as $row) { ?>
                    <option value="<?= $row['id_studi'] ?>" ><?= $row['namaProgramStudi'] ?></option>
                <?php } ?>
            </select>
            <button name="tambah">tambah</button>
        </form>
    <?php endif ?>

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