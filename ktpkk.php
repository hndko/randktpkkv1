<?php

class KtpGenerator
{

    // Administrative codes (Simplified subset for demo purposes)
    private $regions = [
        '11' => ['name' => 'ACEH', 'cities' => ['01' => 'KAB. ACEH SELATAN', '71' => 'KOTA BANDA ACEH']],
        '12' => ['name' => 'SUMATERA UTARA', 'cities' => ['71' => 'KOTA MEDAN', '75' => 'KOTA BINJAI']],
        '13' => ['name' => 'SUMATERA BARAT', 'cities' => ['71' => 'KOTA PADANG', '75' => 'KOTA BUKITTINGGI']],
        '31' => ['name' => 'DKI JAKARTA', 'cities' => [
            '71' => 'JAKARTA SELATAN',
            '72' => 'JAKARTA TIMUR',
            '73' => 'JAKARTA PUSAT',
            '74' => 'JAKARTA BARAT',
            '75' => 'JAKARTA UTARA'
        ]],
        '32' => ['name' => 'JAWA BARAT', 'cities' => ['73' => 'KOTA BANDUNG', '75' => 'KOTA BEKASI', '76' => 'KOTA DEPOK']],
        '33' => ['name' => 'JAWA TENGAH', 'cities' => ['74' => 'KOTA SEMARANG', '72' => 'KOTA SURAKARTA']],
        '34' => ['name' => 'DI YOGYAKARTA', 'cities' => ['71' => 'KOTA YOGYAKARTA', '04' => 'SLEMAN']],
        '35' => ['name' => 'JAWA TIMUR', 'cities' => ['78' => 'KOTA SURABAYA', '73' => 'KOTA MALANG']],
        '51' => ['name' => 'BALI', 'cities' => ['71' => 'KOTA DENPASAR']],
        '73' => ['name' => 'SULAWESI SELATAN', 'cities' => ['71' => 'KOTA MAKASSAR']],
    ];

    public function generateNIK($gender = null, $customDob = null)
    {
        // 1. Pick Region
        $provCode = array_rand($this->regions);
        $cityCode = array_rand($this->regions[$provCode]['cities']);
        $distCode = str_pad(rand(1, 20), 2, '0', STR_PAD_LEFT); // Fake district

        // 2. Date of Birth
        if ($customDob) {
            $dob = strtotime($customDob);
        } else {
            // Random date between 17 and 60 years ago
            $age = rand(17, 60);
            $dob = strtotime("-$age years");
        }

        $day = date('d', $dob);
        $month = date('m', $dob);
        $year = date('y', $dob);

        // 3. Gender Logic (Females add 40 to day)
        if ($gender === null) {
            $gender = rand(0, 1) ? 'M' : 'F';
        }

        if ($gender === 'F') {
            $day += 40;
        }

        // 4. Random Serial (0001 - 9999)
        $serial = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        $nik = $provCode . $cityCode . $distCode . $day . $month . $year . $serial;

        return [
            'nik' => $nik,
            'region' => $this->regions[$provCode]['name'] . ' - ' . $this->regions[$provCode]['cities'][$cityCode],
            'gender' => $gender == 'M' ? 'Laki-laki' : 'Perempuan',
            'dob' => date('d-m-Y', $dob)
        ];
    }

    public function generateKK($provCode = null)
    {
        // KK format similar structure but different date logic (usually date of issuance)
        if (!$provCode) {
            $provCode = array_rand($this->regions);
        }
        $cityCode = array_rand($this->regions[$provCode]['cities']);
        $distCode = str_pad(rand(1, 20), 2, '0', STR_PAD_LEFT);

        // Date of issuance (Random recent date)
        $date = date('dmy', strtotime("-" . rand(0, 1000) . " days"));
        $serial = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        return $provCode . $cityCode . $distCode . $date . $serial;
    }

    public function run()
    {
        $this->clearScreen();
        $this->printHeader();

        while (true) {
            echo "\n\033[1;33m[ MENU UTAMA ]\033[0m\n";
            echo "1. Generate 1 Pair (NIK & KK)\n";
            echo "2. Generate Bulk Pairs\n";
            echo "3. About & Disclaimer\n";
            echo "0. Exit\n";
            echo "\n\033[1;32mPilihan > \033[0m";

            $handle = fopen("php://stdin", "r");
            $line = fgets($handle);
            $choice = trim($line);

            if ($choice == '1') {
                $this->showSingle();
            } elseif ($choice == '2') {
                echo "Jumlah data: ";
                $qty = trim(fgets($handle));
                $this->showBulk($qty);
            } elseif ($choice == '3') {
                $this->showAbout();
            } elseif ($choice == '0') {
                echo "\nExiting...\n";
                exit;
            } else {
                echo "\nInvalid choice.\n";
            }
        }
    }

    private function showSingle()
    {
        $data = $this->generateNIK();
        $kk = $this->generateKK(substr($data['nik'], 0, 2));

        echo "\n\033[1;36m[ RESULT ]\033[0m\n";
        echo "NIK    : " . $data['nik'] . "\n";
        echo "KK     : " . $kk . "\n";
        echo "Detail : " . $data['region'] . " | " . $data['gender'] . " | " . $data['dob'] . "\n";
        echo "--------------------------------------------------\n";
    }

    private function showBulk($qty)
    {
        echo "\n\033[1;36m[ BULK RESULT - $qty Data ]\033[0m\n";
        for ($i = 0; $i < $qty; $i++) {
            $data = $this->generateNIK();
            $kk = $this->generateKK(substr($data['nik'], 0, 2));
            echo $data['nik'] . " | " . $kk . "\n";
        }
        echo "\nSuccess generated $qty data.\n";
    }

    private function showAbout()
    {
        $this->clearScreen();
        $this->printHeader();
        echo "\n\033[1;31m[ IMPORTANT DISCLAIMER ]\033[0m\n";
        echo "Tools ini hanya untuk tujuan EDUKASI dan TESTING (Dummy Data).\n";
        echo "Data yang dihasilkan adalah random matematis dan TIDAK TERDAFTAR di Dukcapil.\n";
        echo "Dilarang keras menyalahgunakan untuk tindakan kriminal/ilegal.\n\n";
        echo "Tekan Enter untuk kembali...";
        fgets(fopen("php://stdin", "r"));
        $this->clearScreen();
        $this->printHeader();
    }

    private function printHeader()
    {
        echo "\033[1;34m";
        echo "==================================================\n";
        echo "      GENERATOR IDENTITAS DUMMY (KTP & KK)        \n";
        echo "         Powerfull & Unlimited Generator          \n";
        echo "         Recode by Z3R0-K x Mari Partner          \n";
        echo "==================================================\n";
        echo "\033[0m";
    }

    private function clearScreen()
    {
        // Basic clear for typical terminals
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');
        } else {
            system('clear');
        }
    }
}

// Run App
$app = new KtpGenerator();
$app->run();
