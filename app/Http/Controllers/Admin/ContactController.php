<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        $unreadCount = Contact::unread()->count();
        return view('admin.contact.index', compact('contacts', 'unreadCount'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();
        return view('admin.contact.show', compact('contact'));
    }

    public function markRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();
        return redirect()->back()->with('success', 'Mesaj okundu olarak işaretlendi.');
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.contact.index')
                         ->with('success', 'Mesaj silindi.');
    }
}