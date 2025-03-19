<?php
session_start();
require 'vendor/autoload.php'; // Jika Anda menggunakan Composer untuk menginstal PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auditdatabase";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$jasaMapping=[];
$bidangUsahaMapping = [];
$standardMapping = [];
$_SESSION['data'] = [];


$result = $conn->query("SELECT id, nama_jasa FROM JASA_NON_ASURANSI");
while ($row = $result->fetch_assoc()) {
    $jasaMapping[$row['nama_jasa']] = $row['id'];
}


$result = $conn->query("SELECT id, name FROM bidang_usaha");
while ($row = $result->fetch_assoc()) {
    $bidangUsahaMapping[$row['name']] = $row['id'];
}


$result = $conn->query("SELECT id, name FROM standar");
while ($row = $result->fetch_assoc()) {
    $standardMapping[$row['name']] = $row['id'];
}


$result = $conn->query("SELECT id, name FROM jenis_lk");
while ($row = $result->fetch_assoc()) {
    $jenisLkMapping[$row['name']] = $row['id'];
}


$result = $conn->query("SELECT id, name FROM kepemilikan");
while ($row = $result->fetch_assoc()) {
    $kepemilikanMapping[$row['name']] = $row['id'];
}


$result = $conn->query("SELECT id, name FROM opini");
while ($row = $result->fetch_assoc()) {
    $opiniMapping[$row['name']] = $row['id'];
}

$result = $conn->query("SELECT id, name FROM propinsi");
while ($row = $result->fetch_assoc()) {
    $propinsiMapping[$row['name']] = $row['id'];
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
     
    }
    $mataUangMapping = $row['id'];

    return $mataUangMapping;
}

$data = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_FILES["excel_file"]) && $_FILES["excel_file"]["error"] == 0) {
        $allowed = ["xlsx", "xls"];
        $filename = $_FILES["excel_file"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

      
        if (!in_array($ext, $allowed)) {
            die("File tidak diizinkan. Hanya file Excel yang diizinkan.");
        }

      
        $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
        $_SESSION['filename'] = $filenameWithoutExt;

 
        $inputFileName = $_FILES["excel_file"]["tmp_name"];
        $spreadsheet = IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        
        for ($i = 1; $i < count($rows); $i++) {
            $data[] = $rows[$i]; 
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
        body {
        width:100%;
        margin: 200px auto;
        }

        .scrollable-table {
            max-height : 400px;
            max-widht : 1500px; 
              overflow-y: auto;

        }

        th {
            font-size :14px;
            font-weight : 700;
            color:white;
        }

        h4 {
            font-weight : bold;
            font-size : 24px;
            text-align: center;
        }

       table.table {
            border: 2px solid black;
        }

        table.table-bordered, table.table-striped  {
            border: 2px solid black !important; 
        }

        .back-button {
            position : absolute;
            top:50px;
            left:50px;
          width: 200px;
        }

        .table-purple {
            background-color:#6f42c1 !important;
        }

        .btn-table {
            background-color: #6f42c1 !important;
            color:white;
        }

    </style>
</head>
<body>

    <div class="back-button">
        <a href="index.php" class="btn btn-table">Back</a>
    </div>
   
    <div class="container mt-5">
        <?php if (!empty($data)): ?>
            <div class="container-fluid">
            <h4 class="mb-4">Non Assurance</h4>
            <div class="scrollable-table">
                <table class="table table-striped table-bordered w-100 " >
                    <thead>
                        <tbody class="table-group-divider">
                        <tr class="table table-purple">
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
                            <th>PROPINSI</th>
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
                        $propinsiId = isset($propinsiMapping[$row[15]]) ? $propinsiMapping[$row[15]] : null;

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
                            'PROPINSI' => $propinsiId,
                            'NPWP16' => $row[16]
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
                                 <td>{$propinsiId}</td>
                                <td>{$row[16]}</td>
                            </tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            </div>

            <form action="download_non_asuransi.php" method="POST">
                <input type="hidden" name="download" value="1">
                <div class="col-md-12 text-center mt-5">
                <button type="submit" class="btn btn-success">Download </button></div>
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
