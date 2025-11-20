<?php
echo "=== TEST SIMPLE ===\n";

// Cek apakah symlink ada
$publicStorage = public_path('storage');
if (is_link($publicStorage)) {
    echo "✓ Symlink storage sudah ada\n";
} else {
    echo "✗ Symlink storage belum ada\n";
}

// Cek folder template-sambutan
$templateSambutanPath = storage_path('app/public/template-sambutan');
if (is_dir($templateSambutanPath)) {
    echo "✓ Folder template-sambutan sudah ada\n";
    $files = scandir($templateSambutanPath);
    $imageFiles = array_filter($files, function($file) {
        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']);
    });
    echo "File gambar: " . count($imageFiles) . " file\n";
    foreach($imageFiles as $file) {
        echo "- " . $file . "\n";
    }
} else {
    echo "✗ Folder template-sambutan belum ada\n";
}

echo "\n=== SELESAI ===\n";
