<!-- html boilerplate -->
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function () {
        // Mengambil data siswa dari tabel saat tombol "Convert to PDF" ditekan
        $('form').on('submit', function (e) {
          e.preventDefault(); // Menghentikan submit form

          var dataSiswa = '';
          $('table tbody tr').each(function (row, tr) {
            var rowData = '';
            $(tr).find('td').each(function (col, td) {
              if (rowData !== '') {
                rowData += ',';
              }
              rowData += $(td).text();
            });
            if (dataSiswa !== '') {
              dataSiswa += '|';
            }
            dataSiswa += rowData;
          });

          $('input[name="dataSiswa"]').val(dataSiswa); // Mengisi nilai input hidden dengan data siswa

          // Submit form
          $('form').unbind('submit').submit();
        });
      });
    </script>
  </head>

  <body>
    <div class="container mx-auto py-8">
      <h2 class="text-2xl font-semibold mb-6">Tabel Data Siswa</h2>
      <div class="bg-white rounded-lg shadow overflow-x-auto">
        <form method="POST" action="laporan-pdf.php" enctype="multipart/form-data">

          <table class="min-w-full">
            <thead class="bg-gray-200">
              <tr>
                <th class="py-2 px-4">Image</th>
                <th class="py-2 px-4">NIS</th>
                <th class="py-2 px-4">Nama</th>
                <th class="py-2 px-4">Jenis Kelamin</th>
                <th class="py-2 px-4">Telepon</th>
                <th class="py-2 px-4">Alamat</th>
                <th class="py-2 px-4">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <?php
                  include "koneksi.php";

              // query untuk menampilkan semua data siswa
              $sql = $pdo->prepare("SELECT * FROM siswa");
              $sql->execute(); // eksekusi query
              
              while ($data = $sql->fetch()) {

                echo "<tr>";
                echo "<td class='py-2 px-4'><img src='images/" . $data['foto'] . "' alt='Foto Siswa' class='w-12 h-12 rounded-full'></td>";
                echo "<td class='py-2 px-4'>" . $data['nis'] . "</td>";
                echo "<td class='py-2 px-4'>" . $data['nama'] . "</td>";
                echo "<td class='py-2 px-4'>" . $data['jenis_kelamin'] . "</td>";
                echo "<td class='py-2 px-4'>" . $data['telp'] . "</td>";
                echo "<td class='py-2 px-4'>" . $data['alamat'] . "</td>";
                echo "<td class='py-2 px-4'>";
                echo "<a href='form_ubah.php?id=" . $data['id'] . "' class='bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>Ubah</a>";
                echo "<a href='proses_hapus.php?id=" . $data['id'] . "' class='bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded'>Hapus</a>";
                echo "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <?php
          $sql->execute(); // eksekusi query kembali
          $dataSiswa = '';
          while ($data = $sql->fetch()) {
            if ($dataSiswa !== '') {
              $dataSiswa .= '|';
            }
            $dataSiswa .= $data['nis'] . ',' . $data['nama'] . ',' . $data['jenis_kelamin'] . ',' . $data['telp'] . ',' . $data['alamat'];
          }
          ?>
          <input type="hidden" name="dataSiswa" value="<?php echo $dataSiswa; ?>">
          <button type="submit" name="convertPDF"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Convert To PDF</button>
          </form>
      </div>
    </div>
  </body>

</html>