<!--Con extends se carga la plantilla de html que hemos creado en layouts master-->
@extends('layouts.app')

<!--Con section se bindea el contenido del yield creada en la plantilla en este caso será content-->
@section('content')
    <h1>List of Users</h1>

    <!--Se genera una condicional de blade de esta forma, siempre hay que cerrarla con {{-- @endif--}}-->
    <!--Con la funcion de JS empty filtramos si está vacia o no-->
    {{--@if (empty($products))--}}
    <!--Con la funcion de blade empty filtramos si está vacia o no. siempre hay que cerrarla con {{-- @endempty--}}-->
    @empty ($users)
        <div class="alert warning">
            This list of users is empty
        </div>

    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Admin Since</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id}}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ optional($user->admin_since)->diffForHumans() ?? 'Never'}}</td>
                            <td>
                                <!-- se realiza un formulario para poder hacer el cambio de admin llamando a la ruta con dicho metodo en el controlador pasandole el id del user.  -->
                                <form method="POST" class="d-inline" action="{{route('users.admin.toggle', ['user'=>$user->id])}}">
                                    @csrf
                                    <button type="submit" class="btn btn-link">
                                       {{ $user->isAdmin() ? 'Remove' : 'Make' }}
                                        Admin
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endempty
@endsection
