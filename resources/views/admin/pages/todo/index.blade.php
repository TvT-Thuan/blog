@extends('admin.layouts.main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                To Do List
            </h3>

            <div class="card-tools">
                <ul class="pagination pagination-sm">
                    {{ $todos->links('vendor.pagination.default') }}
                </ul>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table">
                <thead>
                    <th class="col-1">#</th>
                    <th class="col-4">Content</th>
                    <th class="col-2">Expiry</th>
                    <th class="col-2">Created_at</th>
                    <th class="col-2">Updated_at</th>
                    <th class="col-1">Action</th>
                </thead>
                <tbody>
                    @forelse ($todos as $todo)
                        <tr class="@if (now() > $todo->expiry) text-danger @endif">
                            <td>{{ $loop->iteration }}</td>
                            <td> <input type="checkbox" value="{{ $todo->id }}"
                                    @if ($todo->is_active) selected @endif id="todo_1">
                                {{ $todo->content }}
                            </td>
                            <td>{{ $todo->format_expiry }}</td>
                            <td>{{ $todo->format_created }}</td>
                            <td>{{ $todo->format_updated }}</td>
                            <td>
                                <i class="fas fa-edit text-warning"></i>
                                <i class="fas fa-trash text-danger"></i>
                            </td>
                            {{-- <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <form action="{{ route('admin.todos.store') }}" method="post">
                @csrf
                <div class="input-group justify-content-between">
                    <div class="col-4">
                        <input type="text" name="content" placeholder="Nhập nội dung " class="form-control w-100">
                        @error('content')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-4">
                        <input type="datetime-local" name="expiry" class="form-control">
                        @error('expiry')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- <div class="col-2">
                        <input type="number" name="after_expiry" placeholder="Thời gian báo trước" class="form-control">
                        @error('after_expiry')
                            <span>{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-2 text-right">
                        <button class="btn btn-primary">Add todo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $("input[type=checkbox]").on("click", function() {
            // console.log(this.classList.add("text-decoration-line-through"));
            console.log($(this).next());
        });
    </script>
@endpush
