@extends('admin.layout')

@section('title', 'Add Event')

@section('pageCss')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Event</h1>
                    </div><!-- /.col -->

                    {{ Breadcrumbs::render('event.add') }}

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-sm-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            {{-- <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div> --}}
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form target="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                                            placeholder="Event Title" name="title" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="startdate">Date:</label>
                                        <input type="text" class="form-control" id="startdate" name="start" value="10/24/1984" required />
                                          {{-- <div class="input-group date" id="startdate" data-target-input="nearest">
                                              <input type="text" id="startdate_input" class="form-control datetimepicker-input" data-target="#startdate" 
                                              name="start" value="10/25/1984"/>
                                              <div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div> --}}
                                      </div>
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/png, image/jpeg" class="custom-file-input"
                                                    id="logo" name="logo" required>
                                                <label class="custom-file-label"
                                                    for="logo">Select Image</label>
                                            </div>
                                            {{-- <div class="input-group-append">
                                                <span class="input-group-text">{{ trans('content.upload') }}</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle">Description (Optional)</label>
                                        <textarea class="form-control" rows="5" placeholder="Enter ..." name="description">{{ old('description') }}</textarea>
                                    </div>

                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('pageJs')
    <!-- bs-custom-file-input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bs-custom-file-input/1.1.1/bs-custom-file-input.min.js"
        integrity="sha512-LGq7YhCBCj/oBzHKu2XcPdDdYj6rA0G6KV0tCuCImTOeZOV/2iPOqEe5aSSnwviaxcm750Z8AQcAk9rouKtVSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    <!-- date picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(function() {
            $('input[name="start"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 2021,
                maxYear: parseInt(moment().format('YYYY'),10),
                minDate: moment().startOf('hour'),
                // locale: {
                //     format: 'M-D'
                // }
            }, function(start, end, label) {
                // $('input[name="startdate"]').val(start);
            });

            bsCustomFileInput.init();
        });
    </script>
@endsection
