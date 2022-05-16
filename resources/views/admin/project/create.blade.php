@extends('admin.layout')

@section('title', 'Add Project')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Project</h1>
                    </div><!-- /.col -->

                    {{ Breadcrumbs::render('project.add') }}

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
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" value="{{ old('title') }}"
                                            placeholder="Project Title" name="title" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle">Subtitle</label>
                                        <input type="text" class="form-control" id="subtitle" value="{{ old('subtitle') }}"
                                            placeholder="Project Subtitle" name="subtitle" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="background">{{ trans('content.background') }}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/png, image/jpeg" class="custom-file-input"
                                                    id="background" name="background" required>
                                                <label class="custom-file-label"
                                                    for="background">{{ trans('content.input.file.general') }}</label>
                                            </div>
                                            {{-- <div class="input-group-append">
                                                <span class="input-group-text">{{ trans('content.upload') }}</span>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="x_axis">{{ trans('content.input.axis.general') }}</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="x_axis" required
                                                    placeholder="{{ trans('content.input.axis.x') }}" name="x_axis" value="{{ old('x_axis', 280) }}">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" id="y_axis" required
                                                    placeholder="{{ trans('content.input.axis.y') }}" name="y_axis" value="{{ old('y_axis', 100) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ trans('content.font_size') }}</label>
                                        <input type="number" class="form-control" name="font_size" value="{{ old('font_size', 18) }}"
                                            placeholder="{{ trans('content.input.font_size') }}" required>
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

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
