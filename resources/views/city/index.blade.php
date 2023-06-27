@extends('layout.template')

@section('content')
<!-- START DATA -->
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <div class="pb-3 d-flex gap-3">
    <div class="flex-grow-1">
        <form class="d-flex" action="{{ url('city') }}" method="get">
            <input class="form-control me-1" type="search" name="search" value="{{ Request::get('search') }}" placeholder="Masukkan kata kunci" aria-label="Search">
            <button class="btn btn-secondary" type="submit">Cari</button>
        </form>
      </div>
    <div class="flex-grow-1">
        <a href='{{ url('city/create') }}' class="btn btn-primary whitespace-nowrap" >+ Tambah Data</a>
    </div>
  </div>

  <table class="table table-striped">
      <thead>
          <tr>
              <th class="col-md-1">No</th>
              <th class="col-md-3">Nama Kota</th>
              <th class="col-md-4">Luas</th>
              <th class="col-md-2">Jumlah Penduduk</th>
              <th class="col-md-2">Aksi</th>
          </tr>
      </thead>
      <tbody>
        <?php $i = $data->firstItem() ?>
        @foreach ($data as $item)
            <tr>
                <td>{{$i}}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->luas }}</td>
                <td>{{ $item->jumlah_penduduk }}</td>
                <td>
                    <a href='{{ url('city/' . $item->id . '/edit') }}' class="btn btn-warning btn-sm">Edit</a>
                    <form class="d-inline" action="{{ url('city/' . $item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            <?php $i++ ?>
        @endforeach
      </tbody>
  </table>
{{$data->links()}}
</div>
<!-- AKHIR DATA -->
@endsection
