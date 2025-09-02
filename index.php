<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Bencana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .container { max-width: 1200px; }
        .card { border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 25px; }
        h2 { color: #0d6efd; font-weight: bold; margin-bottom: 20px; text-align: center; }
        table th { background: #0d6efd; color: white; text-align: center; }
        table td { vertical-align: middle; }
        .btn-custom { border-radius: 25px; padding: 10px 25px; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card p-4">
            <h2>Form Input Data Bencana</h2>
            <form action="simpan.php" method="POST">
                <h5 class="mt-3">📍 Data Bencana</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Bencana</label>
                        <select class="form-select" id="jenis" name="jenis" required>
                            <option value="">-- Pilih --</option>
                            <option>Banjir</option>
                            <option>Gempa</option>
                            <option>Longsor</option>
                            <option>Kebakaran</option>
                            <option>Pohon Tumbang</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Kejadian</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Terdampak</label>
                        <input type="number" class="form-control" id="terdampak" name="terdampak" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kerusakan</label>
                        <input type="text" class="form-control" id="kerusakan" name="kerusakan">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                </div>

                <h5 class="mt-4">📄 Informasi Rekomendasi</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Rekomendasi</label>
                        <input type="date" class="form-control" id="tgl_rekom" name="tgl_rekom">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" id="no_surat" name="no_surat">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Surat</label>
                        <input type="date" class="form-control" id="tgl_surat" name="tgl_surat">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">OPD Penerima</label>
                        <input type="text" class="form-control" id="opd" name="opd">
                    </div>
                </div>

                <h5 class="mt-4">💰 Asumsi Kerusakan & Kerugian</h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tinggi (m)</label>
                        <input type="number" step="any" class="form-control" id="tinggi" name="tinggi" oninput="hitungTotal()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Lebar (m)</label>
                        <input type="number" step="any" class="form-control" id="lebar" name="lebar" oninput="hitungTotal()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Panjang (m)</label>
                        <input type="number" step="any" class="form-control" id="panjang" name="panjang" oninput="hitungTotal()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Harga Satuan</label>
                        <input type="number" step="any" class="form-control" id="harga" name="harga" oninput="hitungTotal()">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Kerusakan</label>
                        <input type="text" class="form-control" id="totalKerusakan" name="total_kerusakan" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Total Kerugian</label>
                        <input type="text" class="form-control" id="totalKerugian" name="total_kerugian" readonly>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-custom">💾 Simpan Data</button>
                    <button type="button" class="btn btn-primary btn-custom" onclick="exportExcel()">📊 Export Excel</button>
                </div>
            </form>
        </div>

        <div class="card p-4">
            <h2>📋 Data Tersimpan</h2>
            <div class="mb-3">
              <input type="text" class="form-control" id="searchInput" placeholder="Cari data (Lokasi, Nomor Surat, Jenis Bencana, dll.)">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle" id="dataTable">
                    <thead>
                        <tr>
                            <th>Lokasi</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Terdampak</th>
                            <th>Kerusakan</th>
                            <th>Keterangan</th>
                            <th>Tgl Rekom</th>
                            <th>No Surat</th>
                            <th>Tgl Surat</th>
                            <th>OPD</th>
                            <th>Total Kerusakan</th>
                            <th>Total Kerugian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';

                        $sql = "SELECT * FROM data_bencana";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['lokasi']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jenis']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['terdampak']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['kerusakan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tgl_rekom']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['no_surat']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tgl_surat']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['opd']) . "</td>";
                                echo "<td>" . number_format($row['total_kerusakan'], 2) . "</td>";
                                echo "<td>" . number_format($row['total_kerugian'], 2) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>Belum ada data bencana.</td></tr>";
                        }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        function hitungTotal() {
            let t = parseFloat(document.getElementById('tinggi').value) || 0;
            let l = parseFloat(document.getElementById('lebar').value) || 0;
            let p = parseFloat(document.getElementById('panjang').value) || 0;
            let h = parseFloat(document.getElementById('harga').value) || 0;

            let volume = t * l * p;
            let totalKerusakan = volume;
            let totalKerugian = volume * h;

            document.getElementById('totalKerusakan').value = totalKerusakan.toFixed(2);
            document.getElementById('totalKerugian').value = totalKerugian.toFixed(2);
        }
        
        // Kode JavaScript untuk pencarian
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let keyword = this.value.toLowerCase();
            let tableRows = document.getElementById("dataTable").getElementsByTagName("tbody")[0].getElementsByTagName("tr");
            
            for (let i = 0; i < tableRows.length; i++) {
                let rowText = tableRows[i].textContent.toLowerCase();
                if (rowText.includes(keyword)) {
                    tableRows[i].style.display = ""; // Tampilkan baris
                } else {
                    tableRows[i].style.display = "none"; // Sembunyikan baris
                }
            }
        });

        function exportExcel() {
            let table = document.getElementById("dataTable");
            let wb = XLSX.utils.table_to_book(table, { sheet: "Data Bencana" });
            XLSX.writeFile(wb, "data_bencana.xlsx");
        }
    </script>
</body>
</html>