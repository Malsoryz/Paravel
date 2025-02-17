<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    @foreach ($barang as $row)
        <div>
            nama: {{$row->nama}} <br>
            harga: {{$row->harga}} <br>
            deskripsi: {{$row->deskripsi}} <br>
            stok: {{$row->stok}} <br>
            kategori: {{$row->kategori}}
        </div>
    @endforeach

</body>
</html>