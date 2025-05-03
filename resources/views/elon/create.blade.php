@extends("layauts.site")
@section("content")
<h2>Yangi E'lon Qo'shish</h2>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title">Sarlavha:</label>
        <input type="text" name="title" value="{{ old('title') }}" id="title"  class="form-control" >
    </div>
    <div class="mb-3">
        <label for="body">Ma'lumot:</label>
        <input type="text" name="body" id="body" value="{{ old('body') }}"  class="form-control" >
    </div>
    <div class="mb-3">
        <label for="img">Rasm:</label>
        <input type="file" value="{{ old('img') }}" name="img" id="img"  class="form-control" >
    </div>
    <button type="submit" class="btn btn-primary">Saqlash</button>
</form>
@endsection
