<html>

  <head>
    <title>Aplikasi CRUD dengan PHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

    <?php
    // Load file koneksi.php
    include "koneksi.php";
    // Ambil data NIS yang dikirim oleh index.php melalui URL
    $id = $_GET['id'];
    // Query untuk menampilkan data siswa berdasarkan ID yang dikirim
    $sql = $pdo->prepare("SELECT * FROM siswa WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute(); // Eksekusi query insert
    $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
    ?>
    <div class="container mx-auto py-8">
      <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 shadow">
        <h2 class="text-2xl font-semibold mb-6">Form Input Data Siswa</h2>
        <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
          <div class="mb-4">
            <label for="nis" class="block text-gray-700 font-bold mb-2">NIS</label>
            <input type="text" id="nis" name="nis"
              class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
              placeholder="Masukkan NIS" required value="<?php echo $data['nis']; ?>">
          </div>

          <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama</label>
            <input type="text" id="nama" name="nama"
              class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
              placeholder="Masukkan Nama" required value="<?php echo $data['nama']; ?>">
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Jenis Kelamin</label>
            <div class="flex items-center gap-2">
              <?php
              if ($data['jenis_kelamin'] == "Laki-laki") {
                echo "<input type='radio' name='jenis_kelamin' value='laki-laki' checked='checked'> Laki-laki";
                echo "<input type='radio' name='jenis_kelamin' value='perempuan'> Perempuan";
              } else {
                echo "<input type='radio' name='jenis_kelamin' value='laki-laki'> Laki-laki";
                echo "<input type='radio' name='jenis_kelamin' value='perempuan' checked='checked'> Perempuan";
              }
              ?>
            </div>
          </div>

          <div class="mb-4">
            <label for="telepon" class="block text-gray-700 font-bold mb-2">Telepon</label>
            <input type="text" id="telp" name="telp"
              class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
              placeholder="Masukkan Telepon" required value="<?php echo $data['telp']; ?>">
          </div>

          <div class="mb-4">
            <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat</label>
            <textarea id="alamat" name="alamat"
              class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
              placeholder="Masukkan Alamat" required><?php echo $data['alamat']; ?></textarea>
          </div>

          <div class="mb-4">
            <label for="foto" class="block text-gray-700 font-bold mb-2">Upload Foto</label>
            <input type="file" id="foto" name="foto" class="w-full" accept="image/*" required>
          </div>
          <div class="flex justify-end gap-2">
            <!-- <button type="submit" onclick="window.location.href='index.php'"
              class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button> -->
            <input type="submit" value="Ubah"
              class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            <!-- <button type="submit" onclick="window.location.href='index.php'"
              class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">batal</button> -->
            <a href="index.php"><input type="button" value="Batal"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"></a>

          </div>
        </form>
      </div>
    </div>
  </body>

</html>