<?php
function product_image_src($imageUrl, $prefix = '')
{
    $imageUrl = trim((string) $imageUrl);

    if ($imageUrl === '') {
        return '';
    }

    if (preg_match('/^https?:\/\//i', $imageUrl)) {
        return $imageUrl;
    }

    $filename = basename(str_replace('\\', '/', $imageUrl));

    return $prefix . 'assets/images/' . rawurlencode($filename);
}

function product_image_filename_from_upload($fieldName, &$error = null)
{
    if (empty($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
        $error = 'Image upload failed. Please try again.';
        return false;
    }

    $allowedTypes = array(
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif'
    );

    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($fileInfo, $_FILES[$fieldName]['tmp_name']);
    finfo_close($fileInfo);

    if (!isset($allowedTypes[$mimeType])) {
        $error = 'Please upload a JPG, PNG, WEBP, or GIF image.';
        return false;
    }

    $uploadDir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $baseName = pathinfo($_FILES[$fieldName]['name'], PATHINFO_FILENAME);
    $baseName = preg_replace('/[^a-zA-Z0-9_-]+/', '-', strtolower($baseName));
    $baseName = trim($baseName, '-');

    if ($baseName === '') {
        $baseName = 'product';
    }

    $filename = $baseName . '-' . uniqid() . '.' . $allowedTypes[$mimeType];
    $destination = $uploadDir . DIRECTORY_SEPARATOR . $filename;

    if (!move_uploaded_file($_FILES[$fieldName]['tmp_name'], $destination)) {
        $error = 'Could not save the uploaded image.';
        return false;
    }

    return $filename;
}
