<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
session_start();
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use App\Models\Contact;

class ContactController extends Controller
{
    public function all_contact(){

        $all_contact = Contact::with('user')->orderBy('contact_id', 'desc')->get();
    
        return view('Admin.Contact.all-contact')
        ->with('all_contact', $all_contact);
    }

    public function detail_contact($id){
        
        $detail_contact = Contact::with('user')->where('contact_id', $id)->first();

        return view('Admin.Contact.detail-contact')
        ->with('detail_contact', $detail_contact);
    
    }

    public function update_isread($contactId)
    {
        $contact = Contact::find($contactId);
        if ($contact) {
            $contact->is_read = 1; 
            $contact->save();
        }
        return Redirect::to('Admin/all-contact');
    
    }
}
