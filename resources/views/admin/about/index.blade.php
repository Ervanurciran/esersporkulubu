@extends('layouts.admin')
@section('title', 'Hakkımızda Yönetimi')
@section('page_title', 'Hakkımızda Yönetimi')
@section('page_subtitle', 'Tarihçe ve Misyon & Vizyon içeriklerini düzenleyin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white rounded-2xl shadow-sm p-8 flex flex-col">
        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center
                    justify-center mb-5">
            <i class="fas fa-history text-blue-600 text-xl"></i>
        </div>
        <h3 class="text-gray-800 font-bold text-lg mb-2">Tarihçe</h3>
        <p class="text-gray-500 text-sm mb-6 flex-1">
            Kulübün kuruluş hikayesi ve geçmişe dair bilgileri düzenleyin.
        </p>
        <a href="{{ route('admin.about.history.edit') }}" class="btn-primary">
            <i class="fas fa-edit mr-2"></i> Düzenle
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8 flex flex-col">
        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center
                    justify-center mb-5">
            <i class="fas fa-bullseye text-green-600 text-xl"></i>
        </div>
        <h3 class="text-gray-800 font-bold text-lg mb-2">Misyon & Vizyon</h3>
        <p class="text-gray-500 text-sm mb-6 flex-1">
            Kulübün misyon ve vizyon ifadelerini güncelleyin.
        </p>
        <a href="{{ route('admin.about.mission.edit') }}" class="btn-primary">
            <i class="fas fa-edit mr-2"></i> Düzenle
        </a>
    </div>

</div>
@endsection