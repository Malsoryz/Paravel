@extends('layout.app')

@section('title', 'Updating Siswa')

@section('content')

<div class="p-20 flex justify-center">
    <div class="p-5 bg-base-300 rounded-lg">
        <h1 class="mb-8 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-white text-center">
            Ubah Data
        </h1>

        <form action="/siswa/{{$siswa->id}}" method="POST">
            @csrf
            @method("PUT")

            <input type="text" placeholder="Nama" name="nama" value="{{$siswa->nama}}"
                class="input input-bordered input-primary w-full mb-2" />

            <select class="select select-primary w-full mb-8" name="kelas">
                <option disabled selected>Kelas</option>
                @foreach (["X", "XI", "XII"] as $kelas)
                        @foreach (['RPL', 'Kecantikan', 'Boga', 'Musik'] as $jurusan)
                                @for ($ruangan = 1; $ruangan <= 3; $ruangan++)
                                        @php
                                            $value = implode(" ", [$kelas, $jurusan, $ruangan]);
                                        @endphp
                                        <option value="{{$value}}" {{$siswa->kelas == $value ? "selected" : ''}}>{{$value}}</option>
                                @endfor
                        @endforeach
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary w-full">Simpan</button>
        </form>
    </div>
</div>

@endsection
