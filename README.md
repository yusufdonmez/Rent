# Rent
Rent Car otomasyon güvenli yazılım için site denemesi PHP


PHP, HTML  ve javascript kullanılarak bir WEB uygulaması deneyimi
MySQL veritabanı kullanılır.
Login, anasayfa, Kullanıcı işlemleri, Araç işlemleri sayfalarından olusur.
3 yetki düzeyi bulunur. (yonetici, calisan, musteri)
yonetici işlemleri login, kullanıcı ekleme-silme-güncelleme, araç ekleme-silme-güncelleme-arama
calisan işlemleri login,  araç ekleme-silme-güncelleme-arama
musteri işlemleri login, araç arama

araç ve kullanıcı güncellemelerinde AJAX kullanılmıştır.

OWASP top 10 içinden ilk 3 zafiyet bulunması hedeflenmiştir.
injection
session management
XSS
------
' or '1'='1'

kodu username ve password olarak girilmesi durumunda oturum açılıyor.
------
$_SESSION['yetki'] ile tutuldugundan şifreleme olmadıgı için otorum değişkenleri kopyalanıp
yetki taklidi ile işlem yapılabilir.

------
<script>alert('uyarı');</script>

kodunu kullanıcı ekleme ekranındaki kutucuklara eklenmesi ile javascript kodu ekleniyor
Her sayfa yenilenmesi uyarı görünüyor.
