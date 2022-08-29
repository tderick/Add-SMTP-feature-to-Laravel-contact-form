<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:contact,0.5'
        ]);

        $requestData = $request->all();

        $contact = Contact::create($requestData);

        // Mail::to(env("ADMIN_EMAIL"))->send(new ContactMail($contact));
        Mail::to(env("ADMIN_EMAIL"))
            ->cc(env("SECOND_ADMIN"))
            ->bcc(env("THIRD_ADMIN"))
            ->send(new ContactMail($contact));

        return redirect('contact')->with("status", "Your message has been sent");
    }

    public function listMessages()
    {
        $messages = Contact::all();
        return view('list-messages', compact('messages'));
    }

    public function message_details($id)
    {
        $message = Contact::findOrFail($id);
        return view('details-message', compact('message'));
    }

    // public function delete_message($id)
    // {
    //     $message = Contact::find($id);

    //     if ($message) {
    //         $message->delete();
    //     }
    //     return redirect('/admin/view-messages');
    // }
    public function delete_message($id)
    {
        $message = Contact::find($id);

        if ($message) {
            $message->delete();
        }
        return response('Message delete successfully', 200);
    }

    public function deleteMultipleMessages(Request $request)
    {
        $ids = $request->get('selected');
        Contact::whereIn('id', $ids)->delete();
        return response("Selected messages have been deleted successfully", 200);
    }
}
