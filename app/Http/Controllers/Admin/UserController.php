<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.form', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|confirmed',
        ], [
            'name.required'         => 'Ad soyad zorunludur.',
            'email.required'        => 'E-posta zorunludur.',
            'email.unique'          => 'Bu e-posta zaten kayıtlı.',
            'password.required'     => 'Şifre zorunludur.',
            'password.min'          => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed'    => 'Şifreler eşleşmiyor.',
        ]);

        User::create($data);

        return redirect()->route('admin.kullanicilar.index')
                         ->with('success', 'Kullanıcı eklendi.');
    }

    public function edit(User $kullanicilar)
    {
        return view('admin.user.form', ['user' => $kullanicilar]);
    }

    public function update(Request $request, User $kullanicilar)
    {
        $data = $request->validate([
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|unique:users,email,' . $kullanicilar->id,
            'password'           => 'nullable|min:8|confirmed',
        ], [
            'name.required'      => 'Ad soyad zorunludur.',
            'email.unique'       => 'Bu e-posta zaten kayıtlı.',
            'password.min'       => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifreler eşleşmiyor.',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $kullanicilar->update($data);

        return redirect()->route('admin.kullanicilar.index')
                         ->with('success', 'Kullanıcı güncellendi.');
    }

    public function destroy(User $kullanicilar)
    {
        if ($kullanicilar->id === auth()->id()) {
            return redirect()->route('admin.kullanicilar.index')
                             ->with('error', 'Kendi hesabınızı silemezsiniz.');
        }

        $kullanicilar->delete();

        return redirect()->route('admin.kullanicilar.index')
                         ->with('success', 'Kullanıcı silindi.');
    }
}
