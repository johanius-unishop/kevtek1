@extends('admin')

{{-- Customize layout sections --}}

@section('title', 'Редактирование категории товаров')
@section('content_header')
<h1>Редактирование категории товаров</h1>
@stop

{{-- Content body: main page content --}}

@section('content')
<div class=" py-3  ">
    <a class="btn btn-primary" href="{{ $category->front_url }}" role="button" target="_blank"><i class="fas fa-globe"></i>
        Просмотреть на сайте</a>
</div>

@include('admin.blocks.error')


<form action="{{ route('admin.category.update', $category->id) }}" method="POST">

    @csrf
    @method('PATCH')
    <input type="hidden" name="id" value="{{ $category->id }}">

    <div class="row">
        <div class="col-12 ">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Основное</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">SEO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Изображения</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="name">Название</label>
                                        <input type="text" class="form-control" name="name" value="{{ @$category->name }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class=" row">

                                <div class="col-12 mt-2">
                                    <label for="parent_id" class="form-label">Категория</label>
                                    <div class="input-group">
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="">Корневая категория</option>
                                            @foreach ($parentCategories as $category)
                                            @include('admin.blocks.categories_parent_option_row', ['category' => $category, 'padding' =>
                                            ''])
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">

                                        <label for="slug">ЧПУ </label>
                                        <input type="text" class="form-control" name="slug" value="{{ @$category->slug }}">
                                        <div id="slugHelp" class="form-text">Заполняется автоматически. Ручное заполнение не желательно.</div>

                                        @error('slug')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="description">Описание</label>
                                <textarea class="form-control" name="description" row="5" id="summernote">{{ $category->description }}</textarea>
                            </div>


                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="published" id="published" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Да" data-off="Нет" {!! @$category->published ? 'checked ' : ' ' !!}>
                                <label class="form-check-label" for="exampleCheck1">Опубликовано</label>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                            <livewire:seo :record="@$category">


                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                            <livewire:gallery :record="$category" />

                        </div>
                    </div>

                </div>
            </div>
            <div class=" py-3 form-row justify-content-center">
                <a class="btn   btn-success " href="{{ route('admin.category.index') }}" role="button"> <i class="fa fa-arrow-left "></i> К списку</a> &nbsp;
                <button type="submit" class="btn btn-primary">Сохранить</button> &nbsp;
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
