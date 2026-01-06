# 🚀 Quick Start Guide - Melihat Hasil Aplikasi

## ⚡ Langkah-Langkah Setup

### ✅ Step 1: Install Dependencies (DONE)
```bash
composer install  # ✅ Complete
```

### ✅ Step 2: Environment Setup (DONE)
```bash
php artisan key:generate  # ✅ Complete
```

### 📝 Step 3: Setup Database

**Option A: Gunakan SQLite (Paling Mudah)**
1. Buka file `.env`
2. Ubah konfigurasi database menjadi:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=pendaftaran_santri
# DB_USERNAME=root
# DB_PASSWORD=
```

3. Create database file:
```bash
# Di PowerShell
New-Item database/database.sqlite -ItemType File
```

**Option B: Gunakan MySQL**
1. Pastikan MySQL sudah running
2. Buat database baru:
```sql
CREATE DATABASE pendaftaran_santri;
```

3. Buka file `.env`, pastikan:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pendaftaran_santri
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 📦 Step 4: Run Migrations
```bash
php artisan migrate
```

### 🔗 Step 5: Create Storage Link
```bash
php artisan storage:link
```

### 🎨 Step 6: Compile Assets

**Jika NPM terinstall:**
```bash
npm install
npm run dev
```

**Jika NPM TIDAK terinstall (Skip dulu):**
Assets CSS/JS tetap bisa jalan, tapi perlu manual link atau install Node.js dulu.

Download Node.js: https://nodejs.org/

### 🚀 Step 7: Run Development Server
```bash
php artisan serve
```

### 🌐 Step 8: Buka di Browser
Buka browser dan akses:
```
http://localhost:8000
```

---

## 📱 Halaman yang Bisa Diakses

### Public Pages (Tanpa Login)
- **Landing Page**: `http://localhost:8000/`
  - Hero section dengan countdown
  - Stats, features, timeline
  - Call-to-action buttons

- **Form Pendaftaran**: `http://localhost:8000/registration`
  - Multi-step form (5 steps)
  - Upload foto & dokumen
  - Real-time validation

- **Cek Status**: `http://localhost:8000/status`
  - Check registration status

### Admin Panel (Perlu Login)
- **Admin Login**: `http://localhost:8000/admin/login`
- **Dashboard**: `http://localhost:8000/admin/dashboard`
- **Data Santri**: `http://localhost:8000/admin/santri`

---

## 🐛 Troubleshooting

### Issue: Migration Error
```bash
# Clear cache dulu
php artisan config:clear
php artisan cache:clear

# Coba lagi
php artisan migrate
```

### Issue: Assets tidak load
Jika CSS/JS tidak muncul:

1. **Install Node.js** dari https://nodejs.org/
2. Setelah install, jalankan:
```bash
npm install
npm run dev
```

### Issue: File Upload Error
```bash
# Pastikan folder storage writable
chmod -R 775 storage bootstrap/cache  # Linux/Mac

# Windows: Klik kanan folder storage → Properties → Security → Edit → Full Control

# Create storage link
php artisan storage:link
```

---

## 📋 Checklist Sebelum Demo

- [ ] Composer install complete
- [ ] .env configured
- [ ] Database created  
- [ ] Migrations run successfully
- [ ] Storage link created
- [ ] Server running (`php artisan serve`)
- [ ] Browser opened to `http://localhost:8000`

---

## 🎯 Demo Flow

### 1. Landing Page
- Lihat hero section
- Scroll untuk lihat stats
- Lihat features & timeline

### 2. Registration Form
- Klik "Daftar Sekarang"
- Isi form multi-step
- Upload foto (optional jika ada file)
- Review data
- Submit

### 3. Admin Panel (Jika sudah ada user admin)
- Login ke `/admin/login`
- Lihat dashboard
- Manage data santri

---

## 💡 Tips

1. **Untuk development cepat**, gunakan SQLite (tidak perlu setup MySQL)
2. **Untuk testing**, bisa skip compile assets dulu
3. **Untuk production**, install semua dependencies lengkap

---

## 🎨 Preview Tanpa Setup

Jika ingin lihat tampilan CSS saja tanpa setup backend:

1. Buat file HTML sederhana
2. Link ke CSS files di `resources/css/`
3. Buka di browser

Atau tunggu setup selesai untuk pengalaman penuh! 🚀
