<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;

use App\Models\ContactMessage;

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

        if($request->ajax()) {
            $messages = ContactMessage::get();
            return Datatables::of($messages)
                    ->addIndexColumn()
                    ->addColumn('name', function($row) {
                        return $row->firstname . ' ' . $row->lastname;
                    })
                    ->addColumn('action', function($row) {
                        $btn = '<a href="/admin/contact_message/show/' .$row->id. '" class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>';
                        return $btn;
                    })
                    ->addColumn('created_at', function($row) {
                        return date_format(new \DateTime($row->created_at), 'F d, Y');
                    })
                    ->make(true);
        }
        return view('admin-page.contact-messages.list');
    }

    public function show(Request $request) {
        $message = ContactMessage::where('id', $request->id)->first();
        return view('admin-page.contact-messages.view', compact('message'));
    }
}
