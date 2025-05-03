@extends("layauts.site")
@section("content")
<h2>Yangi E'lon Qo'shish</h2>

<form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title">Sarlavha:</label>
        <input type="text" name="title" value="{{ $post->title }}" id="title"  class="form-control" >
    </div>
    <div class="mb-3">
        <label for="body">Ma'lumot:</label>
        <input type="text" name="body" id="body" value="{{ $post->body }}"  class="form-control" >
    </div>
    <div class="mb-3">
        <label for="img">Rasm:</label>
        <input type="file" value="{{ $post->img }}" name="img" id="img"  class="form-control" >
    </div>
    <button type="submit" class="btn btn-primary">Saqlash</button>
</form>
@endsection
