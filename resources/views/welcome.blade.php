<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-x1 shadow">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2x1 font-bold">
                Data Barang
            </h1>
            <div class="mb-4 flex justify-betwen items-center">
                <form action="{{route('barang.index')}}" method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{request('search')}}" placeholder="car kode Barang/Nama...." class="border rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring focus:border-blue-300">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Cari</button>
                </form>
            </div>
            <a href="{{ route('barang.create')}}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-ig nado">
                + Tambah Data
            </a>
        </div>

        <table class="w-full border-gray-300 rounded-ig overflow-hidden">
            <thead class="bg-gray-200">
                <tr class="text-left">
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Kode</th>
                    <th class="p-3">Nama Barang</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3">Harga Beli</th>
                    <th class="p-3">Harga Jual</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        @if ($barang->gambar)
                        <img src="{{ asset('uploads/barang/' .  $barang->gambar) }}" alt="Gambar" style="width: 60px; height: 60px; object-fit: cover;border: 5px;">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $barang->kode_barang }}</td>
                    <td class="p-3">{{ $barang->nama_barang }}</td>
                    <td class="p-3">{{ $barang['stok'] }}</td>
                    <td class="p-3">Rp {{ number_format ( $barang->harga_beli)}}</td>
                    <td class="p-3">Rp {{ number_format ( $barang['harga_jual'])}}</td>
                    <td class="p-3">
                        <a href="{{route('barang.edit',$barang->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>

                        <form action="{{ route('barang.destroy',$barang->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin Hapus')" class="bg-red-700 text-white px-3 py-1 rounded text-sm" btn-dm>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>