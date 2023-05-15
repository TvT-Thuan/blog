@extends('admin.layouts.main')
@section('content')
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-5">Add user</a>
    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-hover border">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Role</th>
                    <th>Active</th>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><img width="25px" src="{{ asset($user->image_url) }}" alt=""></td>
                            <td>{{ $user->role_name }}</td>
                            <td class="p-1">
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if ($user->is_active)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger pr-1"></i>
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (!$user->is_active)
                                            <a class="dropdown-item"
                                                href="{{ route('admin.users.is_active', ['user' => $user, 'is_active' => 1]) }}"><i
                                                    class="fas fa-check text-success"></i></a>
                                        @else
                                            <a class="dropdown-item"
                                                href="{{ route('admin.users.is_active', ['user' => $user, 'is_active' => 0]) }}"><i
                                                    class="fas fa-times text-danger"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="d-flex align-items-center p-1">
                                <a class="btn" href="{{ route('admin.users.edit', $user) }}"><i
                                        class="fas fa-edit text-warning"></i></a>
                                |
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn"><i class="fas fa-trash text-danger"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
