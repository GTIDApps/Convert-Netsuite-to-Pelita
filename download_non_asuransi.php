<?php
session_start();
// Mengatur header untuk unduhan
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'.$_SESSION['filename'].'_convert.xlsx"');
header('Cache-Control: max-age=0');


require 'vendor/autoload.php'; // Jika Anda menggunakan Composer untuk menginstal PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header kolom
    $sheet->setCellValue('A1', 'NO URUT');
    $sheet->setCellValue('B1', 'NAMA KLIEN');
    $sheet->setCellValue('C1', 'NO LAPORAN');
    $sheet->setCellValue('D1', 'TGL LAPORAN');
    $sheet->setCellValue('E1', 'ALAMAT');
    $sheet->setCellValue('F1', 'NPWP');
    $sheet->setCellValue('G1', 'JASA_NON_ASURANSI');
    $sheet->setCellValue('H1', 'BIDANG USAHA');
    $sheet->setCellValue('I1', 'GO PUBLIK');
    $sheet->setCellValue('J1', 'KEPEMILIKAN');
    $sheet->setCellValue('K1', 'PERIODE AWAL');
    $sheet->setCellValue('L1', 'PERIODE AKHIR');
    $sheet->setCellValue('M1', 'PENANGGUNG JAWAB');
    $sheet->setCellValue('N1', 'MATA UANG FEE JASA');
    $sheet->setCellValue('O1', 'FEE JASA');
    $sheet->setCellValue('P1', 'PROPONSI');
    $sheet->setCellValue('Q1', 'NPWP16');
    // Mengatur gaya header
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['argb' => 'FFFFFFFF'],
        ],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['argb' => '5A9AD4'],
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'],
            ],
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];

    $sheet->getStyle('A1:P1')->applyFromArray($headerStyle);

    // Mengatur filter pada header
    $autoFilter = $sheet->getAutoFilter();
    $autoFilter->setRange('A1:Q1');

    // Mengatur gaya sel data
    $dataStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => '9BC1E4'],
            ],
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_LEFT,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];
    // Menambahkan data ke dalam sheet
    $rowCount = 1; // Mulai dari baris kedua
    foreach ($_SESSION['data'] as $row) {
        $colCount = 'A';

        foreach ($row as $cell) {
            $cell=strval($cell);
            //echo strlen($cell);
            if (strlen($cell)==17){
                $cell= "'".$cell;
            }
            $sheet->setCellValue($colCount . $rowCount, $cell);
            $sheet->getStyle($colCount . $rowCount)->applyFromArray($dataStyle);
            if($rowCount % 1 ==0 ){
                $sheet->getStyle($colCount . $rowCount)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('DFEAF6');
            }
            $colCount++;
        }
        $rowCount++;
    }


    // Menyimpan file Excel
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;

?>
