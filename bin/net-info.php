<?php

/**
 * Cetak alamat yang bisa dipakai untuk membuka aplikasi dari perangkat lain.
 * Dipanggil otomatis oleh `composer serve:net`.
 */
$httpPort = 8000;
$vitePort = 5173;

$addresses = [];

if (function_exists('net_get_interfaces')) {
    foreach (net_get_interfaces() as $name => $iface) {
        foreach ($iface['unicast'] ?? [] as $entry) {
            $ip = $entry['address'] ?? '';

            // PHP di Windows mengembalikan family sebagai angka (AF_INET = 2),
            // jadi lebih aman cek bentuk alamatnya langsung.
            if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                continue;
            }
            if (str_starts_with($ip, '127.') || str_starts_with($ip, '169.254.')) {
                continue;
            }

            $addresses[$ip] = $iface['description'] ?? $name;
        }
    }
}

// Jaringan rumahan (192.168.x) didahulukan, biasanya itu yang dipakai HP.
uksort($addresses, fn ($a, $b) => str_starts_with($b, '192.168.') <=> str_starts_with($a, '192.168.'));

if ($addresses === []) {
    $addresses['192.168.x.x'] = 'ip-lokal';
}

$line = str_repeat('-', 54);

echo "\n$line\n";
echo " Pajak Coffee - siap dibuka dari jaringan lokal\n";
echo "$line\n";
echo "  Laptop ini   : http://127.0.0.1:$httpPort\n";

foreach ($addresses as $ip => $iface) {
    echo "  Jaringan LAN : http://$ip:$httpPort   ($iface)\n";
}

$first = array_key_first($addresses);
echo "  Vite / HMR   : http://$first:$vitePort\n";
echo "$line\n";
echo " Kalau perangkat lain tidak bisa connect, izinkan port $httpPort\n";
echo " di Windows Firewall untuk php.exe (butuh hak admin).\n";
echo " Hentikan semuanya dengan Ctrl+C.\n";
echo "$line\n\n";