
## Quick Start

1. Clone repo `git clone https://github.com/sutodiryo/DetikCom.git`.
2. Silahkan buka terminal lalu navigate ke project folder.
3. Pastikan di device anda terinstall php 7.3^ & mysql, lalu silahkan buat database mysql baru dengan nama db_detik
4. Pastikan konfigurasi `host, database_name, username, password` di dalam file `config/db.php` sudah sesuai
3. Lalu run server => `php -S 127.0.0.1:8080`
4. Dokumentasi API Create Transaksi Pembayaran => <https://documenter.getpostman.com/view/21539668/2s847Fvtpy#1fc99c8b-ea9e-459a-a2f3-524cb9f47f0c> 
5. Dokumentasi API Mengecek Status Transaksi Pembayaran => <https://documenter.getpostman.com/view/21539668/2s847Fvtpy#2e83b020-bde2-4916-9757-7e251d2ac110>
6. Contoh update dengan CLI => `php transaction-update.php 16660899694495 Paid`