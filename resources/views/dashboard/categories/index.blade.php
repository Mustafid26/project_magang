@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kategori Post</h1>
</div>

<div class="table-responsive">
  <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Buat Kategori Baru</a>
  @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Kategori</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $category->name }}</td>
          <td>
            <a href="/dashboard/categories/{{ $category->slug }}" class="badge"><i data-feather="eye" style="color:black"></i></a>
            <a href="/dashboard/categories/{{ $category->slug }}/edit" class="badge"><i data-feather="edit" style="color:blue"></i></a>

            <form action="/dashboard/categories/{{ $category->slug }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge border-0" onclick="return confirm('Yakin Mau Menghapus?')"><i data-feather="trash-2" style="color:red"></i></button>
            </form>
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>
</div>
@endsection