<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $cloudinary = $request->all();

        $publicId = $cloudinary['public_id'] ?? '';
        $url = $cloudinary['secure_url'] ?? '';

        if (!$publicId || !$url) {
            return response()->json(['error' => 'Missing data'], 422);
        }

        $parts = explode('/', $publicId); // eg: ['socialMedia', 'Socialmediaposter-10']
        $category = $parts[0] ?? 'Uncategorized';
        $fileName = $parts[1] ?? 'Unnamed';
        $name = str_replace(['-', '_'], ' ', $fileName);

        $media = new Media();
        $media->type = 'image'; // or 'video' if you handle videos later
        $media->name = $name;
        $media->category = $category;
        $media->src = $url;
        $media->save();

        return response()->json(['message' => 'Saved', 'data' => $media]);
    }

    public function index()
    {
        return Media::all();
    }
}

