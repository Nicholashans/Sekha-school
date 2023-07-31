<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Periksa apakah ID kontak ada
if (isset($_GET['id'])) {
    // Pilih catatan yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM siswa WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $siswa = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$siswa) {
        exit('stock doesn\'t exist with that ID!');
    }
    // Pastikan pengguna mengonfirmasi sebelum penghapusan
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // Pengguna mengklik tombol "Ya", hapus catatan
            $stmt = $pdo->prepare('DELETE FROM siswa WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Data siswa dihapus!';
        } else {
            // Pengguna mengklik tombol "Tidak", mengarahkan mereka kembali ke halaman baca
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Siswa #<?=$siswa['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p> Apakah yakin menghapus Siswa ? #<?=$siswa['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$siswa['id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$siswa['id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>