<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi — Eser Spor</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans bg-gray-900 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md px-6">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}"
                 alt="Eser Spor Kulübü"
                 class="h-20 w-auto mx-auto mb-4">
            <h1 class="text-white text-2xl font-bold">Admin Paneli</h1>
            <p class="text-gray-400 text-sm mt-1">Devam etmek için giriş yapın</p>
        </div>

        {{-- Kart --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">

            {{-- Hata --}}
            @if($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 text-red-600
                            px-4 py-3 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 text-green-600
                            px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- DÜZELTME: Kapanış etiketi kaldırıldı, form içeriği artık doğru konumda --}}
            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                {{-- E-posta --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        E-posta Adresi
                    </label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="admin@eserspor.com"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                  focus:outline-none focus:ring-2 focus:ring-green-500
                                  focus:border-transparent text-sm transition">
                </div>

                {{-- Şifre --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Şifre
                    </label>
                    <input type="password" name="password"
                           placeholder="••••••••"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                  focus:outline-none focus:ring-2 focus:ring-green-500
                                  focus:border-transparent text-sm transition">
                </div>

                {{-- Beni Hatırla --}}
                <div class="flex items-center mb-6">
                    <input type="checkbox" name="remember" id="remember"
                           class="w-4 h-4 text-green-600 rounded border-gray-300">
                    <label for="remember" class="ml-2 text-sm text-gray-600">
                        Beni hatırla
                    </label>
                </div>

                {{-- Buton --}}
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white
                               font-semibold py-3 rounded-xl transition duration-200
                               text-sm tracking-wide">
                    Giriş Yap
                </button>
            </form>
        </div>

        <p class="text-center text-gray-500 text-xs mt-6">
            © {{ date('Y') }} Eser Spor Kulübü
        </p>
    </div>
</body>
</html>