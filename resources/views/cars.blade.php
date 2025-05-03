@extends("layauts.site")

@section("content")
<table class="table border">
    <thead class="table-success">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Car Make</th>
        <th scope="col">Car Model</th>
        <th scope="col">Car Model Year</th>
        <th scope="col">Car VIN</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($car as $cars)
            <tr>
                <td>{{ $cars->id }}</td>
                <td>{{ $cars->make }}</td>
                <td>{{ $cars->model }}</td>
                <td>{{ $cars->model_year }}</td>
                <td>{{ $cars->car_vin }}</td>
                <td>
                    <a href="#">
                        <i class="bi bi-pencil-fill p-2"></i>
                    </a>
                    <a href="#">
                        <i class="bi bi-trash3 p-2"></i>
                    </a>
                    <a href="#">
                        <i class="bi bi-eye-fill p-2"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    <!-- Sahifalash linklari -->
    <div>
        {{ $car->links() }}
    </div>
@endsection
