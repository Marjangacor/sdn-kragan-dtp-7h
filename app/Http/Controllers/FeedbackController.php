<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'in:pembelajaran,fasilitas,pelayanan_administrasi,lainnya'],
            'type' => ['required', 'in:saran,kritik,pujian'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        Feedback::create($data);

        return back()->with('success', 'Terima kasih atas feedback Anda. Tim kami akan segera membacanya.');
    }
}
