<?php

namespace Tests\Unit;

use App\Services\ImageCompressor;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageCompressorTest extends TestCase
{
    public function test_it_compresses_and_resizes_uploaded_images_to_webp(): void
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('product.jpg', 2400, 1600);
        $path = app(ImageCompressor::class)->store($image, 'products', 1200, 1200, 80);

        Storage::disk('public')->assertExists($path);

        [$width, $height, $type] = getimagesize(Storage::disk('public')->path($path));

        $this->assertStringEndsWith('.webp', $path);
        $this->assertSame(1200, $width);
        $this->assertSame(800, $height);
        $this->assertSame(IMAGETYPE_WEBP, $type);
    }
}
