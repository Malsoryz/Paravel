@extends('layout.app')

@section('title','Data Barang')

@section('content')

<button id="action-button-create" class="btn btn-primary mb-2">Tambahkan Produk</button>

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
                <th>Ditambahkan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $row)
            <tr>
                <th>{{ $loop->iteration }}</th>
                <th>{{ $row->nama }}</th>
                <th>{{ $row->harga }}</th>
                <th>{{ $row->deskripsi }}</th>
                <th>{{ $row->stok }}</th>
                <th>{{ $row->kategori }}</th>
                <th>{{ $row->created_at }}</th>
                <th class="flex gap-2" value="{{ $row->id }}">
                    <button class="action-button-update btn btn-success flex-1">Edit</button>
                    <button class="action-button-delete btn btn-error flex-1">Hapus</button>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('dialog')
<dialog id="create-update-dialog" class="modal">
    <div class="modal-box">
      <h3 id="create-update-dialog-title" class="text-2xl font-bold">Dialog</h3>
      <div class="divider"></div>
      <div class="modal-action">
        <form method="POST" id="dialog-form" class="w-full flex flex-col gap-2">
            @csrf
            <input id="id" type="hidden" name="id">
            <input id="form-method" type="hidden" name="_method">

            <div>
                <div class="label">
                    <span class="label-text">Nama</span>
                </div>
                <input id="modal-nama" name="nama" type="text" class="input input-bordered w-full" />
            </div>

            <div class="flex gap-2">
                <div>
                    <div class="label">
                        <span class="label-text">Harga</span>
                    </div>
                    <input id="modal-harga" name="harga" type="number" class="input input-bordered w-full" />
                </div>
                <div>
                    <div class="label">
                        <span class="label-text">Stok</span>
                    </div>
                    <input id="modal-stok" name="stok" type="number" class="input input-bordered w-full" />
                </div>
            </div>

            <div>
                <div class="label">
                    <span class="label-text">Kategori</span>
                </div>
                <input id="modal-kategori" name="kategori" type="text" class="input input-bordered w-full" />
            </div>

            <div>
                <div class="label">
                    <span class="label-text">Deskripsi</span>
                </div>
                <textarea id="modal-deskripsi" name="deskripsi" class="textarea textarea-bordered w-full" rows="5"></textarea>
            </div>

            <button type="submit" id="dialog-create-button" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambahkan                  
            </button>

            <button type="submit" id="dialog-update-button" class="btn btn-success">
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

{{-- delete dialog --}}
<dialog id="delete-dialog" class="modal">
    <div class="modal-box">
        <h3 class="text-2xl font-bold">Hapus Produk ?</h3>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-neutral">Kembali</button>
            </form>
            <form method="POST" id="delete-dialog-form" class="flex gap-2">
                @csrf
                @method('delete')
                <button type="submit" id="dialog-delete-button" class="btn btn-error">Hapus</button>
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

//dialog
const cuDialog = document.getElementById("create-update-dialog");
const deleteDialog = document.getElementById("delete-dialog");
const cuDialogTitle = document.getElementById("create-update-dialog-title");

//form
const cuForm = document.getElementById("dialog-form");
const deleteForm = document.getElementById("delete-dialog-form");
const formMethod = document.getElementById("form-method");

//action button
const actionButtonCreate = document.getElementById("action-button-create");
const actionButtonUpdate = document.querySelectorAll(".action-button-update");
const actionButtonDelete = document.querySelectorAll(".action-button-delete");

//inside dialog button
const dialogCreateButton = document.getElementById("dialog-create-button");
const dialogUpdateButton = document.getElementById("dialog-update-button");
const dialogDeleteButton = document.getElementById("dialog-delete-button");

//dialog form input
const formNama = document.getElementById("modal-nama");
const formHarga = document.getElementById("modal-harga");
const formDeskripsi = document.getElementById("modal-deskripsi");
const formStok = document.getElementById("modal-stok");
const formKategori = document.getElementById("modal-kategori");

//adding event listener
actionButtonCreate.addEventListener("click", function() {
    cuDialog.showModal();
    cuDialogTitle.innerText = "Tambah data";
    cuForm.setAttribute("action", "{{ route('barang.store') }}");
    formNama.value = "";
    formHarga.value = "";
    formDeskripsi.value = "";
    formStok.value = "";
    formKategori.value = "";
    dialogUpdateButton.classList.add("hidden");
    dialogCreateButton.classList.remove("hidden");
});

actionButtonUpdate.forEach(button => {
    button.addEventListener("click", function() {
        const row = this.closest("tr");
        const nama = row.cells[1].textContent.trim();
        const harga = row.cells[2].textContent.trim();
        const deskripsi = row.cells[3].textContent.trim();
        const stok = row.cells[4].textContent.trim();
        const kategori = row.cells[5].textContent.trim();
        const id = row.cells[7].getAttribute("value");
        formMethod.value = "PUT";

        cuDialog.showModal();
        cuDialogTitle.innerText = "Edit barang";
        cuForm.setAttribute("action", "{{ route('barang.update', ':id') }}".replace(":id", id));
        formNama.value = nama;
        formHarga.value = harga;
        formDeskripsi.value = deskripsi;
        formStok.value = stok;
        formKategori.value = kategori;
        dialogCreateButton.classList.add("hidden");
        dialogUpdateButton.classList.remove("hidden");
    });
});

actionButtonDelete.forEach(button => {
    button.addEventListener("click", function() {
        const id = this.closest("tr").cells[7].getAttribute("value");

        deleteDialog.showModal();
        deleteForm.setAttribute("action", "{{ route('barang.destroy', ':id') }}".replace(":id", id));
    });
});

function resetForm(id) {
    const target = document.getElementById(id);
    target.reset();
}

//other function
function formatRupiah(nilai) {
    return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(nilai);
}

</script>
@endsection