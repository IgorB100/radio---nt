<?php
header("Content-Type: text/plain; charset=utf-8");

// URL твого потоку
$url = "http://127.0.0.1:8000/7.html";

// Використовуємо CURL, бо Shoutcast блокує file_get_contents()
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Маскуємось під браузер (важливо!)
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$data = curl_exec($ch);
curl_close($ch);

// Якщо не вдалося отримати дані
if (!$data) {
    echo "Невідомо";
    exit;
}

// Прибираємо теги <html> <body> <script> тощо
$data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $data);
$data = strip_tags($data);

// Конвертуємо у UTF-8
$data = mb_convert_encoding($data, "UTF-8", "Windows-1251,CP1251,UTF-8");

// Розбиваємо CSV
$parts = explode(",", trim($data));

// Беремо назву треку (позиція 6)
$title = isset($parts[6]) ? trim($parts[6]) : "Невідомо";

echo $title;
?>