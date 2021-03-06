@php
use Capmega\Base\Widgets\Grid\Details;
use Capmega\Base\Widgets\Information\BreadCrumb;
@endphp
@extends('base::layouts.main')

@section('title_tab', __('blog::blog.detail_blogs'))

@section('breadcrumb')
    <?= BreadCrumb::generate([
        'blog.index' => __('blog::blog.blogs'),
        'Active'     => __('blog::blog.detail_blogs'),
        ]) ?>
@endsection
@section('content')
    @card({{__('blog::blog.detail_blogs')}})
    <?= Details::generate($model, [
        'name',
        'description',
        'created_at',
        [
            'attribute' => 'created_by',
            'value' => function($model){
                return $model->createdBy->name;
            }
        ],
    ])
    ?>
    @endcard()
@endsection
