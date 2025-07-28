<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\File;


class UploadImagesToCloudinary extends Command
{
    protected $signature = 'cloudinary:upload-images';
    protected $description = 'Upload all images to Cloudinary from public/images subfolders';

    public function handle()
    {
        $baseDir = public_path('images');
        $subfolders = ['logos', 'package', 'posters','socialMedia', 'website'];

        foreach ($subfolders as $folder) {
            $path = $baseDir . '/' . $folder;
            if (!File::exists($path)) {
                $this->warn("Folder not found: $folder");
                continue;
            }

            $files = File::allFiles($path);

            foreach ($files as $file) {
                $this->info("Uploading: {$file->getFilename()} from $folder...");

                $result = Cloudinary::upload($file->getRealPath(), [
                    'folder' => "images/$folder"
                ])->getSecurePath();

                $this->line("✅ Uploaded to: $result");
            }
        }

        $this->info('🎉 All uploads completed!');
    }
}
