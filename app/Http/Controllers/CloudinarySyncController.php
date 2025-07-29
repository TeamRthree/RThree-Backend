<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Media;

class CloudinarySyncController extends Controller
{
    public function sync()
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        $mediaTypes = ['image', 'video'];

        foreach ($mediaTypes as $type) {
            $nextCursor = null;

            do {
                $url = "https://api.cloudinary.com/v1_1/{$cloudName}/resources/{$type}";
                $response = Http::withBasicAuth($apiKey, $apiSecret)
                    ->get($url, [
                        'max_results' => 100,
                        'next_cursor' => $nextCursor
                    ]);

                if (!$response->successful()) {
                    return response()->json(['error' => "Failed to fetch $type assets"], 500);
                }

                $data = $response->json();
                $assets = $data['resources'] ?? [];

                foreach ($assets as $asset) {
                    Media::updateOrCreate(
                        ['public_id' => $asset['public_id']],
                        [
                            'type' => $type,
                            'name' => pathinfo($asset['public_id'], PATHINFO_FILENAME),
                            'category' => $this->getCategoryFromPublicId($asset['public_id']),
                            'src' => $asset['secure_url'],
                        ]
                    );
                }

                $nextCursor = $data['next_cursor'] ?? null;

            } while ($nextCursor);
        }

        return response()->json(['message' => 'All media synced successfully']);
    }

    private function getCategoryFromPublicId($publicId)
    {
        $parts = explode('/', $publicId);
        return count($parts) > 1 ? $parts[0] : 'Uncategorized';
    }
}
