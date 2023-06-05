<?php
require('fpdf/fpdf.php');

// Mendapatkan data siswa dari input
$dataSiswa = $_POST['dataSiswa'];

// Memisahkan data siswa menjadi array berdasarkan baris
$siswaRows = explode('|', $dataSiswa);

// Membuat instance objek FPDF dengan layout landscape
$pdf = new FPDF('L');
$pdf->AddPage();

// Menampilkan data siswa dalam bentuk tabel
$pdf->SetFont('Arial', 'B', 12);

// Header tabel
$pdf->Cell(40, 10, 'Image', 1, 0, 'C');
$pdf->Cell(60, 10, 'NIS', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 10, 'Jenis Kelamin', 1, 0, 'C');
$pdf->Cell(40, 10, 'Telepon', 1, 0, 'C');
$pdf->Cell(40, 10, 'Alamat', 1, 0, 'C');
$pdf->Ln();

// Data siswa
$pdf->SetFont('Arial', '', 12);
foreach ($siswaRows as $siswaRow) {
  $siswaData = explode(',', $siswaRow);

  $image = $siswaData[0];
  $nis = $siswaData[1];
  $nama = $siswaData[2];
  $jenisKelamin = $siswaData[3];
  $telepon = $siswaData[4];
  $alamat = $siswaData[5];

  $pdf->Cell(40, 10, $image, 1, 0, 'C');
  $pdf->Cell(60, 10, $nis, 1, 0, 'C');
  $pdf->Cell(50, 10, $nama, 1, 0, 'C');
  $pdf->Cell(40, 10, $jenisKelamin, 1, 0, 'C');
  $pdf->Cell(40, 10, $telepon, 1, 0, 'C');
  $pdf->Cell(40, 10, $alamat, 1, 0, 'C');
  $pdf->Ln();
}

// Output PDF
$pdf->Output();
?>