# Siam Jumnum Landing Page

เว็บแลนดิ้งเพจสำหรับ **สยามจำนำ** — ศูนย์รับจำนำเพชรเม็ดใหญ่ และสินค้าแบรนด์เนม ครบวงจร

ออกแบบใหม่ให้มีความหรูหรา ทันสมัย แบบ Parallax พร้อมระบบจัดการเนื้อหา (CMS) หลังบ้าน

## คุณสมบัติ

- **Landing Page แบบ Parallax** — Hero carousel, parallax sections, scroll animations
- **แบนเนอร์โชว์ร้าน** — Swiper carousel พร้อม fade effect
- **สินค้า Carousel + Grid** — แสดงสินค้าแบบ carousel และรายการ grid ด้านล่าง
- **โปรโมชั่น/ข่าวสาร** — การ์ดโปรโมชั่นสวยงาม
- **ฟอร์มประเมินราคา** — ส่งคำขอผ่าน Line
- **Admin CMS** — จัดการแบนเนอร์, สินค้า, โปรโมชั่น
- **Responsive** — รองรับมือถือและแท็บเล็ต

## เทคโนโลยี

- PHP 8+ (JSON file storage — ไม่ต้องติดตั้ง database)
- Swiper.js (carousel)
- Google Fonts (Cormorant Garamond + Inter)
- CSS Custom Properties

## การติดตั้ง

### ความต้องการ

- PHP 8.0 ขึ้นไป
- Apache/Nginx หรือ PHP built-in server

### รันด้วย PHP Built-in Server

```bash
cd siam_jumnum_landing_page
php -S localhost:8000 router.php
```

เปิดเบราว์เซอร์:
- **เว็บไซต์:** http://localhost:8000
- **Admin CMS:** http://localhost:8000/admin/

### รันด้วย Apache/XAMPP

1. วางโฟลเดอร์ใน `htdocs`
2. เปิด http://localhost/siam_jumnum_landing_page/

## Admin CMS

| รายการ | ค่าเริ่มต้น |
|--------|------------|
| URL | `/admin/` |
| Username | `admin` |
| Password | `admin123` |

> **สำคัญ:** เปลี่ยนรหัสผ่านใน `config/config.php` ก่อน deploy production

### จัดการเนื้อหา

- **แบนเนอร์** — Hero slides บนหน้าแรก
- **สินค้า** — รายการสินค้า (เพชร/นาฬิกา/กระเป๋า)
- **โปรโมชั่น** — ข่าวสารและโปรโมชั่น

## โครงสร้างโปรเจกต์

```
├── index.php              # หน้า Landing Page
├── config/config.php      # การตั้งค่า
├── includes/              # PHP includes
├── admin/                 # CMS หลังบ้าน
├── assets/css/style.css   # Styles
├── assets/js/main.js      # JavaScript
├── database/content.json  # ข้อมูลเนื้อหา (auto-created)
└── uploads/               # รูปภาพที่อัปโหลด
```

## Sections บนหน้าเว็บ

1. Hero Banner Carousel
2. Quick Services (นาฬิกา / เพชร / กระเป๋า)
3. เกี่ยวกับเรา + Features
4. บริการของเรา
5. Parallax Showcase (โชว์ร้าน)
6. สินค้า Carousel (filter ได้)
7. สินค้า Grid
8. วิธีการจำนำ (3 ขั้นตอน)
9. ฟอร์มประเมินราคา
10. ข่าวสารโปรโมชั่น
11. Brands Marquee
12. Footer + ติดต่อ

## ข้อมูลติดต่อ (จากเว็บเดิม)

- โทร: 085 200 1010
- อีเมล: info@siamjumnum.com
- เวลา: จ-อา 10:00 - 18:00 น.
