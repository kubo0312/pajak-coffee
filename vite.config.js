import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import os from 'node:os';

// Ambil IPv4 non-internal supaya HMR tetap nyambung saat halaman dibuka
// dari HP atau laptop lain di jaringan yang sama.
function lanAddress() {
    // Urutkan supaya 192.168.x (WiFi/router rumahan) dipakai lebih dulu,
    // karena adapter VPN/Hyper-V (172.x) biasanya tidak terjangkau dari HP.
    const candidates = [];

    for (const list of Object.values(os.networkInterfaces())) {
        for (const net of list ?? []) {
            if (net.family === 'IPv4' && !net.internal) {
                candidates.push(net.address);
            }
        }
    }

    const preferred = candidates.find((ip) => ip.startsWith('192.168.'))
        ?? candidates.find((ip) => ip.startsWith('10.'))
        ?? candidates[0];

    return process.env.VITE_HMR_HOST || preferred || 'localhost';
}

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: lanAddress(),
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});