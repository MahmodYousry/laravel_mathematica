@extends('layouts.master')

@section('css_adds')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        {{ trans('main_trans.List_classes') }} <small class="font-size-base font-w400 text-muted">{{ trans('grades.table') }}</small>
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item">{{ trans('main_trans.Dashboard') }}</li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="">{{ trans('main_trans.List_classes') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <!-- start add button -->
                    <button type="button" class="btn btn-success mr-1 mb-3" data-toggle="modal" data-target="#modal-add-class">
                        <i class="fa fa-fw fa-plus mr-1"></i> {{ trans('myclass.add_class') }}
                    </button>
                    <button type="button" class="btn btn-danger mr-1 mb-3" id="btn_delete_all">
                        <i class="fa fa-fw fa-trash mr-1"></i> {{ trans('myclass.delete_checkbox') }}
                    </button>
                    <form action="{{ route('filter_classes') }}" method="POST" class="text-right">
                        {{ csrf_field() }}
                        <select class="selectpicker mr-1 mb-3" data-style="btn-light" name="grade_id" required onchange="this.form.submit()">
                            <option value="" selected disabled>{{ trans('myclass.search_by_grade') }}</option>
                            <optgroup label="{{ trans('myclass.search_by_grade') }}">

                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <!-- start add modal Content -->
                    <div class="modal fade" id="modal-add-class" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="block block-rounded block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark">
                                        <h3 class="block-title">{{ trans('myclass.add_class') }}</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content font-size-sm">
                                        <form id="classes_add" >
                                            @csrf
                                            <div class="row classes_add_form" id="jsAddAnotherData">
                                                <div class="row my-block p-3">
                                                    <div class="col-lg-6 col-md-6 col-xl-6">
                                                        <div class="form-group">
                                                            <label for="name">{{ trans('myclass.name_class') }}</label>
                                                            <input type="text" class="form-control form-control-alt" id="name"
                                                                    name="class_name" placeholder="{{ trans('myclass.name_class') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-xl-6">
                                                        <div class="form-group">
                                                            <label for="en_name">{{ trans('myclass.name_class_en') }}</label>
                                                            <input id="en_name" type="text" class="form-control form-control-alt"
                                                            name="class_name_en" placeholder="{{ trans('myclass.name_class_en') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-xl-12">
                                                        <div class="form-group">
                                                            <label for="grade_id">{{ trans('myclass.name_grade') }}</label>
                                                            <select class="form-control form-control-alt" name="grade_id" id="grade_id">
                                                                @foreach ($grades as $grade)
                                                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="block-content text-left border-top">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                        <button type="submit" class="btn btn-md btn-primary" id="insert_classes">
                                                            <i class="fa fa-fw fa-check"></i> {{ trans('grades.save') }}
                                                        </button>
                                                        <a id="add_more" class="btn btn-md btn-success" href="javascript:void(0)">
                                                            <i class="fa fa-fw fa-plus"></i> add more</a>

                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END add modal Content -->
                    <!-- END add button -->

                    {{-- errors And Alerts --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <p class="mb-0">{{ $error }}</p>
                            </div>
                        @endforeach
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success d-flex align-items-center animated fadeInDown" role="alert">
                            <div class="flex-00-auto">
                                <i class="fa fa-fw fa-check"></i>
                            </div>
                            <div class="flex-fill ml-3">
                                <p class="mb-0 text-capitalize">{{ session('success') }}</p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center animated fadeInDown" role="alert">
                            <div class="flex-00-auto">
                                <i class="far fa-sad-tear fa-fw"></i>
                            </div>
                            <div class="flex-fill ml-3">
                                <p class="mb-0 text-capitalize">{{ session('error') }}</p>
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    {{-- end errors And Alerts --}}

                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">
                                    <input class="ml-2" name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" />
                                </th>
                                <th class="text-center" style="width: 60px;">ID</th>

                                @if (App::getLocale() == 'en')
                                    <th>{{ trans('myclass.name_class_en') }}</th>
                                @else
                                    <th>{{ trans('myclass.name_class') }}</th>
                                @endif

                                <th>{{ trans('myclass.name_grade') }}</th>
                                <th style="width: 15%;">{{ trans('grades.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($details) AND $details->isNotEmpty())
                                <?php $list_classes = $details; ?>
                            @else
                                <?php $list_classes = $my_classes; ?>
                            @endif

                            @foreach ($list_classes as $my_classroom)
                                <tr>
                                    <td class="text-center"><input type="checkbox" value="{{ $my_classroom->id }}" class="box1"></td>
                                    <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                                    <td class="font-w600 font-size-sm"><a href="#">{{$my_classroom->class_name}}</a></td>
                                    <td class="text-center">
                                        {{$my_classroom->grades->name}}
                                    </td>
                                    <td>
                                        <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-start">
                                            <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                                        data-target="#modal-edit-classroom{{$my_classroom->id}}">
                                                <i class="fa fa-fw fa-edit mr-1"></i> {{ trans('grades.edit') }}
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger m-1" data-toggle="modal"
                                                        data-target="#modal-delete-classroom{{$my_classroom->id}}">
                                                <i class="fa fa-fw fa-times mr-1"></i> {{ trans('grades.delete') }}
                                            </button>
                                        </div>
                                    </td>

                                    <!-- start delete modal Content -->
                                    <div class="modal fade" id="modal-delete-classroom{{$my_classroom->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('myclass.delete_class') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        {{-- start form --}}
                                                        <form action="{{ route('classrooms.destroy', $my_classroom->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="form-group text-center">
                                                                        <p>{{ trans('grades.before_delete_alert') }}</p>
                                                                        <p><strong>{{$my_classroom->class_name}}</strong></p>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content text-center border-top">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-md btn-danger">
                                                                            <i class="fa fa-fw fa-times mr-1"></i> {{ trans('grades.yes') }}
                                                                        </button>
                                                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.no') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        {{-- End form --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END delete modal Content -->

                                    <!-- edit modal Content -->
                                    <div class="modal fade" id="modal-edit-classroom{{$my_classroom->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('grades.edit_grade') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        <form action="{{ route('classrooms.update', $my_classroom) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="ar_grade">{{ trans('myclass.name_class') }}</label>
                                                                        <input id="ar_grade" type="text" class="form-control form-control-alt" value="{{ $my_classroom->getTranslation('class_name', 'ar') }}"
                                                                                name="class_name" placeholder="{{ trans('myclass.name_class') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-xl-6">
                                                                    <div class="form-group">
                                                                        <label for="ar_grade">{{ trans('myclass.name_class_en') }}</label>
                                                                        <input type="text" class="form-control form-control-alt" id="ar_grade" placeholder="{{ trans('myclass.name_class_en') }}"
                                                                                name="class_name_en" value="{{ $my_classroom->getTranslation('class_name', 'en') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-xl-12">
                                                                    <div class="form-group">
                                                                        <label for="grade_id">{{ trans('grades.grade_name') }}</label>
                                                                        <select class="form-control form-control-alt" name="grade_id" id="grade_id">
                                                                            @foreach ($grades as $grade)
                                                                                <option value="{{ $grade->id }}" {{ ($grade->id == $my_classroom->grade_id) ? 'selected' : "" }} >{{$grade->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content text-left border-top">
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                                        <button type="submit" class="btn btn-md btn-primary">
                                                                            <i class="fa fa-fw fa-check"></i> {{ trans('grades.update') }}
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END edit modal Content -->

                                    <!-- start delete_all modal -->
                                    <div class="modal fade" id="delete_all_classrooms" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('myclass.delete_class') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        {{-- start form --}}
                                                        <form action="{{ route('delete_all_classrooms') }}" method="POST">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="form-group text-center text-capitalize">
                                                                        <p>{{ trans('myclass.warning_grade') }}</p>

                                                                    </div>
                                                                    <input id="delete_all_id" type="hidden" name="delete_all_id" value="">
                                                                </div>
                                                                <div class="block-content text-center border-top">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-md btn-danger">
                                                                            <i class="fa fa-fw fa-times mr-1"></i> {{ trans('grades.yes') }}
                                                                        </button>
                                                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.no') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        {{-- End form --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END delete delete_all modal -->
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- END Dynamic Table Full -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection

@section('scripts')
    <script>

        $('#add_more').on('click', function () {
            let MyFormInputes =  $('#jsAddAnotherData');
            let html_data =    `<div class="row my-block p-3">
                                <div class="col-lg-6 col-md-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="name">{{ trans('myclass.name_class') }}</label>
                                        <input type="text" class="form-control form-control-alt" id="name"
                                                name="class_name" placeholder="{{ trans('myclass.name_class') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xl-6">
                                    <div class="form-group">
                                        <label for="en_name">{{ trans('myclass.name_class_en') }}</label>
                                        <input id="en_name" type="text" class="form-control form-control-alt"
                                        name="class_name_en" placeholder="{{ trans('myclass.name_class_en') }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-12">
                                    <div class="form-group">
                                        <label for="grade_id">{{ trans('myclass.name_grade') }}</label>
                                        <select class="form-control form-control-alt" name="grade_id" id="grade_id">
                                            @foreach ($grades as $grade)
                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div></div>`;
            MyFormInputes.append(html_data);

        });

        @if (isset($classes))



        function getDataNow() {
            $.ajax({
                url: "{{ route('classrooms.create') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Handle a successful response
                    console.log(response);
                    // window.location.reload();
                    // Do something with the data
                    var table_data, modal_edit, modal_delete;
                    var newDatatr = [];
                    var newModals = [];
                    $('tbody').children().remove();
                    $('.odd').hide();
                    for (i = 0; i < response.classes.length; i++) {
                        table_data = `
                            <tr>
                                <td class="text-center"><input type="checkbox" value="${response.classes[i].id}" class="box1"></td>
                                <td class="text-center font-size-sm">${i + 1}</td>
                                <td class="font-w600 font-size-sm"><a href="#">${response.classes[i].class_name.en}</a></td>
                                <td class="text-center">${response.classes[i].grade_id}</td>
                                <td>
                                    <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-start">
                                    <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#modal-edit-classroom${response.classes[i].id}">
                                        <i class="fa fa-fw fa-edit mr-1"></i> edit
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-delete-classroom${response.classes[i].id}">
                                        <i class="fa fa-fw fa-times mr-1"></i> delete
                                    </button>
                                    </div>
                                </td>
                            </tr>`;

                        modal_delete = `<!-- start delete modal Content -->
                            <div class="modal fade" id="modal-delete-classroom${response.classes[i].id}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="block block-rounded block-themed block-transparent mb-0">
                                            <div class="block-header bg-primary-dark">
                                                <h3 class="block-title">Delete Class</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content font-size-sm">
                                                <!-- start form -->
                                                <form action="{{ route('classrooms.destroy', $my_classroom) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="row">
                                                        <div class="col-lg-12 col-xl-12">
                                                            <div class="form-group text-center">
                                                                <p>{{ trans('grades.before_delete_alert') }}</p>
                                                                <p><strong>${response.classes[i].id}</strong></p>
                                                            </div>
                                                        </div>
                                                        <div class="block-content text-center border-top">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-md btn-danger">
                                                                    <i class="fa fa-fw fa-times mr-1"></i> yes
                                                                </button>
                                                                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">No</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- End form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END delete modal Content -->`;

                        modal_edit = `<!-- edit modal Content -->
                            <div class="modal fade" id="modal-edit-classroom${response.classes[i].id}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="block block-rounded block-themed block-transparent mb-0">
                                            <div class="block-header bg-primary-dark">
                                                <h3 class="block-title">{{ trans('grades.edit_grade') }}</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                        <i class="fa fa-fw fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content font-size-sm">
                                                <form action="{{ route('classrooms.update', $my_classroom) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="ar_grade">{{ trans('myclass.name_class') }}</label>
                                                                <input id="ar_grade" type="text" class="form-control form-control-alt" value="${response.classes[i].class_name.ar}"
                                                                        name="class_name" placeholder="{{ trans('myclass.name_class') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xl-6">
                                                            <div class="form-group">
                                                                <label for="ar_grade">{{ trans('myclass.name_class_en') }}</label>
                                                                <input type="text" class="form-control form-control-alt" id="ar_grade" placeholder="{{ trans('myclass.name_class_en') }}"
                                                                        name="class_name_en" value="${response.classes[i].class_name.en}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-xl-12">
                                                            <div class="form-group">
                                                                <label for="grade_id">{{ trans('grades.grade_name') }}</label>
                                                                <select class="form-control form-control-alt" name="grade_id" id="grade_id">
                                                                    @foreach ($grades as $grade)
                                                                        <option value="{{ $grade->id }}" {{ ($grade->id == $my_classroom->grade_id) ? 'selected' : "" }} >{{$grade->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="block-content text-left border-top">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                                <button type="submit" class="btn btn-md btn-primary">
                                                                    <i class="fa fa-fw fa-check"></i> {{ trans('grades.update') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END edit modal Content -->`;

                            newDatatr[i] = table_data;
                            newModals[i] = modal_delete + modal_edit;
                            console.log(newDatatr[i]);
                        }

                    $('tbody').append(newDatatr.join(''));
                    $('.table').append(newModals.join(''));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle an error response
                    console.error(jqXHR.responseText);
                    alert('An error occurred while getting the data');
                }
            });

        }
        @endif

        $('#insert_classes').on('click', function (e) {
            e.preventDefault();


            const form = document.querySelector('#classes_add');
            const formData = [];
            const blocks = form.querySelectorAll('.my-block'); // replace with the class name of your block

            for (let block of blocks) {
            const data = {};
            for (let input of block.querySelectorAll('input, select')) {
                if (input.name) {
                data[input.name] = input.value;
                }
            }
            formData.push(data);
            }

            var jsonData = JSON.stringify(formData);

            // console.log(jsonData);

            $.ajax({
                url: "{{ route('classrooms.store') }}",
                method: 'POST',
                dataType: "json",
                data: jsonData,
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    console.log(response); // handle the response from the server
                    if (response.message == 'Data saved successfully') {
                       console.log('data Sent');
                       getDataNow();
                    } else {
                        alert('controller error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(errorThrown); // handle any errors
                }
            });

        });

        // Delete Seleceted Button
        function CheckAll(className, elem) {
            var elements = document.getElementsByClassName(className);
            var l = elements.length;

            if (elem.checked) {
                for (var i=0; i < l; i++) {
                    elements[i].checked = true;
                }
            } else {
               // $('#btn_delete_all').hide();
                for (var i=0; i < l; i++) {
                    elements[i].checked = false;
                }
            }

        }

        $('#btn_delete_all').on('click', function () {
            var selected = new Array();
            $('#datatable input[type=checkbox]:checked').each(function () {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all_classrooms').modal('show');
                $('input[id="delete_all_id"]').val(selected);
            }
        });
        // End Delete Seleceted Button





    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
