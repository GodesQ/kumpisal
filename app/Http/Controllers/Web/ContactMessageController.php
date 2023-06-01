<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\ContactMessage;

use App\Http\Requests\ContactMessage\CreateContactMessageRequest;

class ContactMessageController extends Controller
{
    public function store(CreateContactMessageRequest $request) {
        $data = $request->validated();
        $message = ContactMessage::create($data);
        if($message) return back()->with('success', 'Your Message Successfully Send.');
    }
}
