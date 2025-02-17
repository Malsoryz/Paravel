@extends('layout.app')

@section('title', 'Siswa')

@section('header', 'Siswa')

@section('content')

<div class="p-4">

    <a class="btn btn-primary mb-4 text-white" href="{{route('siswa.create')}}">Tambah</a>

    <div class="flex flex-col gap-4">
        @foreach ($data as $row)
            <div class="p-4 bg-base-100 rounded-md flex justify-between">
                <div>
                    <h1>Nama: {{$row->nama}}</h1>
                    <h1>Kelas: {{$row->kelas}}</h1>
                </div>
                <div class="flex gap-2">
                    <a href="{{route("siswa.show", $row->id)}}">
                        <button class="btn btn-success text-white">Ubah</button>
                    </a>

                    <form action=" {{route("siswa.destroy", $row->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <button class="btn btn-error w-50 h-10 text-white">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
