@extends("layauts.site")
@section("content")
<h2>E'lonlar</h2>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 border p-3">
                <div class="border">
                    <img src="/images/{{ $post->img }}" width="100%"  alt="Foto">
                    <h1>{{ $post->title }}</h1>
                    <p>{{ $post->body }}</p>
                </div>
            </div>
            <div class="col-lg-4 border p-3">
                <div class="border">
                    <h3 class="p-1">{{ $post->title }}</h3>
                    <p class="p-1">{{ $post->body }}</p>
                    <p class="p-1">{{ $post->updated_at }}</p>
                    <p class="p-1">{{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y') }}</p>
                    <a class="btn btn-warning btn-sm w-100 mt-1" href="{{ route('posts.edit', $post) }}">Tahrirlash</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100 mt-1" onclick="return confirm('Ishonchingiz komilmi?')">O'chirish</button>
                    </form>
                    <a class="btn btn-success btn-sm w-100 mt-1" href="{{ route('posts.index') }}">Orqaga</a>
                </div>
            </div>
        </div>
  </div>

@endsection
