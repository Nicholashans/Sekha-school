<?php
include 'function.php';
// Terhubung ke database MySQL
$pdo = pdo_connect_mysql();
// Dapatkan halaman melalui permintaan GET (param URL: halaman), jika tidak ada default halaman ke 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Jumlah catatan untuk ditampilkan di setiap halaman
$records_per_page = 5;


// Persiapkan pernyataan SQL dan dapatkan catatan dari tabel kontak kami, LIMIT akan menentukan halaman
$stmt = $pdo->prepare('SELECT * FROM siswa ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Ambil catatan sehingga dapat menampilkannya di template.
$siswa = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Dapatkan jumlah total siswa,agar dapat menentukan apakah harus ada tombol berikutnya dan sebelumnya
$num_siswa = $pdo->query('SELECT COUNT(*) FROM siswa')->fetchColumn();
?>


<?=template_header('SISWA')?>

<div class="content read">
	<h2>Daftar Siswa</h2>
	<a href="create.php" class="create-siswa">Create Siswa</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Nama</td>
                <td>Kelas</td>
                <td>Jenis Kelamin</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($siswa as $siswa): ?>
            <tr>
                <td><?=$siswa['id']?></td>
                <td><?=$siswa['nama']?></td>
                <td><?=$siswa['kelas']?></td>
                <td><?=$siswa['jenis_kelamin']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$siswa['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$siswa['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_siswa): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>