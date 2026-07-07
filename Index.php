<?php
/**
 * Program Menampilkan Deret Bilangan
 */

// Fungsi untuk menampilkan deret bilangan ganjil
function deretGanjil($n) {
    $deret = [];
    for ($i = 1; $i <= $n * 2; $i += 2) {
        $deret[] = $i;
    }
    return $deret;
}

// Fungsi untuk menampilkan deret bilangan genap
function deretGenap($n) {
    $deret = [];
    for ($i = 2; $i <= $n * 2; $i += 2) {
        $deret[] = $i;
    }
    return $deret;
}

// Fungsi untuk menampilkan deret Fibonacci
function deretFibonacci($n) {
    $deret = [];
    if ($n >= 1) $deret[] = 0;
    if ($n >= 2) $deret[] = 1;
    
    for ($i = 2; $i < $n; $i++) {
        $deret[] = $deret[$i-1] + $deret[$i-2];
    }
    return $deret;
}

// Fungsi untuk mengecek bilangan prima
function isPrima($angka) {
    if ($angka < 2) return false;
    for ($i = 2; $i <= sqrt($angka); $i++) {
        if ($angka % $i == 0) return false;
    }
    return true;
}

// Fungsi untuk menampilkan deret bilangan prima
function deretPrima($n) {
    $deret = [];
    $angka = 2;
    while (count($deret) < $n) {
        if (isPrima($angka)) {
            $deret[] = $angka;
        }
        $angka++;
    }
    return $deret;
}

// Fungsi untuk menampilkan deret aritmatika
function deretAritmatika($a, $b, $n) {
    $deret = [];
    for ($i = 0; $i < $n; $i++) {
        $deret[] = $a + ($i * $b);
    }
    return $deret;
}

// Fungsi untuk menampilkan deret geometri
function deretGeometri($a, $r, $n) {
    $deret = [];
    for ($i = 0; $i < $n; $i++) {
        $deret[] = $a * pow($r, $i);
    }
    return $deret;
}

// Fungsi untuk menampilkan deret kuadrat
function deretKuadrat($n) {
    $deret = [];
    for ($i = 1; $i <= $n; $i++) {
        $deret[] = pow($i, 2);
    }
    return $deret;
}

// Fungsi untuk format deret menjadi string
function formatDeret($deret) {
    return implode(', ', $deret);
}

// Fungsi untuk menghitung jumlah deret
function jumlahDeret($deret) {
    return array_sum($deret);
}

// Fungsi untuk mencari nilai maksimum deret
function maxDeret($deret) {
    return max($deret);
}

// Fungsi untuk mencari nilai minimum deret
function minDeret($deret) {
    return min($deret);
}

// Fungsi untuk menghitung rata-rata deret
function rataRataDeret($deret) {
    if (count($deret) == 0) return 0;
    return array_sum($deret) / count($deret);
}

// Inisialisasi variabel
$hasil = null;
$deret = [];
$jenis_deret = '';
$jumlah_suku = 0;
$statistik = [];

