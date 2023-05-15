@extends('admin.layouts.main')
@section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Contact</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search Mail">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    {{-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div> --}}
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm">
                        <a href="{{ route('admin.contacts.index') }}"><i class="fas fa-sync-alt"></i></a>
                    </button>
                    <div class="float-right">
                        {{ $contacts->firstItem() ?? 0 }}-{{ $contacts->lastItem() ?? 0 }}/{{ $contacts->total() }}
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm">
                                <a href="{{ $contacts->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>

                            </button>
                            <button class="btn btn-default btn-sm">
                                <a href="{{ $contacts->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                            </button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.float-right -->
                </div>
                <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                        <tbody>
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td>
                                        <div class="icheck-primary">
                                            <input type="checkbox" value="" id="check1">
                                            <label for="check1"></label>
                                        </div>
                                    </td>
                                    <td class="mailbox-star">
                                        <i
                                            class="fas {{ $contact->is_seen == '0' ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                    </td>
                                    <td class="mailbox-name">{{ $contact->name }}
                                    </td>
                                    <td class="mailbox-subject">
                                        <a href="{{ route('admin.contacts.show', $contact) }}">
                                            {{ $contact->subject_limit }}
                                        </a>
                                    </td>
                                    <td class="mailbox-date">{{ $contact->created_at->diffForHumans() }}</td>
                                    <td class="col-1 text-right">
                                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-default btn-sm">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <p class="m-2">Empty contact</p>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
                <div class="mailbox-controls">
                    <!-- Check all button -->
                    {{-- <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                        <i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div> --}}
                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-default btn-sm">
                        <a href="{{ route('admin.contacts.index') }}"><i class="fas fa-sync-alt"></i></a>
                    </button>
                    <div class="float-right">
                        {{ $contacts->firstItem() ?? 0 }}-{{ $contacts->lastItem() ?? 0 }}/{{ $contacts->total() }}
                        <div class="btn-group">
                            <button class="btn btn-default btn-sm">
                                <a href="{{ $contacts->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                            </button>
                            <button class="btn btn-default btn-sm">
                                <a href="{{ $contacts->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                            </button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.float-right -->
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
@endsection
