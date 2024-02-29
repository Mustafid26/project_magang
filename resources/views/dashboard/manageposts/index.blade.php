@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Postingan Semua Orang</h1>
</div>
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
        <th scope="col">Judul</th>
        <th scope="col">Author</th>
        <th scope="col">Kategori</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->author->name }}</td>
        <td>{{ $post->category->name }}</td>
        <td>
          <form action="/dashboard/manageposts/{{ $post->slug }}" method="POST" class="d-inline">
            @method('DELETE')
            @csrf
            <button class="badge border-0" onclick="return confirm('Yakin Mau Menghapus?')"><i data-feather="trash-2" style="color:red"></i></button>
          </form>
        </td>
      </tr>
    </tbody>
    @endforeach
</table>
@endsection