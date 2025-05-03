@extends("layauts.site")
@section("content")

<div class="">
    <h2>E'lonlar ro'yxati</h2>
    <a class="btn btn-success mt-1 mb-1" href="{{ route('posts.create') }}">Create</a>
</div>

@if ($message = Session::get('success'))
    <div id="success-alert" class="alert alert-success">{{ $message }}</div>

    <script>
        // 5 soniyadan keyin alertni yashirish
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000); // 5000 ms = 5 soniya
    </script>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Sarlavha</th>
            <th>Ma'lumot</th>
            <th>Rasm</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr class="table-primary">
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->body }}</td>
            <td>
                <a href="{{ route("posts.show",  $post) }}">
                    <img src="/images/{{ $post->img }}" class="img-fluid" width="100" alt="Foto">
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $posts->links() !!}

@endsection
