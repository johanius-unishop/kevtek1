@extends('admin')

{{-- Customize layout sections --}}

@section('title', 'Редактирование вопроса ')
@section('content_header')
<h1>Редактирование вопроса </h1>
@stop

{{-- Content body: main page content --}}
@section('content')
<div class=" py-3  ">
    <a class="btn btn-primary" href="{{ $faq->front_url }}" role="button" target="_blank"><i class="fas fa-globe"></i>
        Просмотреть на сайте</a>
</div>

@include('admin.blocks.error')

<form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="hidden" name="id" value="{{ $faq->id }}">

    <div class="row">
        <div class="col-12 ">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Основное</a>
                        </li>


                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <div class="form-group">
                                        <label for="question">Название</label>
                                        <input type="text" class="form-control" name="question" value="{{ @$faq->question }}">
                                        @error('question')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="answer">Описание</label>
                                <textarea class="form-control" name="answer" row="5" id="summernote">{{ $faq->answer }}</textarea>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="published" id="published" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Да" data-off="Нет" {!! @$page->published ? 'checked ' : ' ' !!}>
                                <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" py-3 form-row justify-content-center">
                <a class="btn   btn-success " href="{{ route('admin.faq.index') }}" role="button"> <i class="fa fa-arrow-left "></i> К списку</a> &nbsp;
                <button type="submit" name="action" value="save" class="btn btn-primary">Сохранить</button>
                &nbsp;
                <button type="submit" name="action" value="save-exit" class="btn btn-primary">Сохранить и
                    закрыть</button>
            </div>
        </div>
    </div>
</form>
@stop

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote.min.css') }}">
@endpush

@push('js')
@include('admin.blocks.summernote')
@endpush
