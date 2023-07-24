<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactsReply;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        return view("admin.pages.contacts.index", [
            "contacts" => $contacts,
        ]);
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        $contact->update(['is_seen' => 1]);
        $contact_back = Contact::query()->where("id", "<", $id,)->orderBy("id", "desc")->first("id");
        $contact_next = Contact::where("id", ">", $id)->first("id");
        return view("admin.pages.contacts.detail", [
            "contact" => $contact,
            "contact_next" => $contact_next,
            "contact_back" => $contact_back,
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route("admin.contacts.index")->with("success", "Delete contact success");
    }

    public function reply(Request $request)
    {
        Mail::to($request->email)->queue(new ContactsReply($request->all()));
        return redirect()->route("admin.contacts.index")->with("success", "Send mail complete");
    }
}
