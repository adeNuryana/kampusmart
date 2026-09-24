<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ImageCompressor
{
    public function store(
        UploadedFile $file,
        string $directory,
        int $maxWidth = 1600,
        int $maxHeight = 1600,
        int $quality = 82,
    ): string {
        $sourcePath = $file->getRealPath();
        $imageInfo = $sourcePath ? @getimagesize($sourcePath) : false;

        if (! $sourcePath || ! $imageInfo) {
            throw new RuntimeException('File gambar tidak dapat dibaca.');
        }

        [$sourceWidth, $sourceHeight, $imageType] = $imageInfo;

        if ($sourceWidth < 1 || $sourceHeight < 1 || ($sourceWidth * $sourceHeight) > 36_000_000) {
            throw new RuntimeException('Dimensi gambar terlalu besar untuk diproses.');
        }

        $contents = file_get_contents($sourcePath);
        $sourceImage = $contents === false ? false : @imagecreatefromstring($contents);

        if ($sourceImage === false) {
            throw new RuntimeException('Format gambar tidak didukung.');
        }

        if ($imageType === IMAGETYPE_JPEG) {
            $sourceImage = $this->orientJpeg($sourceImage, $sourcePath);
        }

        $sourceWidth = imagesx($sourceImage);
        $sourceHeight = imagesy($sourceImage);
        $scale = min(1, $maxWidth / $sourceWidth, $maxHeight / $sourceHeight);
        $targetWidth = max(1, (int) round($sourceWidth * $scale));
        $targetHeight = max(1, (int) round($sourceHeight * $scale));

        $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);

        if ($targetImage === false) {
            imagedestroy($sourceImage);

            throw new RuntimeException('Gambar gagal diproses.');
        }

        imagealphablending($targetImage, false);
        imagesavealpha($targetImage, true);
        $transparent = imagecolorallocatealpha($targetImage, 0, 0, 0, 127);
        imagefilledrectangle($targetImage, 0, 0, $targetWidth, $targetHeight, $transparent);

        imagecopyresampled(
            $targetImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $sourceWidth,
            $sourceHeight,
        );

        ob_start();
        $encoded = imagewebp($targetImage, null, max(1, min(100, $quality)));
        $webpContents = ob_get_clean();

        imagedestroy($targetImage);
        imagedestroy($sourceImage);

        if (! $encoded || ! is_string($webpContents)) {
            throw new RuntimeException('Gambar gagal dikompres.');
        }

        $path = trim($directory, '/') . '/' . Str::uuid() . '.webp';

        if (! Storage::disk('public')->put($path, $webpContents)) {
            throw new RuntimeException('Gambar gagal disimpan.');
        }

        return $path;
    }

    private function orientJpeg(mixed $image, string $path): mixed
    {
        if (! function_exists('exif_read_data')) {
            return $image;
        }

        $exif = @exif_read_data($path);
        $orientation = (int) ($exif['Orientation'] ?? 1);

        if (in_array($orientation, [2, 4, 5, 7], true)) {
            imageflip($image, in_array($orientation, [2, 5], true) ? IMG_FLIP_HORIZONTAL : IMG_FLIP_VERTICAL);
        }

        $angle = match ($orientation) {
            3, 4 => 180,
            5, 6 => -90,
            7, 8 => 90,
            default => 0,
        };

        if ($angle === 0) {
            return $image;
        }

        $rotatedImage = imagerotate($image, $angle, 0);

        if ($rotatedImage === false) {
            return $image;
        }

        imagedestroy($image);

        return $rotatedImage;
    }
}
