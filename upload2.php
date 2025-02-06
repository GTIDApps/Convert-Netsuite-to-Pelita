<?php
require 'vendor/autoload.php'; // Jika Anda menggunakan Composer untuk menginstal PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auditdatabase";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil mapping dari database
$propinsiMapping = [];
$negaraMapping = [];
$bidangUsahaMapping = [];
$standardMapping = [];
$_SESSION['data']=[];

// Ambil data mapping untuk PROPINSI
$result = $conn->query("SELECT id, name FROM propinsi");
while ($row = $result->fetch_assoc()) {
    $propinsiMapping[$row['name']] = $row['id'];
}

// Ambil data mapping untuk NEGARA
$result = $conn->query("SELECT id, name FROM negara");
while ($row = $result->fetch_assoc()) {
    $negaraMapping[$row['name']] = $row['id'];
}

//Ambil data mapping untuk jasa non asurans
$result = $conn->query("SELECT id, name FROM jasa_non_ansurans");
while ($row = $result->fetch_assoc()) {
    $jasanonansuransMapping[$row['name']] = $row['id'];
}

// Ambil data mapping untuk BIDANG USAHA
$result = $conn->query("SELECT id, name FROM bidang_usaha");
while ($row = $result->fetch_assoc()) {
    $bidangUsahaMapping[$row['name']] = $row['id'];
}

// Ambil data mapping untuk standar
$result = $conn->query("SELECT id, name FROM standar");
while ($row = $result->fetch_assoc()) {
    $standardMapping[$row['name']] = $row['id'];
}

// Ambil data mapping untuk jenis LK
$result = $conn->query("SELECT id, name FROM jenis_lk");
while ($row = $result->fetch_assoc()) {
    $jenisLkMapping[$row['name']] = $row['id'];
}

// Ambil data mapping untuk jenis LK
$result = $conn->query("SELECT id, name FROM kepemilikan");
while ($row = $result->fetch_assoc()) {
    $kepemilikanMapping[$row['name']] = $row['id'];
}

// Ambil data mapping untuk Opini
$result = $conn->query("SELECT id, name FROM opini");
while ($row = $result->fetch_assoc()) {
    $opiniMapping[$row['name']] = $row['id'];
}

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

        $_SESSION['data']=[];
        // Ambil data mulai dari baris kedua
        for ($i = 1; $i < count($rows); $i++) {
            $data[] = $rows[$i]; // Simpan data ke array
            $_SESSION['data'][]=$rows[$i];
        }
        if (!isset($_POST['download'])) {
            //print_r($_SESSION['data']);
        }
    }
}

// Fungsi untuk mengunduh data sebagai file Excel
if (isset($_POST['download'])) {
    echo "hahaha";
    $isi= $_SESSION['data'];
    //print_r($isi);
    foreach ($isi as $row) {
        $colCount = 'A';
        foreach ($row as $cell) {
            echo $colCount . $rowCount. $cell;
            $colCount++;
        }
        $rowCount++;
    }
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header kolom
    $sheet->setCellValue('A1', 'NO_URUT');
    $sheet->setCellValue('B1', 'NAMA KLIEN');
    $sheet->setCellValue('C1', 'NO_LAPORAN');
    $sheet->setCellValue('D1', 'TGL_LAPORAN');
    $sheet->setCellValue('E1', 'ALAMAT');
    $sheet->setCellValue('F1', 'NPWP');
    $sheet->setCellValue('G1', 'JASA_NON_ASURANSI');
    $sheet->setCellValue('H1', 'GO_PUBLIK');
    $sheet->setCellValue('I1', 'KEPEILIKAN');
    $sheet->setCellValue('J1', 'PERIODE_AWAL');
    $sheet->setCellValue('K1', 'PERIODE_AKHIR');
    $sheet->setCellValue('L1', 'MATA_UANG_FEE_JASA');
    $sheet->setCellValue('M1', 'FEE_JASA');
    $sheet->setCellValue('N1', 'NPWP');

    // Menambahkan data ke dalam sheet
    $rowCount = 2; // Mulai dari baris kedua
    foreach ($isi as $row) {
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
   

    <?php if (!empty($data)): ?>
        
        <table border="1">
            <thead>
                <tr>
                <th>NO_URUT</th>
                <th>NAMA KLIEN</th>
                <th>NO_LAPORAN</th>
                <th>TGL_LAPORAN</th>
                <th>ALAMAT</th>
                <th>NPWP</th>
                <th>JASA_NON_ASURANSI</th>
                <th>GO_PUBLIK</th>
                <th>KEPEMILIKAN</th>
                <th>PERIODE_AWAL</th>
                <th>PERIODE_AKHIR</th>
                <th>MATA_UANG_FEE_JASA</th>
                <th>FEE_JASA</th>
                <th>NPWP</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Loop melalui baris dan masukkan ke tabel
            foreach ($data as $row) {
                // Mapping kolom yang perlu diubah
                $restatement = ($row[4] === 'Ya') ? 1 : 0; // RESTATEMENT
                $jasanonansuransId = isset($jasanonansuransMapping[$row[7]]) ? $jasanonansuransMapping[$row[6]] : null; // PROPINSI
               // $propinsiId = isset($propinsiMapping[$row[7]]) ? $propinsiMapping[$row[7]] : null; // PROPINSI
               // $negaraId = isset($negaraMapping[$row[8]]) ? $negaraMapping[$row[8]] : null; // NEGARA
                $memilikiNpwp = ($row[9] === 'Ya') ? 1 : 0; // MEMILIKI NPWP
                $bidangUsahaId = isset($bidangUsahaMapping[$row[11]]) ? $bidangUsahaMapping[$row[11]] : null; // BIDANG USAHA
                $goPublik = ($row[12] === 'Ya') ? 1 : 0; // GO PUBLIK
                $standarId = isset($standardMapping[$row[13]]) ? $standardMapping[$row[13]] : null; // NEGARA
                $jenisLkId = isset($jenisLkMapping[$row[14]]) ? $jenisLkMapping[$row[14]] : null; // jenisLk
                $kepemilikanId = isset($kepemilikanMapping[$row[15]]) ? $kepemilikanMapping[$row[15]] : null; // kepemilikan
                $opiniId = isset($opiniMapping[$row[16]]) ? $opiniMapping[$row[16]] : null; // opini
                $konsolidasiId = ($row[43] === 'Ya') ? 1 : 0; // RESTATEMENT

                // Tampilkan data dalam tabel
                echo "<tr>
                        <td>{$row[0]}</td>
                        <td>{$row[1]}</td>
                        <td>{$row[2]}</td>
                        <td>{$row[3]}</td>
                        <td>{$row[4]}</td>
                        <td>{$row[5]}</td>
                        <td>{$row[6]}</td>
                        <td>{$propinsiId}</td>
                        <td>{$negaraId}</td>
                        <td>{$memilikiNpwp}</td>
                        <td>{$row[10]}</td>
                        <td>{$bidangUsahaId}</td>
                        <td>{$goPublik}</td>
                        <td>{$standarId}</td>
                       
                        
                     
                    </tr>";
            }
            ?>
            </tbody>
        </table>

        <form action="?download=ok" method="post">
            <input type="hidden" name="download" value="1">
            <input type="submit" value="Download Excel">
        </form>
    <?php endif; ?>
</body>
</html>
