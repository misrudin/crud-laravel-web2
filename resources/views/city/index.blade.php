@extends('layout.template')

@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="pb-3 d-flex gap-3">
      <div class="flex-grow-1 d-flex gap-1">
          <a href='{{ url('create') }}' class="btn btn-primary whitespace-nowrap" >Tambah Data</a>
          <a href='{{ url('export') }}' class="btn btn-success whitespace-nowrap" >Export Data</a>
      </div>
    </div>
    <table id="table" class="table table-striped table-responsive">
        <thead>
            <tr>
              <th class="col-md-1">No</th>
              <th class="col-md-3">Nama Kota</th>
              <th class="col-md-4">Luas (Km)</th>
              <th class="col-md-2">Jumlah Penduduk</th>
              <th class="col-md-2">Tanggal Input</th>
              <th class="col-md-2">Aksi</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
