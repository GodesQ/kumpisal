<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Models\ContactMessage;
use App\Models\ContactMessageReply;

use App\Http\Requests\ContactMessage\CreateContactMessageRequest;

use App\Mail\ContactMessageMail;
use DataTables;

class ContactMessageController extends Controller
{
    public function store(CreateContactMessageRequest $request) {
        $data = $request->validated();
        $message = ContactMessage::create($data);

        # details for sending email to worker
        $details = [
            'title' => 'CONTACT MESSAGE - KUMPISALAN',
            'email' => $message->email,
            'name' => $message->firstname . ' ' . $message->lastname,
        ];

        // SEND EMAIL FOR VERIFICATION
        $send_mail = Mail::to(env('SUPPORT_EMAIL'))->send(new ContactMessageMail($details, $message));

        if($message) return back()->with('success', 'Your Message Successfully Send.');
    }

    public function lists(Request $request) {
        $messages = ContactMessage::latest()->paginate(9);

        return view('admin-page.contact-messages.list', compact('messages'));
    }

    public function show(Request $request) {
        $message = ContactMessage::where('id', $request->id)->first();

        $message_view = view('admin-page.contact-messages.message', compact('message'))->render();
        return response($message_view, 200);
    }

    public function reply_messages(Request $request) {
        $messages = ContactMessageReply::where('reply_to', $request->id)->with('admin')->get();
        $messages_view = view('admin-page.contact-messages.replies', compact('messages'))->render();

        return response($messages_view, 200);
    }

    public function store_reply(Request $request) {
        $reply = ContactMessageReply::create([
            'reply_to' => $request->reply_to,
            'reply_from' => Auth::guard('admin')->user()->id,
            'custom_subject' => $request->custom_subject,
            'message' => $request->message,
        ]);

        if($reply) return response([
            'status' => 'create',
            'message' => 'Reply Successfully'
        ], 201);
    }
}
