GoogleIPBlacklistController, Laravel uygulamaları için tasarlanmış, Google tarafından sağlanan IP adreslerini dinamik olarak doğrulayıp güvenli olmayanları tespit eden ve kara listeye ekleyen bir controller sınıfıdır.

Bu controller, RDNS (Reverse DNS) sorgularını kullanarak Google'a ait IP adreslerini doğrular ve sahte veya kötü amaçlı GoogleBot IP'lerini güvenilir bir şekilde engellemek için optimize edilmiştir.

Özellikler:
Google IP Listesi Çekme:
Google'ın resmi JSON dosyasından IP adreslerini otomatik olarak alır.

Subnet Hesaplama:
Belirli bir alt ağ maskesi kullanarak IP adreslerini alt ağ düzeyinde ayrıştırır ve listeye ekler.

RDNS Doğrulama:
IP adresleri üzerinde RDNS sorgusu yaparak hostname içerisinde "google" anahtar kelimesinin varlığını kontrol eder.

Kara Liste Yönetimi:
Doğrulanan IP adreslerini kara listeye ekler ve tekrar eden kayıtları atlar.

Kullanım Alanları:
GoogleBot Doğrulama:
Google'a ait olduğu iddia edilen sahte botları tespit etme ve engelleme.

Güvenlik Güçlendirme:
Sahte GoogleBot IP adreslerini kara listeye alarak sistem güvenliğini artırma.

Dinamik IP Yönetimi:
Güncel Google IP listelerine dayalı bir kara liste oluşturma ve yönetme.

Gereksinimler:
Laravel 8.x veya 9.x
Laravel'in modern sürümleriyle uyumludur.

Veritabanı Desteği:
Kara listeye eklenen IP adreslerini saklamak için veritabanı yapılandırması gereklidir.

Kurulum ve Kullanım:
1 Adım: Repoyu klonlayın.

git clone https://github.com/FetihAkgun/GoogleIPBlacklistController.git
cd GoogleIPBlacklistController
2.Adım: Laravel uygulamanızdaki Http/Controllers klasörüne GoogleIPBlacklistController dosyasını ekleyin.

3.Adım: Aşağıdaki route'u tanımlayın:

Route::get('/google-ip-blacklist', [GoogleIPBlacklistController::class, 'addGoogleIpsToBlacklist']);
4.Adım: IP doğrulama işlemini başlatmak için tarayıcıdan veya API istemcisinden ilgili endpoint'i çağırın:

http://your-domain.com/google-ip-blacklist
Örnek Çalışma Çıktısı:
Başarılı bir çalıştırma sonunda aşağıdaki gibi bir JSON çıktısı alabilirsiniz:

{
    "message": "Google IP'leri başarıyla işlendi.",
    "total_added": 25
}



