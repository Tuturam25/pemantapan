<?php 
    include 'koneksi.php';

    if(!$_GET) {
        $kueri = mysqli_query($koneks, 'select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi');
    } else {
        $kueri = mysqli_query($koneks, 'select * from mahasiswa join programstudi on mahasiswa.programStudi = programstudi.id_studi where id_mhs = '. $_GET['id']);
    }
    
?>

<a href="admin.php">halaman admin</a>
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
