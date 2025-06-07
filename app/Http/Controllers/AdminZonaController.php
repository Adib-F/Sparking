<?php

namespace App\Http\Controllers;
use App\Models\Subzona;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminZonaController extends Controller
{
    public function index(Request $request)
    {
        $zonas = Zona::all();

        // Zona ID default null jika tidak ada yang dipilih
        $zonaId = $request->get('zona_id') ?? null;

        // Filter subzona berdasarkan zona_id jika ada
        $subzonas = $zonaId ? Subzona::with('zona')->where('zona_id', $zonaId)->get() : collect([]);

        return view('admin.manageZona', compact('zonas', 'subzonas', 'zonaId'), [
            "title" => "ManageZona",
        ]);
    }

    // Method Zona
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_zona' => 'required|unique:zona,nama_zona',
            'keterangan' => 'required|string',
            'fotozona' => 'required|image|max:5000',
        ], [
            'nama_zona.required' => 'Nama Zona wajib diisi.',
            'nama_zona.unique' => 'Nama Zona sudah terdaftar.',
            'keterangan.required' => 'Keterangan Zona wajib diisi.',
            'fotozona.image' => 'File yang diunggah harus berupa gambar.',
            'fotozona.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'fotozona.required' => 'Foto area zona wajib diisi.'

        ]);

        if ($request->hasFile('fotozona')) {
            $validated['fotozona'] = $request->file('fotozona')->store('datafoto', 'public');
        }

        Zona::create($validated);
        return redirect()->back()->with('success', 'Zona berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $zona = Zona::findOrFail($id);

        $validated = $request->validate([
            'keterangan' => 'required|string',
            'fotozona' => 'image|max:5000',
        ], [
            'keterangan.required' => 'Keterangan Zona wajib diisi.',
            'fotozona.image' => 'File yang diunggah harus berupa gambar.',
            'fotozona.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
        ]);

        if ($request->hasFile('fotozona')) {
            if ($zona->fotozona) {
                Storage::disk('public')->delete($zona->fotozona);
            }
            $validated['fotozona'] = $request->file('fotozona')->store('datafoto', 'public');
        }

        $zona->update($validated);
        return redirect()->back()->with('success', 'Keterangan zona berhasil diupdate.');
    }


    public function destroy($id)
    {
        $zona = Zona::findOrFail($id);

        // Hapus foto jika ada
        if ($zona->fotozona) {
            $fotoPath = public_path($zona->fotozona);

            // Periksa apakah file foto ada sebelum dihapus
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }
        $zona->delete();
        return redirect()->back()->with('success', 'Zona berhasil dihapus');
    }

    // Method Subzona
    public function storeSubzona(Request $request)
    {
        $validated = $request->validate([
            'zona_id' => 'required|exists:zona,id',
            'nama_subzona' => 'required|unique:subzona,nama_subzona',
            'camera_id' => 'required|integer',
            'foto' => 'required|image|max:5000'
        ], [
            'zona_id.required' => 'Nama Zona wajib diisi.',
            'keterangan.required' => 'Keterangan Zona wajib diisi.',
            'nama_subzona.unique' => 'Nama Subzona telah terdaftar',
            'nama_subzona.required' => 'Nama Subzona wajib diisi',
            'camera_id.integer' => 'kamera id harus berupa angka',
            'foto.required' => 'Foto area Sub-Zona wajib diisi.',
            'foto.image' => 'file yang disubmit harus berupa gambar.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.'

        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('datafoto', 'public');
        }

        Subzona::create($validated);
        return redirect()->back()->with('succes', 'Subzona berhasil ditambahkan.');
    }

    public function updateSubzona(Request $request, $id)
    {
        $subzona = Subzona::findOrFail($id);

        $validated = $request->validate([
            'foto' => 'image|max:5000',
            'camera_id' => 'required|integer'
        ], [
            'foto.image' => 'File yang disubmit harus berupa gambar.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            'camera_id.integer' => 'Kamera ID harus berupa angka'
        ]);


        if ($request->hasFile('foto')) {
            if ($subzona->foto) {
                Storage::disk('public')->delete($subzona->foto);
            }
            $validated['foto'] = $request->file('foto')->store('datafoto', 'public');
        }

        $subzona->update($validated);
        return redirect()->back()->with('success', 'Subzona berhasil diupdate.');
    }


    public function destroySubzona($id)
    {
        $subzona = Subzona::findOrFail($id);

        // Hapus foto jika ada
        if ($subzona->foto) {
            $fotoPath = public_path($subzona->foto);

            // Periksa apakah file foto ada sebelum dihapus
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $subzona->delete();
        return redirect()->back()->with('succes', 'Subzona berhasil dihapus');
    }
}
