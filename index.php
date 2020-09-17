<?php

$options = stream_context_create([
    'http' => ['timeout' => 2]
]);

$seedEndpoint = 'https://chaosnet-seed.thorchain.info/';

$seeds = json_decode(file_get_contents($seedEndpoint), true);

foreach ($seeds as $seedIp) {
    $data = @json_decode(file_get_contents('http://' . $seedIp . ':8080/v1/health', false, $options), true);
    $scannerHeight = $data['scannerHeight'] ?? 'no response';
    print "$seedIp : " . $scannerHeight . " <br>";
}