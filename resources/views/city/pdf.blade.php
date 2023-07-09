@extends('layout.template')
@section('content')
  <center>
    <h1>Laporan Data Kota</h1>
  </center>
  <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th class="col-md-1 text-center">No</th>
            <th class="col-md-3">Nama Kota</th>
            <th class="col-md-4">Luas</th>
            <th class="col-md-2">Jumlah Penduduk</th>
        </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
      @foreach ($data as $item)
          <tr>
              <td class="text-center">{{$i}}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->luas }}</td>
              <td>{{ $item->jumlah_penduduk }}</td>
          </tr>
          <?php $i++ ?>
      @endforeach
    </tbody>
</table>
@endsection