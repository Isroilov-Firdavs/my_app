@extends("layauts.site")
@section("content")

<div class="d-flex justify-content-between mb-3">
    <h2>O'qituvchilar ro'yxati</h2>
    <a class="btn btn-success" href="{{ route('teachers.create') }}">Yangi Post</a>
</div>
<div class="mb-3">
    <form action="{{ route('teachers.index') }}" method="GET">
        <input type="text" name="search"class="form-control" placeholder="Qidiruv" value="{{ request()->get('search') }}">
        <button class="btn btn-primary btn-sm" type="submit">Qidirish</button>
    </form>
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
        }, 2000); // 5000 ms = 5 soniya
    </script>
@endif

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Ism</th>
            <th>Familya</th>
            <th>Email</th>
            <th>Til</th>
            <th width="180px">Amallar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
        <tr>
            <td>{{ $teacher->id }}</td>
            <td>{{ $teacher->first_name }}</td>
            <td>{{ $teacher->last_name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->language }}</td>
            <td>
                <a class="btn btn-info btn-sm" href="{{ route('teachers.show', $teacher) }}">Ko'rish</a>
                <a class="btn btn-primary btn-sm" href="{{ route('teachers.edit', $teacher) }}">Tahrirlash</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ishonchingiz komilmi?')">O'chirish</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $teachers->links() !!}

@endsection
