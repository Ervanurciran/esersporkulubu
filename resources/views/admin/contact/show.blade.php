@extends('layouts.admin')
@section('title', 'Mesaj Detayı')
@section('page_title', 'Mesaj Detayı')
@section('page_subtitle', 'Gelen mesajı görüntüleyin')

@section('content')
<div class="max-w-2xl">
<div class="bg-white rounded-2xl shadow-sm overflow-hidden">

    {{-- Üst Bant --}}
    <div class="h-1.5 w-full bg-green-600"></div>

    <div class="p-8">

        {{-- Gönderen Bilgisi --}}
        <div class="flex items-start space-x-4 mb-8 pb-8 border-b border-gray-100">
            <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center
                        justify-center flex-shrink-0">
                <span class="text-green-700 font-black text-2xl">
                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                </span>
            </div>
            <div class="flex-1">
                <h2 class="font-black text-gray-900 text-xl">{{ $contact->name }}</h2>
                <div class="flex flex-wrap gap-4 mt-2">
                    <a href="mailto:{{ $contact->email }}"
                       class="flex items-center space-x-1.5 text-sm text-gray-500
                              hover:text-green-600 transition">
                        <i class="fas fa-envelope text-xs"></i>
                        <span>{{ $contact->email }}</span>
                    </a>
                    @if($contact->phone)
                    <a href="tel:{{ $contact->phone }}"
                       class="flex items-center space-x-1.5 text-sm text-gray-500
                              hover:text-green-600 transition">
                        <i class="fas fa-phone text-xs"></i>
                        <span>{{ $contact->phone }}</span>
                    </a>
                    @endif
                </div>
                <p class="text-xs text-gray-400 mt-1">
                    <i class="far fa-clock mr-1"></i>
                    {{ $contact->created_at->format('d.m.Y H:i') }}
                </p>
            </div>
            <span class="badge-success">Okundu</span>
        </div>

        {{-- Konu --}}
        <div class="mb-6">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">
                Konu
            </p>
            <p class="font-bold text-gray-800 text-lg">{{ $contact->subject }}</p>
        </div>

        {{-- Mesaj --}}
        <div class="mb-8">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">
                Mesaj
            </p>
            <div class="bg-gray-50 rounded-2xl p-6 text-gray-700 leading-relaxed
                        border border-gray-100">
                {{ $contact->message }}
            </div>
        </div>

        {{-- Aksiyonlar --}}
        <div class="flex items-center space-x-3">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
               class="btn-primary">
                <i class="fas fa-reply mr-2"></i> Yanıtla
            </a>
            <a href="{{ route('admin.contact.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Geri Dön
            </a>
            <form method="POST"
                  action="{{ route('admin.contact.destroy', $contact->id) }}"
                  onsubmit="return confirm('Bu mesajı silmek istediğine emin misin?')"
                  class="ml-auto">
                @csrf @method('DELETE')
                <button class="btn-danger">
                    <i class="fas fa-trash mr-2"></i> Sil
                </button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection