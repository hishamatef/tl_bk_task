@extends('layouts.app')

@section('content')
    <div class="pt-md-6">
        <div class="container-fluid">
            <div class="">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0">{{__('student.students')}}</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('students.index') }}">
                                        {{__('student.students')}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('student.show_student')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card mg-b-20">
                    <div class="">
                        <div class="pl-0">
                            <div class="main-profile-overview">
                                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                    <div class="tab-pane active" id="home">
                                        <p class="m-b-5">{{__('public.name')}} : {{$student->name}}</p>
                                    </div>
                                </div>

                                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                    <div class="tab-pane active" id="home">
                                        <p class="m-b-5">{{__('school.school')}} : {{$student->school->name}}</p>
                                    </div>
                                </div>

                                <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                    <div class="tab-pane active" id="home">
                                        <p class="m-b-5">{{__('public.order')}} : {{$student->order}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
