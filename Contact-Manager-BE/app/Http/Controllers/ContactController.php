<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{
    public function addContact(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string',
        ]);
        $user = Auth::user();
        $id = $user->id;
        $contact= new Contact;
        $contact->name = $request->name;
        $contact->number= $request->number;
        $contact->altitude = $request->altitude;
        $contact->longitude = $request->longitude;
        $contact->user_id = $id;
        $contact->save();

        return response()->json([
            'status' => 'success',
            'message' => 'contact created successfully',
            'user' => $contact,
        ]);   
    }

    public function getAllContacts(){
        $contacts = Contact::all();
        return response()->json([
            'status' => 'success',
            'message' => 'contacts retieved',
            'user' => $contacts,
        ]);   
    }
    public function getUserContacts(){
        $user = Auth::user();
        $id = $user->id;
        $contacts = Contact::where('user_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'User contacts retrieved',
            'user' => $contacts,
        ]);   
    }
    
}
