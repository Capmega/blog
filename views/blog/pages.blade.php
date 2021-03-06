@php
use Capmega\Base\Widgets\Information\BreadCrumb;
use Capmega\Base\Widgets\Messages\Error;
use Capmega\Base\Widgets\Form\ActiveField;
use Capmega\Base\Widgets\Grid\GridView;

@endphp
@extends('base::layouts.main')

@section('title_tab', __('base::app.update', ['name' => $name]))

@section('breadcrumb')
    <?= BreadCrumb::generate([
        'Active' => __('base::app.update', ['name' => $name]),
        ]) ?>
@endsection

@section('content')
    @card({{__('base::app.update', ['name' => $name])}})
    <?= Error::generate($errors) ?>

    <div class="form-group">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#add-page">
            {{__('blog::blog.add-pages', ['page' => $name])}}
        </button>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#edit-page">
            {{__('blog::blog.edit-page')}}
        </button>
    </div>

   <div class="modal fade text-left" id="edit-page" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title" id="myModalLabel17">{{__('blog::blog.edit-page')}}</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
               <form action="{{route('blog-post.pages', $model->identifier)}}" method="post" novalidate>
                   <div class="modal-body">
                       @csrf
                       <div class="form-group">
                           <?= ActiveField::Input($model, 'title')?>
                       </div>
                       <div class="form-group">
                           <?= ActiveField::Input($model, 'subtitle')->textArea()?>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">@lang('base::messages.close')</button>
                       <button type="submit" class="btn btn-primary">@lang('base::messages.save')</button>
                   </div>
               </form>
           </div>
       </div>
   </div>

   <div class="modal fade text-left" id="add-page" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" style="display: none;" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title" id="myModalLabel17">{{__('blog::blog.add-pages', ['page' => $name])}}</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">×</span>
                   </button>
               </div>
               <form action="{{route('blog-post.pages', $model->identifier)}}" method="post" novalidate>
                   <div class="modal-body">
                       @csrf
                       <div class="form-group">
                           <?= ActiveField::Input($post, 'name')?>
                       </div>
                       <div class="form-group">
                           <?= ActiveField::Input($post, 'description')->textArea()?>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">@lang('base::messages.close')</button>
                       <button type="submit" class="btn btn-primary">@lang('base::messages.save')</button>
                   </div>
               </form>
           </div>
       </div>
   </div>

    <?= GridView::generate([
        'search' => false,
        'model'  => $post,
        'models' => $posts,
        'route' => 'blog',
        'action_column' => [
            'class' => new \Capmega\Base\Widgets\Grid\ActionColumn,
            'template' => ['delete'],
            'route' => 'blog-post.pages'
        ],
        'attributes' => [
            'name',
            'description',
            'created_at',
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    return $model->createdBy->name;
                }
            ],
            'status',
        ]
    ])?>
    @endcard()
@endsection
