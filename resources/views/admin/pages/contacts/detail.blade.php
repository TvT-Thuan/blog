@extends('admin.layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endpush
@section('content')
    <main id="main">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Read contact</h3>

                                <div class="card-tools">
                                    @if ($contact_back != null)
                                        <a href="{{ route('admin.contacts.show', $contact_back) }}" class="btn btn-tool"
                                            title="Previous"><i class="fas fa-chevron-left"></i></a>
                                    @endif
                                    @if ($contact_next != null)
                                        <a href="{{ $contact_next == null ? '' : route('admin.contacts.show', $contact_next) }}"
                                            class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mailbox-read-info">
                                    <h5>Message Subject: {{ $contact->subject }}</h5>
                                    <h6>From: {{ $contact->email }}
                                        <span class="mailbox-read-time float-right">
                                            {{ $contact->created_at->format('d M. Y h:m:i') }}</span>
                                    </h6>
                                </div>
                                <!-- /.mailbox-read-info -->
                                <div class="mailbox-read-message">
                                    {{ $contact->message }}
                                </div>
                                <!-- /.mailbox-read-message -->
                            </div>
                            <!-- /.card-body -->
                            <!-- /.card-footer -->
                            <div class="card-footer">
                                <div class="float-right">
                                    <a class="btn btn-default" href="{{ route('admin.contacts.index') }}"><i
                                            class="fas fa-share"></i>
                                        Back</a>
                                </div>
                                <div class="d-flex">
                                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-default">
                                            <i class="far fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Reply</h3>
                    </div>
                    <form action="{{ route("admin.contacts.reply") }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input name="email" value="{{ $contact->email }}" class="form-control" placeholder="To:" name="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Subject:" name="subject">
                            </div>
                            <div class="form-group">
                                <textarea id="message" name="message" class="form-control" placeholder="Message:"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $('#message').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endpush
