<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CorporateController extends Controller
{
    public function index()
    {
        $baskan        = BoardMember::baskan()->active()->first();
        $yonetimKurulu = BoardMember::yonetimKurulu()->active()->get();
        $denetimKurulu = BoardMember::denetimKurulu()->active()->get();
        $tuzuk         = Page::getByKey('tuzuk');

        return view('admin.corporate.index', compact(
            'baskan',
            'yonetimKurulu',
            'denetimKurulu',
            'tuzuk'
        ));
    }

    public function create()
    {
        return view('admin.corporate.form', [
            'member' => new BoardMember()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'title'      => 'required|string|max:255',
            'type'       => 'required|in:baskan,yonetim_kurulu,denetim_kurulu',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio'        => 'nullable|string',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ], [
            'name.required'  => 'Ad soyad zorunludur.',
            'title.required' => 'Ünvan zorunludur.',
            'type.required'  => 'Tür seçimi zorunludur.',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('board-members', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        BoardMember::create($data);

        return redirect()
            ->route('admin.corporate.index')
            ->with('success', 'Üye başarıyla eklendi.');
    }

    public function edit($id)
    {
        $uye = BoardMember::findOrFail($id);

        return view('admin.corporate.form', [
            'member' => $uye
        ]);
    }

    public function update(Request $request, $id)
    {
        $uye = BoardMember::findOrFail($id);

        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'title'      => 'required|string|max:255',
            'type'       => 'required|in:baskan,yonetim_kurulu,denetim_kurulu',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'bio'        => 'nullable|string',
            'email'      => 'nullable|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {

            if ($uye->photo) {
                Storage::disk('public')->delete($uye->photo);
            }

            $data['photo'] = $request->file('photo')
                ->store('board-members', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $uye->update($data);

        return redirect()
            ->route('admin.corporate.index')
            ->with('success', 'Üye güncellendi.');
    }

    public function destroy($id)
    {
        $uye = BoardMember::findOrFail($id);

        if ($uye->photo) {
            Storage::disk('public')->delete($uye->photo);
        }

        $uye->delete();

        return redirect()
            ->route('admin.corporate.index')
            ->with('success', 'Üye silindi.');
    }

    public function editStatute()
    {
        $page = Page::firstOrCreate(
            ['page_key' => 'tuzuk'],
            [
                'title' => 'Tüzük',
                'content' => ''
            ]
        );

        return view('admin.corporate.statute', compact('page'));
    }

    public function updateStatute(Request $request)
    {
        $request->validate([
            'content'   => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'file_path.mimes' => 'Sadece PDF dosyası yükleyebilirsiniz.',
            'file_path.max'   => 'PDF boyutu en fazla 10MB olabilir.',
        ]);

        $page = Page::firstOrCreate(
            ['page_key' => 'tuzuk'],
            ['title' => 'Tüzük']
        );

        $updateData = [
            'content' => $request->content
        ];

        if ($request->hasFile('file_path')) {

            if ($page->file_path) {
                Storage::disk('public')->delete($page->file_path);
            }

            $updateData['file_path'] = $request->file('file_path')
                ->store('documents', 'public');
        }

        $page->update($updateData);

        return redirect()
            ->route('admin.corporate.statute.edit')
            ->with('success', 'Tüzük güncellendi.');
    }
}