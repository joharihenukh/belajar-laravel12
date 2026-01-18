<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-5">
            {{ isset($barang) ? 'Edit Barang' : 'Tambah Barang' }}
        </h1>

        <form action="{{ isset($barang) ? route('barang.update', $barang->id) : route('barang.store') }}" method="POST">
            @csrf
            @if(isset($barang))
            @method('PUT')
            @endif
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Kode Barang</label>
                <input type="text" name="kode_barang" class="w-full border-gray-300 rounded-lg p-2 shadow-sm" value="{{ old('kode_barang',$barang->kode_barang ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full border-gray-300 rounded-lg p-2 shadow-sm" value="{{ old('nama_barang',$barang->nama_barang ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Stok Barang</label>
                <input type="text" name="stok" class="w-full border-gray-300 rounded-lg p-2 shadow-sm" value="{{ old('stok',$barang->stok ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Harga Beli</label>
                <input type="text" name="harga_beli" class="w-full border-gray-300 rounded-lg p-2 shadow-sm" value="{{ old('harga_beli',$barang->harga_beli ?? '') }}" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Harga Jual</label>
                <input type="text" name="harga_jual" class="w-full border-gray-300 rounded-lg p-2 shadow-sm" value="{{ old('harga_jual',$barang->harga_jual ?? '') }}" required>
            </div>
            <div class="flex justify-end gap-2">
                <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Kembali
                </a>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    {{ isset($barang) ? 'Update' : 'Simpan'}}
                </button>
            </div>
        </form>
    </div>
</body>
</html>