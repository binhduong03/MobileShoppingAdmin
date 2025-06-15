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
}
