# Deploy — Siam Jumnum Landing (cPanel)

## Production URL

- **Site:** https://siamjumnum.charoencodegroup.com
- **Admin:** https://siamjumnum.charoencodegroup.com/admin/
- **cPanel user / FTP:** `zksqpszw` (same as [megawash](https://megawash.charoencodegroup.com))
- **Web root:** `/home/zksqpszw/public_html/siamjumnum.charoencodegroup.com`

## Requirements

- PHP 8.0+ (MultiPHP Manager → 8.3 for subdomain)
- Writable folders: `database/`, `uploads/`

## Deploy from Windows (PowerShell)

```powershell
cd siam_jumnum_landing_page
$env:FTP_HOST = "ps14.zwhhosting.com"
$env:FTP_USER = "zksqpszw"
$env:FTP_PASSWORD = "YOUR_CPANEL_PASSWORD"
$env:DEPLOY_TOKEN = "your-long-random-token"
.\scripts\deploy-cpanel.ps1
```

## GitHub Actions secrets

| Secret | Value |
|--------|--------|
| `FTP_HOST` | `ps14.zwhhosting.com` |
| `FTP_USER` | `zksqpszw` |
| `FTP_PASSWORD` | รหัสผ่าน cPanel |
| `DEPLOY_TOKEN` | สตริงลับยาว ๆ |

Push to `main` → workflow deploy อัตโนมัติ

## After first deploy

1. cPanel → **MultiPHP** → subdomain → PHP 8.3
2. สร้าง/แก้ `config/config.local.php` บนเซิร์ฟเวอร์ — เปลี่ยนรหัส admin
3. เปิด Force HTTPS + AutoSSL สำหรับ subdomain
4. ทดสอบ https://siamjumnum.charoencodegroup.com และ `/admin/`

## Checklist

- [ ] Subdomain `siamjumnum.charoencodegroup.com` ชี้ไป `public_html/siamjumnum.charoencodegroup.com`
- [ ] FTP secrets ตั้งใน GitHub (หรือรัน script local)
- [ ] เปลี่ยนรหัส admin ใน `config.local.php`
- [ ] เว็บโหลดได้ + รูป/แบนเนอร์ครบ
