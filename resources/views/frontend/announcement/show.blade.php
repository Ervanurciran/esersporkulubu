@extends('layouts.app')
@section('content')
<div class="container mx-auto py-12 max-w-4xl">
    <h1 class="text-4xl font-black mb-4">{{ $announcement->title }}</h1>
    <div class="text-gray-500 mb-8 italic">Yayınlanma: {{ $announcement->published_at }}</div>
    <div class="prose max-w-none text-gray-700">
        {!! $announcement->content !!}
    </div>
</div>
@endsection