@extends('admin.layout')

@section('title', $event->title . ' Participant List')

@section('pageCsss')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css"
        integrity="sha512-IuO+tczf4J43RzbCMEFggCWW5JuX78IrCJRFFBoQEXNvGI6gkUw4OjuwMidiS4Lm9Q2lILzpJwZuMWuSEeT9UQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $event->title }} - Participant List</h1>
                    </div><!-- /.col -->

                    {{ Breadcrumbs::render('event.participant', $event->id) }}

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                {{-- <h3 class="card-title">Bordered Table</h3> --}}
                                <h3 class="card-title" style="float: right">
                                    <button type="button" class="btn btn-primary btn" data-toggle="modal"
                                        data-target="#import">
                                        Import
                                    </button>
                                    <a href="{{ route('admin.event.participant.export', ['event' => $event->id]) }}"
                                        class="btn btn-success btn">
                                        Export
                                    </a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th style="width: 300px">Email</th>
                                            <th style="width: 150px">No. HP</th>
                                            <th style="width: 120px">Foto</th>
                                            <th style="width: 200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant)
                                            <tr>
                                                <td>{{ $offset + $loop->iteration }}</td>
                                                <td>{{ $participant->name }}</td>
                                                <td>{{ $participant->email }}</td>
                                                <td>{{ $participant->phone_with_prefix }}</td>
                                                <td><img src="{{ optional($participant->image)->thumbnail ?? 'https://via.placeholder.com/100' }}"
                                                        alt="$participant->name"></td>
                                                <td>
                                                    <form style="width: inherit"
                                                        action="{{ route('admin.event.participant.remove', ['event' => $event->id, 'participant' => $participant->id]) }}"
                                                        method="POST">
                                                        @csrf

                                                        <a href="#" class="btn btn-success btn-sm"><i
                                                                class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                            Remove</a>
                                                    </form>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($participants->isEmpty())
                                            <td colspan="6">
                                                <center>This event does not have any participant yet</center>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            {{ $participants->links() }}
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <!-- Modal -->
            <div class="modal fade" id="import" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="import" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="import">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('admin.event.participant.import', ['event' => $event->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">
                                <input type="file" name="file"
                                    accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                    class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('pageJss')
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"
        integrity="sha512-KBeR1NhClUySj9xBB0+KRqYLPkM6VvXiiWaSz/8LCQNdRpUm38SWUrj0ccNDNSkwCD9qPA4KobLliG26yPppJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".delete").on("submit", function() {
            return confirm("Are you sure?");
        });
    </script>
@endsection
