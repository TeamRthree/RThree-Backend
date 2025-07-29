<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Media;

class CloudinarySyncController extends Controller
{
    public function syncImages()
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/resources/image";

        $response = Http::withBasicAuth($apiKey, $apiSecret)->get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch from Cloudinary'], 500);
        }

        $assets = $response->json()['resources'];

        foreach ($assets as $asset) {
            Media::updateOrCreate(
                ['public_id' => $asset['public_id']],
                [
                    'type' => 'image',
                    'name' => pathinfo($asset['public_id'], PATHINFO_FILENAME),
                    'category' => $this->getCategoryFromPublicId($asset['public_id']),
                    'src' => $asset['secure_url'],
                ]
            );
        }

        return response()->json(['message' => 'Images synced successfully']);
    }

    private function getCategoryFromPublicId($publicId)
    {
        // Example: "socialMedia/Socialmediaposter-10" → category = "socialMedia"
        $parts = explode('/', $publicId);
        return count($parts) > 1 ? $parts[0] : 'Uncategorized';
    }
}
