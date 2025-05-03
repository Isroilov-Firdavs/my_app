@extends("layauts.site")
@section("content")
<h2>Yangi Post Qo‘shish</h2>

<form action="{{ route('teachers.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="first_name">Ism:</label>
        <input type="text" name="first_name" value="{{ old('first_name') }}" id="first_name"  class="form-control" >
        @error('first_name') {{ $message }} @enderror
    </div>
    <div class="mb-3">
        <label for="last_name">Familya:</label>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"  class="form-control" >
    </div>
    <div class="mb-3">
        <label for="email">Email:</label>
        <input type="email" value="{{ old('email') }}" name="email" id="email"  class="form-control" >
    </div>
    <div class="mb-3">
        <select name="language" value="{{ old('language') }}" class="form-select" >
            <option value="">Davlatni tanlang</option>
                @foreach($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Saqlash</button>
</form>
@endsection
