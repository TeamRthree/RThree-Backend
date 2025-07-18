<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryToClient;
use App\Mail\EnquiryToTeam;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        // ✅ Validate input
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'message'    => 'required|string',
            'selections' => 'required|array|min:1',
            'selections.*' => 'string',
        ]);

        // ✅ Save to database
        $enquiry = Enquiry::create($validated);

        // ✅ Send email to team
        Mail::to('marvelmarket888@gmail.com')->send(new EnquiryToTeam($enquiry));

        // ✅ Send confirmation to client
        Mail::to($enquiry->email)->send(new EnquiryToClient($enquiry));

        return response()->json([
            'message' => 'Enquiry submitted successfully.',
        ], 200);
    }
}
