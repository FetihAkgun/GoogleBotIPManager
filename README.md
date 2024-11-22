 <h1>GoogleIPBlacklistController</h1>
    <p>
        <strong>GoogleIPBlacklistController</strong>, Laravel uygulamaları için tasarlanmış, 
        Google tarafından sağlanan IP adreslerini dinamik olarak doğrulayıp güvenli olmayanları tespit eden ve 
        kara listeye ekleyen bir controller sınıfıdır.
    </p>
    <p>
        Bu controller, RDNS (Reverse DNS) sorgularını kullanarak Google'a ait IP adreslerini doğrular ve sahte veya kötü amaçlı 
        GoogleBot IP'lerini güvenilir bir şekilde engellemek için optimize edilmiştir.
    </p>
    <h2>Özellikler:</h2>
    <ul>
        <li><strong>Google IP Listesi Çekme:</strong> Google'ın resmi JSON dosyasından IP adreslerini otomatik olarak alır.</li>
        <li><strong>Subnet Hesaplama:</strong> Belirli bir alt ağ maskesi kullanarak IP adreslerini alt ağ düzeyinde ayrıştırır ve listeye ekler.</li>
        <li><strong>RDNS Doğrulama:</strong> IP adresleri üzerinde RDNS sorgusu yaparak hostname içerisinde "google" anahtar kelimesinin varlığını kontrol eder.</li>
        <li><strong>Kara Liste Yönetimi:</strong> Doğrulanan IP adreslerini kara listeye ekler ve tekrar eden kayıtları atlar.</li>
    </ul>
    <h2>Kullanım Alanları:</h2>
    <ul>
        <li><strong>GoogleBot Doğrulama:</strong> Google'a ait olduğu iddia edilen sahte botları tespit etme ve engelleme.</li>
        <li><strong>Güvenlik Güçlendirme:</strong> Sahte GoogleBot IP adreslerini kara listeye alarak sistem güvenliğini artırma.</li>
        <li><strong>Dinamik IP Yönetimi:</strong> Güncel Google IP listelerine dayalı bir kara liste oluşturma ve yönetme.</li>
    </ul>
    <h2>Gereksinimler:</h2>
    <ul>
        <li><strong>Laravel 8.x veya 9.x:</strong> Laravel'in modern sürümleriyle uyumludur.</li>
        <li><strong>Veritabanı Desteği:</strong> Kara listeye eklenen IP adreslerini saklamak için veritabanı yapılandırması gereklidir.</li>
    </ul>
    <h2>Kurulum ve Kullanım:</h2>
    <ol>
        <li>
            <strong>Adım:</strong> Repoyu klonlayın.
            <pre>
                git clone https://github.com/username/GoogleIPBlacklistController.git
                cd GoogleIPBlacklistController
            </pre>
        </li>
        <li>
            <strong>Adım:</strong> Laravel uygulamanızdaki <code>Http/Controllers</code> klasörüne 
            <code>GoogleIPBlacklistController</code> dosyasını ekleyin.
        </li>
        <li>
            <strong>Adım:</strong> Aşağıdaki route'u tanımlayın:
            <pre>
                Route::get('/google-ip-blacklist', [GoogleIPBlacklistController::class, 'addGoogleIpsToBlacklist']);
            </pre>
        </li>
        <li>
            <strong>Adım:</strong> IP doğrulama işlemini başlatmak için tarayıcıdan veya API istemcisinden ilgili endpoint'i çağırın:
            <pre>http://your-domain.com/google-ip-blacklist</pre>
        </li>
    </ol>
    <h2>Örnek Çalışma Çıktısı:</h2>
    <pre>
        {
            "message": "Google IP'leri başarıyla işlendi.",
            "total_added": 25
        }
    </pre>
