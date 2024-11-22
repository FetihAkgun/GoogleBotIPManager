<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ApiModel;

class GoogleIpBlacklistController extends Controller
{
protected $adminModel;
protected $apiModel;

public function __construct()
{
$this->adminModel = new AdminModel();
$this->apiModel = new ApiModel();
}

public function addGoogleIpsToBlacklist()
{
try {

$jsonUrl = 'https://developers.google.com/static/search/apis/ipranges/googlebot.json';


$jsonData = file_get_contents($jsonUrl);
$data = json_decode($jsonData, true);

if (!isset($data['prefixes'])) {
return $this->response->setStatusCode(400)->setJSON(['error' => 'JSON verisi hatalı veya eksik.']);
}


$ipv4Prefixes = array_filter($data['prefixes'], function ($item) {
return isset($item['ipv4Prefix']);
});

$totalAdded = 0;

foreach ($ipv4Prefixes as $ipv4Prefix) {
$totalAdded += $this->processIpRange($ipv4Prefix['ipv4Prefix']);
}

return $this->response->setJSON([
'message' => "İşlem tamamlandı.",
'total_added' => $totalAdded
]);
} catch (\Exception $e) {
return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
}
}


private function processIpRange(string $ipv4): int
{
$ip = strtok($ipv4, '/');
$subnetMask = (int)str_replace($ip . '/', '', $ipv4);


$ipAddresses = $this->calculateIpAddresses($ip, $subnetMask);

$addedCount = 0;

foreach ($ipAddresses as $ipAddress) {

if (!$this->apiModel->checkIP($ipAddress)) {
$host = gethostbyaddr($ipAddress);
if (strpos($host, "google") !== false) {
$this->adminModel->addIptoblacklist([
'adress' => $ipAddress,
'admin_id' => 0, //default
'date' => time(),
]);
$addedCount++;
}
}
}

return $addedCount;
}


private function calculateIpAddresses(string $ip, int $subnetMask): array
{
$ipParts = array_map('intval', explode('.', $ip));
$networkAddress = $ipParts;
$ipAddresses = [];


for ($i = 0; $i < pow(2, (32 - $subnetMask)); $i++) {
    $ipAddresses[]=implode('.', $networkAddress);
    $networkAddress[3]++;
    for ($j=3; $j>= 0; $j--) {
    if ($networkAddress[$j] > 255) {
    $networkAddress[$j] = 0;
    $networkAddress[$j - 1]++;
    }
    }
    }

    return $ipAddresses;
    }
    }