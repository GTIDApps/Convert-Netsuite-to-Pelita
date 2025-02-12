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
$propinsiMapping = [];
$negaraMapping = [];
$bidangUsahaMapping = [];
$standardMapping = [];
$_SESSION['data'] = [];

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
    // Bersihkan input untuk mencegah SQL Injection
    $str = $conn->real_escape_string($str);

    // Ambil data mapping untuk matauang
    $result = $conn->query("SELECT id, kode_mata_uang FROM mata_uang WHERE kode_mata_uang='$str'");

    if ($result === false) {
        // Jika query gagal, lempar pengecualian atau tangani kesalahan
        throw new Exception("Query gagal: " . $conn->error);
    }

    $row = $result->fetch_assoc();

    if ($row === null) {
        // Jika tidak ada hasil, kembalikan nilai default atau lempar pengecualian
        return null; // Atau bisa juga melempar pengecualian
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
    <title>Upload Excel Ansurance</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
body {
    width:100%
}


        .scrollable-table {
            max-height: 400px;
    /* Sesuaikan tinggi maksimum tabel */
           overflow-y:auto;
        }

        .container-fluid {
            width: 100%

        }

    </style>
</head>
<body>
    
     <div class="container mt-5">
        <!-- <h2 class="mb-4">Upload File Excel Klien Pusat</h2>
        <form action="" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <input type="file" name="excel_file" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form> --> 

        <?php if (!empty($data)): ?>
            <center>
        <div class="container-fluid">
            <h4 class="mb-4">KlienAuPusat</h4>
            <div class="scrollable-table">
                <table class="table table-striped table-bordered w-100">
                    <thead>
                        <tbody class="table-group-divider">
                        <tr class="table-primary">
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
                            <th>MATA_UANG LABA_RUGI_BERSIH</th>
                            <th>LABA RUGI BERSIH</th>
                            <th>MATA_UANG LABA_SEBELUM_PAJAK</th>
                            <th>LABA SEBELUM PAJAK</th>
                            <th>MATA_UANG FEE JASA</th>
                            <th>FEE JASA</th>
                            <th>MATA_UANG JUMLAH_PENGHASILAN_KOMPREHENSIF</th>
                            <th>JUMLAH PENGHASILAN_KOMPREHENSIF</th>
                            <th>MATA_UANG BEBAN_PAJAK</th>
                            <th>BEBAN PAJAK</th>
                            <th>MATA_UANG PENDAPATAN</th>
                            <th>PENDAPATAN</th>
                            <th>MATA_UANG TOTAL ASET</th>
                            <th>TOTAL ASET</th>
                            <th>MATA_UANG TOTAL_LIABILITAS</th>
                            <th>TOTAL LIABILITAS</th>
                            <th>JAM AUDIT PENANGGUNG_JAWAB</th>
                            <th>KETERANGAN</th>
                            <th>NPWP16</th>
                            <th>NO SURAT PERIKATAN</th>
                            <th>TGL SURAT PERIKATAN</th>
                            <th>KONSOLIDASI</th>
                        </tr>
                        </tbody>
                    </thead>
                    <tbody>
                    <?php
                    // Loop melalui baris dan masukkan ke tabel
                    foreach ($data as $row) {
                        // Mapping kolom yang perlu diubah
                        $restatement = ($row[4] === 'Ya') ? 1 : 0; // RESTATEMENT
                        $propinsiId = isset($propinsiMapping[$row[7]]) ? $propinsiMapping[$row[7]] : null; // PROPINSI
                        $negaraId = isset($negaraMapping[$row[8]]) ? $negaraMapping[$row[8]] : null; // NEGARA
                        $memilikiNpwp = ($row[9] === 'Ya') ? 1 : 0; // MEMILIKI NPWP
                        $bidangUsahaId = isset($bidangUsahaMapping[$row[11]]) ? $bidangUsahaMapping[$row[11]] : null; // BIDANG USAHA
                        $goPublik = ($row[12] === 'Ya') ? 1 : 0; // GO PUBLIK
                        $standarId = isset($standardMapping[$row[13]]) ? $standardMapping[$row[13]] : null; // NEGARA
                        $jenisLkId = isset($jenisLkMapping[$row[14]]) ? $jenisLkMapping[$row[14]] : null; // jenisLk
                        $kepemilikanId = isset($kepemilikanMapping[$row[15]]) ? $kepemilikanMapping[$row[15]] : null; // kepemilikan
                        $opiniId = isset($opiniMapping[$row[16]]) ? $opiniMapping[$row[16]] : null; // opini
                        $konsolidasiId = ($row[43] === 'Ya') ? 1 : 0; // R

                        $data_convert = [
                            'ID' => $row[0],
                            'NAMA_KLIEN' => $row[1],
                            'NO_LAI' => $row[2],
                            'TGL_LAI' => $row[3],
                            'RESTATEMENT' => $restatement,
                            'NO_LAI_RESTATEMENT' => $row[5],
                            'ALAMAT' => $row[6],
                            'PROPINSI' => $propinsiId,
                            'NEGARA' => $negaraId,
                            'MEMILIKI_NPWP' => $memilikiNpwp,
                            'NPWP' => $row[10],
                            'BIDANG_USAHA' => $bidangUsahaId,
                            'GO_PUBLIK' => $goPublik,
                            'STANDAR' => $standarId,
                            'JENIS_LK' => $jenisLkId,
                            'KEPEMILIKAN' => $kepemilikanId,
                            'OPINI' => $opiniId,
                            'PERIODE_AWAL' => $row[17],
                            'PERIODE_AKHIR' => $row[18],
                            'AP_TAHUN_SEBELUM' => $row[19],
                            'PENANGGUNG_JAWAB' => $row[20],
                            'TAHUN_AUDIT' => $row[21],
                            'MATA_UANG_LABA_RUGI_BERSIH' => matauang($row[22], $conn),
                            'LABA_RUGI_BERSIH' => $row[23],
                            'MATA_UANG_LABA_SEBELUM_PAJAK' => matauang($row[24], $conn),
                            'LABA_SEBELUM_PAJAK' => $row[25],
                            'MATA_UANG_FEE_JASA' => matauang($row[26], $conn),
                            'FEE_JASA' => $row[27],
                            'MATA_UANG_JUMLAH_PENGHASILAN_KOMPREHENSIF' => matauang($row[28], $conn),
                            'JUMLAH_PENGHASILAN_KOMPREHENSIF' => $row[29],
                            'MATA_UANG_BEBAN_PAJAK' => matauang($row[30], $conn),
                            'BEBAN_PAJAK' => $row[31],
                            'MATA_UANG_PENDAPATAN' => matauang($row[32], $conn),
                            'PENDAPATAN' => $row[33],
                            'MATA_UANG_TOTAL_ASET' => matauang($row[34], $conn),
                            'TOTAL_ASET' => $row[35],
                            'MATA_UANG_TOTAL_LIABILITAS' => matauang($row[36], $conn),
                            'TOTAL_LIABILITAS' => $row[37],
                            'JAM_AUDIT_PENANGGUNG_JAWAB' => $row[38],
                            'KETERANGAN' => $row[39],
                            'NPWP16' => $row[40],
                            'NO_SURAT_PERIKATAN' => $row[41],
                            'TGL_SURAT_PERIKATAN' => $row[42],
                            'KONSOLIDASI' => $konsolidasiId
                        ];
                        $_SESSION['data'][] = $data_convert;

                        // Tampilkan data dalam tabel
                        echo "<tr>
                                <td>{$row[0]}</td>
                                <td>{$row[1]}</td>
                                <td>{$row[2]}</td>
                                <td>{$row[3]}</td>
                                <td>{$restatement}</td>
                                <td>{$row[5]}</td>
                                <td>{$row[6]}</td>
                                <td>{$propinsiId}</td>
                                <td>{$negaraId}</td>
                                <td>{$memilikiNpwp}</td>
                                <td>{$row[10]}</td>
                                <td>{$bidangUsahaId}</td>
                                <td>{$goPublik}</td>
                                <td>{$standarId}</td>
                                <td>{$jenisLkId}</td>
                                <td>{$kepemilikanId}</td>
                                <td>{$opiniId}</td>
                                <td>{$row[17]}</td>
                                <td>{$row[18]}</td>
                                <td>{$row[19]}</td>
                                <td>{$row[20]}</td>
                                <td>{$row[21]}</td>
                                <td>" . matauang($row[22], $conn) . "</td>
                                <td>{$row[23]}</td>
                                <td>" . matauang($row[24], $conn) . "</td>
                                <td>{$row[25]}</td>
                                <td>" . matauang($row[26], $conn) . "</td>
                                <td>{$row[27]}</td>
                                <td>" . matauang($row[28], $conn) . "</td>
                                <td>{$row[29]}</td>
                                <td>" . matauang($row[30], $conn) . "</td>
                                <td>{$row[31]}</td>
                                <td>" . matauang($row[32], $conn) . "</td>
                                <td>{$row[33]}</td>
                                <td>" . matauang($row[34], $conn) . "</td>
                                <td>{$row[35]}</td>
                                <td>" . matauang($row[36], $conn) . "</td>
                                <td>{$row[37]}</td>
                                <td>{$row[38]}</td>
                                <td>{$row[39]}</td>
                                <td>{$row[40]}</td>
                                <td>{$row[41]}</td>
                                <td>{$row[42]}</td>
                                <td>{$konsolidasiId}</td>
                            </tr>";
                    }
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            </center>

            <form action="download.php" method="POST">
                <input type="hidden" name="download" value="1">
            <div class="col-md-12 text-center mt-4">
                <button type="submit" class="btn btn-success">Download</button>
                </div>
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
