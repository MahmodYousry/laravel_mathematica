@extends('layouts.master')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        {{ trans('main_trans.students_promotion') }}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('home') }}">{{ trans('main_trans.Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('main_trans.students_promotion') }}</li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->


        @if (App::getLocale() == 'en')
            <?php $textRight = ''; ?>
            <?php $dir = ''; ?>
        @else
            <?php $textRight = 'text-right'; ?>
            <?php $dir = 'dir=rtl'; ?>
        @endif

        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded  block-header-rtl">
                <div class="block-content">
                    {{-- errors And Alerts --}}
                    @include('components.errors')

                    <form action="{{ route('promotion.store') }}" method="POST" {{ $dir }}>
                        @csrf
                        <h2 class="content-heading {{ $textRight }}">{{ trans('main_trans.old_grade') }}</h2>
                        <div class="form-row">
                            <div class="col-xl-3 mb-3">
                                <label>{{ trans('main_trans.old_grade') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>{{ trans('students.classrooms') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="classroom_id">

                                </select>
                            </div>
                            <div class="col-xl-3">
                                <label>{{ trans('students.section') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="section_id">

                                </select>
                            </div>
                            <div class="col-xl-3">
                                <label>{{ trans('students.academic_year') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="academic_year">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year = $current_year; $year <= $current_year +1 ; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <h2 class="content-heading {{ $textRight }}">{{ trans('main_trans.new_grade') }}</h2>
                        <div class="form-row mb-3">
                            <div class="col-xl-3 mb-3">
                                <label>{{ trans('main_trans.new_grade') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="new_grade_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>{{ trans('students.classrooms') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="new_classroom_id">

                                </select>
                            </div>
                            <div class="col-xl-3">
                                <label>{{ trans('students.section') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="new_section_id">

                                </select>
                            </div>
                            <div class="col-xl-3">
                                <label>{{ trans('students.academic_year') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="new_academic_year">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check fa-fw mr-2"></i>{{ trans('main_trans.confirm') }}</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
        $(document).ready(function () {
            $('select[name="new_grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="new_classroom_id"]').empty();
                            $('select[name="new_classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="new_classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('select[name="classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
        $(document).ready(function () {
            $('select[name="new_classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="new_section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="new_section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
