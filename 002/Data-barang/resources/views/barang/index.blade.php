@extends('layout.app')

@section('title','Data Barang')

@section('content')

<button class="btn btn-primary mb-2">Tambahkan Produk</button>

<div class="card bg-base-200 shadow-md overflow-hidden">
    <table class="table">
        <thead class="bg-base-100">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Image</th>
                <th>Ditambahkan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $row)
            <tr x-data="dialogHandler()">
                <th>{{ $loop->iteration }}</th>
                <th>{{ $row->nama }}</th>
                <th x-text="formatRupiah({{ $row->harga }})"></th>
                <th>{{ $row->deskripsi }}</th>
                <th>{{ $row->stok }}</th>
                <th>{{ $row->kategori }}</th>
                <th>{{ $row->foto }}</th>
                <th>{{ $row->created_at }}</th>
                <th class="flex gap-2" x-data>
                    <button x-on:click="openDialog('dialog')" class="btn btn-success flex-1">Edit</button>
                    <button x-on:click="openDialog('deleteDialog')" class="btn btn-error flex-1">Hapus</button>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('dialog')
<dialog x-data id="dialog" class="modal" x-on:close="resetForm('dialog-form')">
    <div class="modal-box">
      <h3 class="text-2xl font-bold">Dialog</h3>
      <div class="divider"></div>
      <div class="modal-action">
        <form method="dialog" id="dialog-form" class="w-full flex flex-col gap-2">
            <div>
                <div class="label">
                    <span class="label-text">Nama</span>
                </div>
                <input id="modal-nama" type="text" class="input input-bordered w-full" />
            </div>
            <div class="flex gap-2">
                <div>
                    <div class="label">
                        <span class="label-text">Harga</span>
                    </div>
                    <input id="modal-harga" type="number" class="input input-bordered w-full" />
                </div>
                <div>
                    <div class="label">
                        <span class="label-text">Stok</span>
                    </div>
                    <input id="modal-stok" type="number" class="input input-bordered w-full" />
                </div>
            </div>
            <div>
                <div class="label">
                    <span class="label-text">Kategori</span>
                </div>
                <input id="modal-kategori" type="text" class="input input-bordered w-full" />
            </div>
            <div>
                <div class="label">
                    <span class="label-text">Deskripsi</span>
                </div>
                <textarea id="modal-deskripsi" class="textarea textarea-bordered w-full" rows="5"></textarea>
            </div>
            <div>
                <div class="label">
                    <span class="label-text">Foto</span>
                </div>
                <input id="modal-foto" type="file" class="file-input file-input-bordered w-full" accept="image/*" />
            </div>
            <button class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambahkan                  
            </button>
            <button class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>                                    
                Ubah                  
            </button>
        </form>
      </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<dialog id="deleteDialog" class="modal" x-on:close="resetForm('delete-dialog-form')">
    <div class="modal-box">
        <h3 class="text-2xl font-bold">Hapus Produk ?</h3>
        <div class="modal-action">
            <form method="dialog" id="delete-dialog-form" class="w-full">

            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>
@endsection

@section('script')
<script>

function dialogHandler() {
    return {
        openDialog(id) {
            document.getElementById(id).showModal();
        },
        closeDialog(id) {
            document.getElementById(id).close();
        }
    }
}

function resetForm(id) {
    const target = document.getElementById(id);
    target.reset();
}

function formatRupiah(nilai) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(nilai);
}

</script>
@endsection