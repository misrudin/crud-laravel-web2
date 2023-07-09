@extends('layout.template')

@section('content')
<form action='{{ url('/') }}' method='post'>
  @csrf
  <div style="max-width: 500px" class="my-3 p-3 bg-body rounded shadow-sm mx-auto">
  @if ($errors->any())
  <div class="pt-3">
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $item)
          <li>{{$item}}</li>
        @endforeach
      </ul>
    </div>
  </div>
  @endif
      <div class="mb-3">
          <label for="name" class="col-sm-12 col-form-label">Nama Kota</label>
          <div class="col-sm-12">
              <input type="text" placeholder="Masukan nama kota" class="form-control" name='name' id="name" value="{{ Session::get('name') }}">
          </div>
      </div>
      <div class="mb-3">
          <label for="luas" class="col-sm-12 col-form-label">Luas</label>
          <div class="col-sm-12">
              <input type="number" placeholder="Masukan luas" class="form-control" name='luas' id="luas" value="{{ Session::get('luas') }}">
          </div>
      </div>
      <div class="mb-3">
          <label for="penduduk" class="col-sm-12 col-form-label">Jumlah Penduduk</label>
          <div class="col-sm-12">
              <input type="text" placeholder="Masukan jumlah penduduk" class="form-control" name='penduduk' id="penduduk" value="{{ Session::get('penduduk') }}">
          </div>
      </div>
      <div class="mt-4">
          <div class="col-sm-12"><button style="width:100%" type="submit" class="btn btn-primary" name="submit">Simpan</button></div>
      </div>
    </form>
  </div>
@endsection