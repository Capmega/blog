@php
use Capmega\Base\Widgets\Information\BreadCrumb;
use Capmega\Base\Widgets\Form\ActiveField;
use Capmega\Base\Widgets\Messages\Error;
@endphp

@extends('base::layouts.main')

@section('title_tab', __('blog::blog.edit_blog'))

@section('breadcrumb')
    <?= BreadCrumb::generate([
        'blog.index' => __('blog::blog.blogs'),
        'Active'     => __('blog::blog.edit_blog'),
        ]) ?>
@endsection

@section('content')
    @card({{__('blog::blog.edit_blog')}})
    <?= Error::generate($errors) ?>
    <form action="{{route('blog.update', $model->seoname)}}" method="post" novalidate>
        @csrf
        @method('PUT')
        @include('blog::blog._form')
    </form>
    @endcard()
@endsection
