@extends('dashboard.includes.content')

@section('head_Content')
    <h1 class="flex-sm-fill h3 my-2">
        {{ trans('main_trans.List_sections') }}
    </h1>
    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">Layout</li>
            <li class="breadcrumb-item">Page</li>
            <li class="breadcrumb-item" aria-current="page">
                <a class="link-fx" href="">Default</a>
            </li>
        </ol>
    </nav>
@endsection

@section('block_content')

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

    <button type="button" class="btn btn-success mr-1 mb-3" data-toggle="modal" data-target="#modal-add-section">
        <i class="fa fa-fw fa-plus mr-1"></i> {{ trans('sections.add_section') }}
    </button>

    <!-- start add modal Content -->
    <div class="modal fade" id="modal-add-section" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">{{ trans('sections.add_section') }}</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm">
                        <form action="{{ route('sections.store') }}" method="POST">
                            @csrf
                            <div class="row classes_add_form">
                                <div class="row my-block p-3">
                                    <div class="col-lg-6 col-md-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="name">{{ trans('sections.Section_name_ar') }}</label>
                                            <input type="text" class="form-control form-control-alt" name="section_name" placeholder="{{ trans('sections.Section_name_ar') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="en_name">{{ trans('sections.Section_name_en') }}</label>
                                            <input id="en_name" type="text" class="form-control form-control-alt"
                                            name="section_name_en" placeholder="{{ trans('sections.Section_name_en') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label for="grade_id">{{ trans('sections.Select_Grade') }}</label>
                                            <select class="form-control form-control-alt" name="grade_id" id="grade_id" onchange="console.log($(this).val())">
                                                <option value="" disabled selected>{{ trans('sections.Select_Grade') }}</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label for="class_name">{{ trans('sections.Name_Class') }}</label>
                                            <select class="custom-select form-control form-control-alt" name="class_id">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="block-content text-left border-top">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                        <button type="submit" class="btn btn-md btn-primary">
                                            <i class="fa fa-fw fa-check"></i> {{ trans('grades.save') }}
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
    <!-- End add modal Content -->

    @foreach ($grades as $grade)
        <!-- Start Sections -->
        <div id="faq{{ $grade->id }}" class="mb-3" role="tablist" aria-multiselectable="true">
            <div class="block block-rounded block-bordered mb-1">
                <div class="block-header block-header-default" role="tab" id="faq{{ $grade->id }}_h{{ $grade->id }}">
                    <a class="text-muted" data-toggle="collapse" data-parent="#faq{{ $grade->id }}" href="#faq{{ $grade->id }}_q{{ $grade->id }}" aria-expanded="true" aria-controls="faq{{ $grade->id }}_q{{ $grade->id }}">
                        <i class="fa fa-plus mr-2"></i> {{ $grade->name }}
                    </a>
                </div>
                <div id="faq{{ $grade->id }}_q{{ $grade->id }}" class="collapse" role="tabpanel" aria-labelledby="faq{{ $grade->id }}_h{{ $grade->id }}" data-parent="#faq{{ $grade->id }}">
                    <div class="block-content">
                        <!-- Start Dynamic Table -->
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                        <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 60px;">ID</th>
                                    <th>{{ trans('sections.Name_Section') }}</th>
                                    <th>{{ trans('sections.Name_Class') }}</th>
                                    <th>{{ trans('sections.Status') }}</th>
                                    <th style="width: 15%;">{{ trans('grades.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grade->sections as $list_sections)
                                    <tr>
                                        <td class="text-center font-size-sm">{{ $loop->iteration }}</td>
                                        <td class="font-w600 font-size-sm"><a href="#">{{ $list_sections->section_name }}</a></td>
                                        <td class="font-w600 font-size-sm">{{ $list_sections->classroom->class_name }}</td>
                                        <td>
                                            @if ($list_sections->Status === 1)
                                                <label class="badge badge-success">{{ trans('sections.Status_Section_AC') }}</label>
                                            @else
                                                <label class="badge badge-danger">{{ trans('sections.Status_Section_No') }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-start">
                                                <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                                            data-target="#modal-edit-section{{ $list_sections->id }}">
                                                    <i class="fa fa-fw fa-edit mr-1"></i> {{ trans('grades.edit') }}
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger m-1" data-toggle="modal"
                                                            data-target="#modal-delete-section{{$list_sections->id}}">
                                                    <i class="fa fa-fw fa-times mr-1"></i> {{ trans('grades.delete') }}
                                                </button>
                                            </div>
                                        </td>

                                        <!-- start edit section modal -->
                                        <div class="modal fade" id="modal-edit-section{{ $list_sections->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-rounded block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">{{ trans('sections.edit_Section') }}</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                    <i class="fa fa-fw fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="block-content font-size-sm">
                                                            <form action="{{ route('sections.update', $list_sections) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="row classes_add_form">
                                                                    <div class="row my-block p-3">
                                                                        <div class="col-lg-6 col-md-6 col-xl-6">
                                                                            <div class="form-group">
                                                                                <label for="name">{{ trans('sections.Section_name_ar') }}</label>
                                                                                <input type="text" class="form-control form-control-alt" name="section_name" value="{{ $list_sections->getTranslation('section_name', 'ar') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-xl-6">
                                                                            <div class="form-group">
                                                                                <label for="en_name">{{ trans('sections.Section_name_en') }}</label>
                                                                                <input id="en_name" type="text" class="form-control form-control-alt"
                                                                                name="section_name_en" value="{{ $list_sections->getTranslation('section_name', 'en') }}">
                                                                                <input type="hidden" name="id" value="{{ $list_sections->id }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <div class="form-group">
                                                                                <label for="grade_id">{{ trans('sections.Select_Grade') }}</label>
                                                                                <select class="form-control form-control-alt" name="grade_id" id="grade_id">
                                                                                    @foreach ($grades as $grade)
                                                                                        <option value="{{ $grade->id }}" {{ ($grade->id == $list_sections->grade_id) ? 'selected' : "" }} >{{$grade->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <div class="form-group">
                                                                                <label for="class_name">{{ trans('sections.Name_Class') }}</label>
                                                                                <select class="custom-select form-control form-control-alt" name="class_id">
                                                                                    <option value="{{ $list_sections->classroom->id }}">{{ $list_sections->classroom->class_name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-xl-12">
                                                                            <div class="form-group">
                                                                                <label class="d-block">Section Status</label>
                                                                                <div class="custom-control custom-checkbox custom-control-success custom-control-lg custom-control-inline">
                                                                                    <input type="checkbox" class="custom-control-input" name="Status"
                                                                                    {{ ($list_sections->Status === 1) ? 'checked' : "" }} id="section_status{{$list_sections->id}}">
                                                                                    <label class="custom-control-label" for="section_status{{$list_sections->id}}">{{ trans('sections.Status') }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="block-content text-left border-top">
                                                                        <div class="form-group">
                                                                            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                                            <button type="submit" class="btn btn-md btn-primary">
                                                                                <i class="fa fa-fw fa-check"></i> {{ trans('grades.save') }}
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
                                        <!-- End edit section modal -->

                                        <!-- start delete section modal -->
                                        <div class="modal fade" id="modal-delete-section{{$list_sections->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="block block-rounded block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">{{ trans('sections.delete_class') }}</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                    <i class="fa fa-fw fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="block-content font-size-sm">
                                                            {{-- start form --}}
                                                            <form action="{{ route('sections.destroy', $list_sections->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-xl-12">
                                                                        <div class="form-group text-center">
                                                                            <input type="hidden" name="id" class="form-control" value="{{ $list_sections->id }}">
                                                                            <p>{{ trans('grades.before_delete_alert') }}</p>
                                                                            <p><strong>{{$list_sections->section_name}}</strong></p>
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
                                        <!-- END delete section modal -->

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- END Dynamic Table -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sections -->
    @endforeach

@endsection


@section('scripts')

    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('classes') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="class_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not working - Look at sections view page');
                }
            });
        });
    </script>

@endsection
