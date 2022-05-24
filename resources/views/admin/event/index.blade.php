@extends('admin.layout')

@section('title', 'Event List')

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
                        <h1 class="m-0">Event List</h1>
                    </div><!-- /.col -->

                    {{ Breadcrumbs::render('event') }}

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
                                    <a href="{{ route('admin.event.create') }}" class="btn btn-primary btn">
                                        Add New
                                    </a>
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Title</th>
                                            <th style="width: 150px">Date</th>
                                            <th style="width: 100px">Status</th>
                                            <th style="width: 250px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>{{ $offset + $loop->iteration }}</td>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ $event->start->format('d M Y') }}</td>
                                                @if ($event->status == 'Closed')
                                                    <td class="text-center">
                                                        <span class="badge badge-danger">{{ $event->status }}</span>
                                                    </td>
                                                @elseif($event->status == 'Ongoing')
                                                    <td class="text-center">
                                                        <span class="badge badge-info">{{ $event->status }}</span>
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <span class="badge badge-success">{{ $event->status }}</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <form action="{{ route('admin.event.destroy', $event->id) }}"
                                                        method="POST" class="delete">
                                                        @csrf
                                                        @method('delete')

                                                        <a href="{{ route('admin.event.edit', ['event' => $event->id]) }}"
                                                            class="btn btn-success btn-sm"><i class="fas fa-edit"></i>
                                                            Edit</a>
                                                        <a href="{{ route('admin.event.participant', ['event' => $event->id]) }}"
                                                            class="btn btn-info btn-sm"><i class="fas fa-users"></i>
                                                            Users</a>
                                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i>
                                                            Delete</a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($events->isEmpty())
                                            <td colspan="5">
                                                <center>There is no event created yet</center>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            {{ $events->links() }}
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
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
