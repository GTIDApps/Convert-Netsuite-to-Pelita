<?php
require 'vendor/autoload.php'; // Jika Anda menggunakan Composer untuk menginstal PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Inisialisasi variabel
$data = []; // Array untuk menyimpan data yang dibaca dari Excel

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah file telah diunggah
    if (isset($_FILES["excel_file"]) && $_FILES["excel_file"]["error"] == 0) {
        $allowed = ["xlsx", "xls"];
        $filename = $_FILES["excel_file"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        // Verifikasi ekstensi file
        if (!in_array($ext, $allowed)) {
            die("File tidak diizinkan. Hanya file Excel yang diizinkan.");
        }

        // Baca file Excel
        $inputFileName = $_FILES["excel_file"]["tmp_name"];
        $spreadsheet = IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Ambil data mulai dari baris kedua
        for ($i = 1; $i < count($rows); $i++) {
            $data[] = $rows[$i]; // Simpan data ke array
        }
    }
}

// Fungsi untuk mengunduh data sebagai file Excel
if (isset($_POST['download'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header kolom
    $header = ['ID', 'NAMA KLIEN', 'NO LAI', 'TGL LAI', 'RESTATEMENT', 'NO LAI RESTATEMENT', 'ALAMAT', 'PROPINSI', 'NEGARA', 'MEMILIKI NPWP', 'NPWP', 'BIDANG USAHA', 'GO PUBLIK', 'STANDAR', 'JENIS LK', 'KEPEMILIKAN', 'OPINI', 'PERIODE AWAL', 'PERIODE AKHIR', 'AP TAHUN SEBELUM', 'PENANGGUNG JAWAB', 'TAHUN AUDIT', 'MATA UANG LABA RUGI BERSIH', 'LABA RUGI BERSIH', 'MATA UANG LABA SEBELUM PAJAK', 'LABA SEBELUM PAJAK', 'MATA UANG FEE JASA', 'FEE JASA', 'MATA UANG JUMLAH PENGHASILAN KOMPREHENSIF', 'JUMLAH PENGHASILAN KOMPREHENSIF', 'MATA UANG BEBAN PAJAK', 'BEBAN PAJAK', 'MATA UANG PENDAPATAN', 'PENDAPATAN', 'MATA UANG TOTAL ASET', 'TOTAL ASET', 'MATA UANG TOTAL LIABILITAS', 'TOTAL LIABILITAS', 'JAM AUDIT PENANGGUNG JAWAB', 'KETERANGAN', 'NPWP16', 'NO SURAT PERIKATAN', 'TGL SURAT PERIKATAN', 'KONSOLIDASI'];

    // Menambahkan header ke dalam sheet
    $column = 'A';
    foreach ($header as $heading) {
        $sheet->setCellValue($column . '1', $heading);
        $column++;
    }

    // Menambahkan data ke dalam sheet
    $rowCount = 2; // Mulai dari baris kedua
    foreach ($data as $row) {
        $colCount = 'A';
        foreach ($row as $cell) {
            $sheet->setCellValue($colCount . $rowCount, $cell);
            $colCount++;
        }
        $rowCount++;
    }

    // Mengatur header untuk unduhan
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="hasil_data.xlsx"');
    header('Cache-Control: max-age=0');

    // Menyimpan file Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel</title>
</head>
<body>
    <h2>Upload File Excel</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="excel_file" required>
        <input type="submit" value="Upload">
    </form>

    <?php if (!empty($data)): ?>
        <h2>Data yang Dibaca dari Excel</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAMA KLIEN</th>
                    <th>NO LAI</th>
                    <th>TGL LAI</th>
                    <th>RESTATEMENT</th>
                    <th>NO LAI RESTATEMENT</th>
                    <th>ALAMAT</th>
                    <th>PROPINSI</th>
                    <th>NEGARA</th>
                    <th>MEMILIKI NPWP</th>
                    <th>NPWP</th>
                    <th>BIDANG USAHA</th>
                    <th>GO PUBLIK</th>
                    <th>STANDAR</th>
                    <th>JENIS LK</th>
                    <th>KEPEMILIKAN</th>
                    <th>OPINI</th>
                    <th>PERIODE AWAL</th>
                    <th>PERIODE AKHIR</th>
                    <th>AP TAHUN SEBELUM</th>
                    <th>PENANGGUNG JAWAB</th>
                    <th>TAHUN AUDIT</th>
                    <th>MATA UANG LABA RUGI BERSIH</th>
                    <th>LABA RUGI BERSIH</th>
                    <th>MATA UANG LABA SEBELUM PAJAK</th>
                    <th>LABA SEBELUM PAJAK</th>
                    <th>MATA UANG FEE JASA</th>
                    <th>FEE JASA</th>
                    <th>MATA UANG JUMLAH PENGHASILAN KOMPREHENSIF</th>
                    <th>JUMLAH PENGHASILAN KOMPREHENSIF</th>
                    <th>MATA UANG BEBAN PAJAK</th>
                    <th>BEBAN PAJAK</th>
                    <th>MATA UANG PENDAPATAN</th>
                    <th>PENDAPATAN</th>
                    <th>MATA UANG TOTAL ASET</th>
                    <th>TOTAL ASET</th>
                    <th>MATA UANG TOTAL LIABILITAS</th>
                    <th>TOTAL LIABILITAS</th>
                    <th>JAM AUDIT PENANGGUNG JAWAB</th>
                    <th>KETERANGAN</th>
                    <th>NPWP16</th>
                    <th>NO SURAT PERIKATAN</th>
                    <th>TGL SURAT PERIKATAN</th>
                    <th>KONSOLIDASI</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Loop melalui baris dan masukkan ke tabel
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $cell) {
                    echo "<td>{$cell}</td>";
                }
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

        <form action="" method="post">
            <input type="hidden" name="download" value="1">
            <input type="submit" value="Download Excel">
        </form>
    <?php endif; ?>
</body>
</html>
