<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Periksa apakah id siswa ada, misalnya update.php?id=1 akan mendapatkan siswa dengan id 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // Bagian ini mirip dengan create.php, tetapi sebagai gantinya dengan mengupdate record dan bukan insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
        $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';
        
        // Perbarui catatan
        $stmt = $pdo->prepare('UPDATE siswa SET id = ?, nama = ?, kelas = ?, jenis_kelamin = ?  WHERE id = ?');
        $stmt->execute([$id, $nama, $kelas, $jenis_kelamin, $_GET['id']]);
        $msg = 'Data berhasil dirubah';
    }
    // Dapatkan nama siswa dari tabel siswa
    $stmt = $pdo->prepare('SELECT * FROM siswa WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $siswa = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$siswa) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('SISWA')?>

<div class="content update">
	<h2>Update Siswa #<?=$siswa['id']?></h2>
    <form action="update.php?id=<?=$siswa['id']?>" method="post">
        <label for="id">ID</label>
        <label for="nama">Nama</label>
        <input type="text" name="id" value="<?=$siswa['id']?>" id="id">
        <input type="text" name="nama" value="<?=$siswa['nama']?>" id="nama">
        <label for="kelas">Kelas</label>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <input type="text" name="kelas" value="<?=$siswa['kelas']?>" id="kelas">
        <input type="text" name="jenis_kelamin" value="<?=$siswa['jenis_kelamin']?>" id="jenis_kelamin">

        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>