<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function form()
    {
        return view('frontend.contact.form');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required'    => 'Ad soyad zorunludur.',
            'email.required'   => 'E-posta zorunludur.',
            'email.email'      => 'Geçerli bir e-posta girin.',
            'subject.required' => 'Konu zorunludur.',
            'message.required' => 'Mesaj zorunludur.',
            'message.min'      => 'Mesaj en az 10 karakter olmalıdır.',
        ]);

        // Veritabanına kaydet
        $contact = Contact::create($data);

        // E-posta gönder
        try {
            Mail::to(config('mail.admin_email', env('ADMIN_EMAIL')))
                ->send(new ContactFormMail($contact));
        } catch (\Exception $e) {
            Log::error('Mail gönderilemedi: ' . $e->getMessage());
        }

        return redirect()->route('contact.form')
                         ->with('success', 'Mesajınız başarıyla gönderildi!
                                            En kısa sürede size dönüş yapacağız.');
    }

    public function location()
    {
        return view('frontend.contact.location');
    }
}