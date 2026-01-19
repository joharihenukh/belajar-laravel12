<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Symfony\Contracts\Service\Attribute\Required;

use function Laravel\Prompts\form;

class ContohController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->search;

    $barangs = Barang::when($search, function ($query) use ($search) {
        $query->where('kode_barang', 'like', '%' . $search . '%')
              ->orWhere('nama_barang', 'like', '%' . $search . '%');
    })
    ->latest()
    ->paginate(10);

    $barangs->appends(['search' => $search]);

    return view('welcome', compact('barangs', 'search'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang'=>'required|unique:barangs',
            'nama_barang'=>'required',
            'stok'=>'Required|numeric',
            'harga_beli'=>'Required|numeric',
            'harga_jual'=>'Required|numeric',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:20488'

        ],
        [
            'gambar.max' => 'Ukuran Gambar Maksimal 2MB'
            ]
    );
    $file = null;
    if($request->hasFile('gambar'))
    {
        $file = time() . '-' . $request->gambar->getClientOriginalName();
        $request->gambar->move(public_path('uploads/barang'),$file);
    }

        Barang::create(
            [
                'gambar' => $file,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'stok' => $request->stok,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
            ]
        );

        return redirect()->route('barang.index')->with('succes','Barang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        return view('form',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::findOrFail($id);
        
        $request->validate([
            'kode_barang'=>'required|unique:barangs,kode_barang,'.$barang->id,
            'nama_barang'=>'required',
            'stok'=>'Required|numeric',
            'harga_beli'=>'Required|numeric',
            'harga_jual'=>'Required|numeric',
            'gambar' => 'image|mimes:jpg,jpe,png|max:20488'

        ],
        [
            'gambar.max' => 'Ukuran Gambar Maksimal 2MB'
            ]
    );

    $fileName = $barang->gambar;

    if($request->hasFile('gambar')){
        if($barang->gambar && File::exists(public_path('uploads/barang/' . $barang->gambar))
            ){
            File::delete(public_path('uploads/barang/' . $barang->gambar));
        }

        $fileName = time(). '-' . $request->gambar->getClientOriginalName();
        $request ->gambar->move(public_path('uploads/barang'), $fileName);
    }

    $barang->update(
            [
                'gambar' => $fileName,
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'stok' => $request->stok,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
            ]
        );

        return redirect()->route('barang.index')->with('success','barang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        if($barang->gambar && File::exists(public_path('aploads/barang/' .$barang->gambar))){
            File::delete(public_path('uploads/barang/' . $barang->gambar));
        }
        $barang->delete();

        Barang::destroy($barang);
        return Redirect()->route('barang.index')->with('succes','barang berhasil dihapus');
    }
}
