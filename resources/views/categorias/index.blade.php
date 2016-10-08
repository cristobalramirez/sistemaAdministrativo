@extends('layout')
@section('module')
Categorias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/categorias"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="categorias">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/categorias/app.js"></script>
    <script src="/js/app/categorias/controllers.js"></script>
@stop

@stop