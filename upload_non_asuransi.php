<?php
session_start();
require 'vendor/autoload.php'; // Jika Anda menggunakan Composer untuk menginstal PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

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
$jasaMapping=[];
$bidangUsahaMapping = [];
$standardMapping = [];
$_SESSION['data'] = [];

// Ambil data mapping untuk Jasa
$result = $conn->query("SELECT id, nama_jasa FROM JASA_NON_ASURANSI");
while ($row = $result->fetch_assoc()) {
    $jasaMapping[$row['nama_jasa']] = $row['id'];
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

function matauang($str, $conn) {
    $str = $conn->real_escape_string($str);
    $result = $conn->query("SELECT id, kode_mata_uang FROM mata_uang WHERE kode_mata_uang='$str'");
    if ($result === false) {
        throw new Exception("Query gagal: " . $conn->error);
    }
    $row = $result->fetch_assoc();

    if ($row === null) {
        return null;
        // throw new Exception("Kode MATA_UANG '$str' tidak ditemukan");
    }
    $mataUangMapping = $row['id'];

    return $mataUangMapping;
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

        // Simpan nama file tanpa ekstensi dalam session
        $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
        $_SESSION['filename'] = $filenameWithoutExt;

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scrollable-table {
            max-height: 400px; /* Sesuaikan tinggi maksimum tabel */
            overflow-y: auto;
        }

    </style>
</head>
<body>
   
    <div class="container mt-5">
        <!-- <h2 class="mb-4">Upload File Excel Klien Non Asuransi</h2>
         <form action="" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <input type="file" name="excel_file" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form> --> 

        <?php if (!empty($data)): ?>
            <div class="container-fluid">
            <h3 class="mb-4">File Excel Klien Non Asuransi</h3>
            <div class="scrollable-table">
                <table class="table table-striped table-bordered w-100">
                    <thead>
                        <tbody class="table-group-divider">
                        <tr class="table-primary">
                            <th>NO_URUT</th>
                            <th>NAMA KLIEN</th>
                            <th>NO_LAPORAN</th>
                            <th>TGL_LAPORAN</th>
                            <th>ALAMAT</th>
                            <th>NPWP</th>
                            <th>JASA_NON_ASURANSI</th>
                            <th>BIDANG_USAHA</th>
                            <th>GO_PUBLIK</th>
                            <th>KEPEMILIKAN</th>
                            <th>PERIODE_AWAL</th>
                            <th>PERIODE_AKHIR</th>
                            <th>PENANGGUNG_JAWAB</th>
                            <th>MATA_UANG_FEE_JASA</th>
                            <th>FEE_JASA</th>
                            <th>NPWP16</th>
                        </tr>
                        </tbody>
                    </thead>
                    <tbody>
                    <?php
                    // Loop melalui baris dan masukkan ke tabel
                    foreach ($data as $row) {
                        // Mapping kolom yang perlu diubah
                        $jasaId = isset($jasaMapping[$row[6]]) ? $jasaMapping[$row[6]] : null;
                        $bidangUsahaId = isset($bidangUsahaMapping[$row[7]]) ? $bidangUsahaMapping[$row[7]] : null; // BIDANG USAHA
                        $goPublik = ($row[8] === 'Ya') ? 1 : 0; // GO PUBLIK
                        $kepemilikanId = isset($kepemilikanMapping[$row[9]]) ? $kepemilikanMapping[$row[9]] : null; // kepemilikan

                        $data_convert = [
                            'NO_URUT' => $row[0],
                            'NAMA_KLIEN' => $row[1],
                            'NO_LAPORAN' => $row[2],
                            'TGL_LAPORAN' => $row[3],
                            'ALAMAT' => $row[4],
                            'NPWP' => $row[5],
                            'JASA_NON_ASURANSI' => $jasaId,
                            'BIDANG_USAHA' => $bidangUsahaId,
                            'GO_PUBLIK' => $goPublik,
                            'KEPEMILIKAN' => $kepemilikanId,
                            'PERIODE_AWAL' => $row[10],
                            'PERIODE_AKHIR' => $row[11],
                            'PENANGGUNG_JAWAB' => $row[12],
                            'MATA_UANG_FEE_JASA' => matauang($row[13], $conn),
                            'FEE_JASA' => $row[14],
                            'NPWP16' => $row[15]
                        ];
                        $_SESSION['data'][] = $data_convert;

                        // Tampilkan data dalam tabel
                        echo "<tr>
                                <td>{$row[0]}</td>
                                <td>{$row[1]}</td>
                                <td>{$row[2]}</td>
                                <td>{$row[3]}</td>
                                <td>{$row[4]}</td>
                                <td>{$row[5]}</td>
                                <td>{$jasaId}</td>
                                <td>{$bidangUsahaId}</td>
                                <td>{$goPublik}</td>
                                <td>{$kepemilikanId}</td>
                                <td>{$row[10]}</td>
                                <td>{$row[11]}</td>
                                <td>{$row[12]}</td>
                                <td>" . matauang($row[13], $conn) . "</td>
                                <td>{$row[14]}</td>
                                <td>{$row[15]}</td>
                            </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            </div>

            <form action="download_non_asuransi.php" method="POST">
                <input type="hidden" name="download" value="1">
                <button type="submit" class="btn btn-success">Download Hasil Konversi</button>
            </form>
            <br>
            <br>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS dan dependensi -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
