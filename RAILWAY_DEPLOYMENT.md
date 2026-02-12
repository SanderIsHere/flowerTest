# Laravel Movie List - Railway Deployment Guide

## File yang Dibuat untuk Railway
Saya telah membuat file-file berikut untuk memperbaiki error 502:

1. **Procfile** - Memberitahu Railway cara menjalankan aplikasi
2. **nixpacks.toml** - Konfigurasi build dan deployment
3. **Updated .env.example** - Template environment variables untuk production

## Langkah Deploy ke Railway

### 1. Commit dan Push Perubahan ke GitHub
```bash
git add Procfile nixpacks.toml .env.example
git commit -m "Add Railway deployment configuration"
git push origin main
```

### 2. Set Environment Variables di Railway Dashboard
Buka Railway dashboard > Pilih project Anda > Settings > Variables

**WAJIB Set Variables Berikut:**
```
APP_NAME=MovieList
APP_ENV=production
APP_KEY=base64:XXXXX  # Generate dengan: php artisan key:generate --show
APP_DEBUG=false
APP_URL=https://your-app.up.railway.app  # Ganti dengan URL Railway Anda

DB_CONNECTION=sqlite

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

LOG_CHANNEL=stack

OMDB_API_KEY=your_omdb_api_key_here  # Jika aplikasi butuh OMDB API
```

**Cara Generate APP_KEY:**
Di lokal, jalankan:
```bash
cd movieList
php artisan key:generate --show
```
Copy hasilnya (contoh: `base64:xyz123abc...`) dan paste ke Railway.

### 3. Redeploy Aplikasi
Setelah push ke GitHub, Railway akan otomatis redeploy. Atau manual redeploy:
- Railway Dashboard > Deployments > Klik "Redeploy"
- Tunggu hingga status "Active" atau "Success"

### 4. Akses Aplikasi
- Buka tab **Settings** > **Domains** di Railway
- Copy URL (format: `https://your-app.up.railway.app`)
- Akses URL tersebut di browser

## Troubleshooting Jika Masih Error

### Cek Logs di Railway
Railway Dashboard > Deployments > Klik deployment terbaru > Tab **Logs**

**Error Umum:**
1. **"APP_KEY not set"**
   - Pastikan `APP_KEY` sudah di-set di Variables
   - Generate dengan `php artisan key:generate --show`

2. **"Database connection failed"**
   - Jika pakai SQLite (default), pastikan `DB_CONNECTION=sqlite` di Variables
   - Jika pakai MySQL/PostgreSQL, tambahkan Database dari Railway Marketplace

3. **"Port already in use"**
   - Railway otomatis set `$PORT` variable, pastikan Procfile menggunakan `--port=$PORT`

4. **Build Failed**
   - Periksa logs untuk error dependencies
   - Jalankan `composer install` di lokal untuk memastikan tidak ada conflict

### Database Migration
Jika aplikasi butuh database tables:
- Di Railway, tambahkan command di **Settings** > **Deploy**:
  ```
  php artisan migrate --force
  ```
- Atau jalankan manual di Railway console

## Catatan Penting
- Railway free tier: $5 kredit/bulan (cukup untuk demo)
- Aplikasi sleep setelah tidak aktif, tapi auto-wake saat ada request
- Pastikan semua environment variables sudah di-set sebelum deploy
- File `.env` tidak di-commit ke GitHub (aman)

## Kontak & Support
Jika masih ada masalah, screenshot error logs dari Railway dan tanyakan!
