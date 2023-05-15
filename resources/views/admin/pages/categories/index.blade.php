@extends('admin.layouts.main')
@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mt-5">Add Category</a>
    <div class="card mt-4">
        <div class="card-body p-0">
            <table class="table table-hover border">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Active</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td class="p-1">
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if ($category->is_active)
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger pr-1"></i>
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (!$category->is_active)
                                            <a class="dropdown-item"
                                                href="{{ route('admin.categories.is_active', ['category' => $category, 'is_active' => 1]) }}"><i
                                                    class="fas fa-check text-success"></i></a>
                                        @else
                                            <a class="dropdown-item"
                                                href="{{ route('admin.categories.is_active', ['category' => $category, 'is_active' => 0]) }}"><i
                                                    class="fas fa-times text-danger"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="d-flex align-items-center p-1">
                                <a class="btn" href="{{ route('admin.categories.edit', $category) }}"><i
                                        class="fas fa-edit text-warning"></i></a>
                                |
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    onsubmit="return confirmDelete('When you delete a category, you will delete both related posts and comments ?')">
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
