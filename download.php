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
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\ColumnRule;

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Menambahkan header kolom
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'NAMA KLIEN');
    $sheet->setCellValue('C1', 'NO LAI');
    $sheet->setCellValue('D1', 'TGL LAI');
    $sheet->setCellValue('E1', 'RESTATEMENT');
    $sheet->setCellValue('F1', 'NO LAI RESTATEMENT');
    $sheet->setCellValue('G1', 'ALAMAT');
    $sheet->setCellValue('H1', 'PROPINSI');
    $sheet->setCellValue('I1', 'NEGARA');
    $sheet->setCellValue('J1', 'MEMILIKI NPWP');
    $sheet->setCellValue('K1', 'NPWP');
    $sheet->setCellValue('L1', 'BIDANG USAHA');
    $sheet->setCellValue('M1', 'GO PUBLIK');
    $sheet->setCellValue('N1', 'STANDAR');
    $sheet->setCellValue('O1', 'JENIS LK');
    $sheet->setCellValue('P1', 'KEPEMILIKAN');
    $sheet->setCellValue('Q1', 'OPINI');
    $sheet->setCellValue('R1', 'PERIODE AWAL');
    $sheet->setCellValue('S1', 'PERIODE AKHIR');
    $sheet->setCellValue('T1', 'AP TAHUN SEBELUM');
    $sheet->setCellValue('U1', 'PENANGGUNG JAWAB');
    $sheet->setCellValue('V1', 'TAHUN AUDIT');
    $sheet->setCellValue('W1', 'MATA UANG LABA RUGI BERSIH');
    $sheet->setCellValue('X1', 'LABA RUGI BERSIH');
    $sheet->setCellValue('Y1', 'MATA UANG LABA SEBELUM PAJAK');
    $sheet->setCellValue('Z1', 'LABA SEBELUM PAJAK');
    $sheet->setCellValue('AA1', 'MATA UANG FEE JASA');
    $sheet->setCellValue('AB1', 'FEE JASA');
    $sheet->setCellValue('AC1', 'MATA UANG JUMLAH PENGHASILAN KOMPREHENSIF');
    $sheet->setCellValue('AD1', 'JUMLAH PENGHASILAN KOMPREHENSIF');
    $sheet->setCellValue('AE1', 'MATA UANG BEBAN PAJAK');
    $sheet->setCellValue('AF1', 'BEBAN PAJAK');
    $sheet->setCellValue('AG1', 'MATA UANG PENDAPATAN');
    $sheet->setCellValue('AH1', 'PENDAPATAN');
    $sheet->setCellValue('AI1', 'MATA UANG TOTAL ASET');
    $sheet->setCellValue('AJ1', 'TOTAL ASET');
    $sheet->setCellValue('AK1', 'MATA UANG TOTAL LIABILITAS');
    $sheet->setCellValue('AL1', 'TOTAL LIABILITAS');
    $sheet->setCellValue('AM1', 'JAM AUDIT PENANGGUNG JAWAB');
    $sheet->setCellValue('AN1', 'KETERANGAN');
    $sheet->setCellValue('AO1', 'NPWP16');
    $sheet->setCellValue('AP1', 'NO SURAT PERIKATAN');
    $sheet->setCellValue('AQ1', 'TGL SURAT PERIKATAN');
    $sheet->setCellValue('AR1', 'KONSOLIDASI');
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

    $sheet->getStyle('A1:AR1')->applyFromArray($headerStyle);

    // Mengatur filter pada header
    $autoFilter = $sheet->getAutoFilter();
    $autoFilter->setRange('A1:AR1');

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
    $rowCount = 2; // Mulai dari baris kedua
    foreach ($_SESSION['data'] as $row) {
        $colCount = 'A';

        foreach ($row as $cell) {
            $cell=strval($cell);
            //echo strlen($cell);
            if (strlen($cell)==16){
                $cell= "'".$cell;
            }
            $sheet->setCellValue($colCount . $rowCount, $cell);
            $sheet->getStyle($colCount . $rowCount)->applyFromArray($dataStyle);
            if($rowCount % 2 ==0 ){
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