// Proses form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_deret = $_POST['jenis_deret'] ?? '';
    $jumlah_suku = intval($_POST['jumlah_suku'] ?? 0);
    
    if ($jumlah_suku > 0 && $jumlah_suku <= 50) {
        switch ($jenis_deret) {
            case 'ganjil':
                $deret = deretGanjil($jumlah_suku);
                $judul = "Deret Bilangan Ganjil";
                $keterangan = "Menampilkan $jumlah_suku bilangan ganjil pertama";
                break;
                
            case 'genap':
                $deret = deretGenap($jumlah_suku);
                $judul = "Deret Bilangan Genap";
                $keterangan = "Menampilkan $jumlah_suku bilangan genap pertama";
                break;
                
            case 'fibonacci':
                $deret = deretFibonacci($jumlah_suku);
                $judul = "Deret Fibonacci";
                $keterangan = "Menampilkan $jumlah_suku bilangan Fibonacci pertama";
                break;
                
            case 'prima':
                $deret = deretPrima($jumlah_suku);
                $judul = "Deret Bilangan Prima";
                $keterangan = "Menampilkan $jumlah_suku bilangan prima pertama";
                break;
                
            case 'aritmatika':
                $suku_awal = intval($_POST['suku_awal'] ?? 1);
                $beda = intval($_POST['beda'] ?? 2);
                $deret = deretAritmatika($suku_awal, $beda, $jumlah_suku);
                $judul = "Deret Aritmatika";
                $keterangan = "Suku awal = $suku_awal, Beda = $beda, Jumlah suku = $jumlah_suku";
                break;
                
            case 'geometri':
                $suku_awal = intval($_POST['suku_awal'] ?? 1);
                $rasio = intval($_POST['rasio'] ?? 2);
                $deret = deretGeometri($suku_awal, $rasio, $jumlah_suku);
                $judul = "Deret Geometri";
                $keterangan = "Suku awal = $suku_awal, Rasio = $rasio, Jumlah suku = $jumlah_suku";
                break;
                
            case 'kuadrat':
                $deret = deretKuadrat($jumlah_suku);
                $judul = "Deret Bilangan Kuadrat";
                $keterangan = "Menampilkan $jumlah_suku bilangan kuadrat pertama (n²)";
                break;
                
            default:
                $deret = [];
                $judul = "";
                $keterangan = "Pilih jenis deret terlebih dahulu!";
        }
        
        // Hitung statistik jika deret tidak kosong
        if (!empty($deret)) {
            $statistik = [
                'jumlah' => jumlahDeret($deret),
                'max' => maxDeret($deret),
                'min' => minDeret($deret),
                'rata_rata' => rataRataDeret($deret),
                'banyak' => count($deret)
            ];
        }
    } else {
        $error = "Jumlah suku harus antara 1-50!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Deret Bilangan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
            font-size: 32px;
        }
        
        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 30px;
            font-size: 14px;
        }
        
        .form-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }
        
        .form-group {
            margin-bottom: 18px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
            font-size: 14px;
        }
        
        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .btn {
            padding: 12px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
        }
        
        .btn-primary {
            background: #667eea;
            color: white;
        }
        
        .btn-primary:hover {
            background: #5a6fd6;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .result-section {
            margin-top: 25px;
        }
        
        .result-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 12px 12px 0 0;
        }
        
        .result-header h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }
        
        .result-header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .result-body {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 12px 12px;
        }
        
        .deret-display {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 18px;
            word-wrap: break-word;
            min-height: 60px;
            border: 2px dashed #e0e0e0;
        }
        
        .deret-display .highlight {
            color: #667eea;
            font-weight: 600;
        }
        
        .statistik-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }
        
        .stat-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e0e0e0;
        }
        
        .stat-item .label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .stat-item .value {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-top: 4px;
        }
        
        .stat-item .value.primary {
            color: #667eea;
        }
        
        .stat-item .value.success {
            color: #27ae60;
        }
        
        .stat-item .value.danger {
            color: #e74c3c;
        }
        
        .stat-item .value.warning {
            color: #f39c12;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
        
        .empty-state .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #999;
            font-size: 12px;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin: 2px;
        }
        
        .badge-info {
            background: #e8edfd;
            color: #667eea;
        }
        
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 Program Deret Bilangan</h1>
        <p class="subtitle">Tampilkan berbagai jenis deret bilangan dengan mudah</p>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">❌ <?php echo $error; ?></div>
        <?php endif; ?>
        
        <!-- Form Pilihan Deret -->
        <div class="form-section">
            <form method="POST" action="" id="formDeret">
                <div class="form-group">
                    <label for="jenis_deret">📊 Pilih Jenis Deret</label>
                    <select name="jenis_deret" id="jenis_deret" required onchange="toggleOptions()">
                        <option value="">-- Pilih Jenis Deret --</option>
                        <option value="ganjil" <?php echo ($jenis_deret == 'ganjil') ? 'selected' : ''; ?>>Deret Bilangan Ganjil</option>
                        <option value="genap" <?php echo ($jenis_deret == 'genap') ? 'selected' : ''; ?>>Deret Bilangan Genap</option>
                        <option value="fibonacci" <?php echo ($jenis_deret == 'fibonacci') ? 'selected' : ''; ?>>Deret Fibonacci</option>
                        <option value="prima" <?php echo ($jenis_deret == 'prima') ? 'selected' : ''; ?>>Deret Bilangan Prima</option>
                        <option value="aritmatika" <?php echo ($jenis_deret == 'aritmatika') ? 'selected' : ''; ?>>Deret Aritmatika</option>
                        <option value="geometri" <?php echo ($jenis_deret == 'geometri') ? 'selected' : ''; ?>>Deret Geometri</option>
                        <option value="kuadrat" <?php echo ($jenis_deret == 'kuadrat') ? 'selected' : ''; ?>>Deret Bilangan Kuadrat</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="jumlah_suku">🔢 Jumlah Suku (1-50)</label>
                    <input type="number" name="jumlah_suku" id="jumlah_suku" 
                           value="<?php echo $jumlah_suku ?: 10; ?>" 
                           min="1" max="50" required>
                </div>
                
                <!-- Opsi tambahan untuk deret aritmatika -->
                <div id="opsi_aritmatika" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="suku_awal">Suku Awal (a)</label>
                            <input type="number" name="suku_awal" id="suku_awal" value="1">
                        </div>
                        <div class="form-group">
                            <label for="beda">Beda (b)</label>
                            <input type="number" name="beda" id="beda" value="2">
                        </div>
                    </div>
                </div>
                
                <!-- Opsi tambahan untuk deret geometri -->
                <div id="opsi_geometri" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="suku_awal">Suku Awal (a)</label>
                            <input type="number" name="suku_awal" id="suku_awal_geo" value="1">
                        </div>
                        <div class="form-group">
                            <label for="rasio">Rasio (r)</label>
                            <input type="number" name="rasio" id="rasio" value="2" min="1">
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">🚀 Tampilkan Deret</button>
            </form>
        </div>
        
        <!-- Hasil Deret -->
        <div class="result-section">
            <?php if (!empty($deret)): ?>
                <div class="result-header">
                    <h2><?php echo $judul; ?></h2>
                    <p><?php echo $keterangan; ?></p>
                </div>
                <div class="result-body">
                    <div class="deret-display">
                        <?php 
                        $deret_string = formatDeret($deret);
                        // Tandai setiap angka dengan warna berbeda
                        $angka_array = explode(', ', $deret_string);
                        $html = '';
                        foreach ($angka_array as $index => $angka) {
                            $color = ['#667eea', '#27ae60', '#e74c3c', '#f39c12', '#8e44ad', '#1abc9c'][$index % 6];
                            $html .= '<span style="color: ' . $color . '; font-weight: 600;">' . $angka . '</span>';
                            if ($index < count($angka_array) - 1) {
                                $html .= ', ';
                            }
                        }
                        echo $html;
                        ?>
                    </div>
                    
                    <!-- Statistik Deret -->
                    <div class="statistik-grid">
                        <div class="stat-item">
                            <div class="label">📊 Jumlah Suku</div>
                            <div class="value primary"><?php echo $statistik['banyak']; ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">💰 Jumlah Total</div>
                            <div class="value primary"><?php echo number_format($statistik['jumlah'], 0, ',', '.'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">📈 Nilai Tertinggi</div>
                            <div class="value success"><?php echo number_format($statistik['max'], 0, ',', '.'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">📉 Nilai Terendah</div>
                            <div class="value danger"><?php echo number_format($statistik['min'], 0, ',', '.'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="label">⚖️ Rata-rata</div>
                            <div class="value warning"><?php echo number_format($statistik['rata_rata'], 2, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="icon">🔢</div>
                    <h3>Belum Ada Deret</h3>
                    <p>Pilih jenis deret dan klik "Tampilkan Deret" untuk melihat hasil</p>
                    <p style="margin-top: 10px; font-size: 13px; color: #bbb;">
                        Contoh: Deret Ganjil, Genap, Fibonacci, Prima, Aritmatika, Geometri, Kuadrat
                    </p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="footer">
            <p></p>
            <p style="margin-top: 5px;">
                <span class="badge badge-info">7 Jenis Deret</span>
                <span class="badge badge-success">Interaktif</span>
            </p>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan/menyembunyikan opsi tambahan
        function toggleOptions() {
            const jenis = document.getElementById('jenis_deret').value;
            const opsiAritmatika = document.getElementById('opsi_aritmatika');
            const opsiGeometri = document.getElementById('opsi_geometri');
            
            // Sembunyikan semua opsi tambahan
            opsiAritmatika.style.display = 'none';
            opsiGeometri.style.display = 'none';
            
            // Tampilkan opsi sesuai jenis deret
            if (jenis === 'aritmatika') {
                opsiAritmatika.style.display = 'block';
            } else if (jenis === 'geometri') {
                opsiGeometri.style.display = 'block';
            }
        }
        
        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            toggleOptions();
        });
    </script>
</body>
</html>
