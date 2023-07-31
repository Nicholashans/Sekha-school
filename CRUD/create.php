<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Periksa apakah data POST tidak kosong
if (!empty($_POST)) {
    // Posting data tidak kosong masukkan catatan baru
    // Atur variabel yang akan disisipkan, harus memeriksa apakah variabel POST ada,jika tidak kita dapat mengaturnya menjadi kosong
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Periksa apakah variabel "nama" POST ada, jika tidak default nilainya kosong, pada dasarnya sama untuk semua variabel
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : '';

    // Masukkan catatan baru ke dalam tabel siswa
    $stmt = $pdo->prepare('INSERT INTO siswa VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $nama, $kelas, $jenis_kelamin]);
    // Pesan keluaran
    $msg = 'Berhasil Ditambahkan!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Siswa</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="nama">Siswa</label>
        <input type="text" name="id" id="id">
        <input type="text" name="nama" id="nama">
        <label for="kelas">Kelas</label>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <input type="text" name="kelas" id="kelas">
        <input type="text" name="jenis_kelamin" id="jenis_kelamin">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>