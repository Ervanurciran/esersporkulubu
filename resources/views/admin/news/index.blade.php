@extends('layouts.admin')

@section('title', 'Haber Yönetimi')
@section('page_title', 'Haber Yönetimi')
@section('page_subtitle', 'Haber ve etkinlik içeriklerini yönetin')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- HABERLER --}}
    <div class="bg-white rounded-2xl shadow-sm p-8 flex flex-col">

        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-5">
            <i class="fas fa-newspaper text-blue-600 text-xl"></i>
        </div>

        <h3 class="text-gray-800 font-bold text-lg mb-2">Haberler</h3>

        <p class="text-gray-500 text-sm mb-6 flex-1">
            Kulübe ait haber içeriklerini görüntüleyin, düzenleyin ve yönetin.
        </p>

        <a href="{{ route('admin.news.haberler') }}" class="btn-primary">
            <i class="fas fa-list mr-2"></i> Haberleri Listele
        </a>

    </div>

    {{-- ETKİNLİKLER --}}
    <div class="bg-white rounded-2xl shadow-sm p-8 flex flex-col">

        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mb-5">
            <i class="fas fa-calendar-alt text-yellow-600 text-xl"></i>
        </div>

        <h3 class="text-gray-800 font-bold text-lg mb-2">Etkinlikler</h3>

        <p class="text-gray-500 text-sm mb-6 flex-1">
            Etkinlik içeriklerini düzenleyin, yayınlayın ve yönetin.
        </p>

        <a href="{{ route('admin.news.etkinlikler') }}" class="btn-primary">
            <i class="fas fa-list mr-2"></i> Etkinlikleri Listele
        </a>

    </div>

</div>

@endsection