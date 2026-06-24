# Düzeltilmesi Gerekenler

## 1. Seeder — Duplicate Entry Hatası
`database/seeders/DatabaseSeeder.php` dosyasında `User::create()` ve `Branch::create()` kullanılıyor.
Seeder ikinci kez çalıştırıldığında aynı kayıt tekrar insert edilmeye çalışılıyor ve hata veriyor.

**Hata:**
```
SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'admin@eserspor.com'
```

**Çözüm:** `create()` yerine `firstOrCreate()` kullan. Kayıt varsa atlar, yoksa oluşturur.

---

## 2. Seeder — Çift Hash Sorunu (Admin Girişi Çalışmıyor)
`User` modelinde `'password' => 'hashed'` cast'i var.
Bu cast, şifre atanırken otomatik olarak `Hash::make()` çağırıyor.

Seeder'da ayrıca `Hash::make('admin123456')` yazılırsa şifre **iki kez hash'leniyor**.
DB'ye hash'in hash'i kaydediliyor → login'de `admin123456` eşleşmiyor → "E-posta veya şifre hatalı."

**Çözüm:** Seeder'da `Hash::make()` kullanma, düz string yaz. Cast halleder.

---

## 3. .env Dosyasına Admin Şifresi Ekle
Plesk'teki `.env` dosyasına şu satırı ekle:

```
ADMIN_PASSWORD=güçlü_bir_şifre_yaz
```

Eklenmezse default olarak `admin123456` kullanır.

---

## 4. Production'da Seeder Çalıştırma
Plesk gibi production ortamlarında `--force` bayrağı olmadan seeder çalışmaz.

```bash
php artisan db:seed --force
```

---

## Düzeltilmiş Dosya
`duzeltme/DatabaseSeeder.php` — doğru hali bu klasörde.
