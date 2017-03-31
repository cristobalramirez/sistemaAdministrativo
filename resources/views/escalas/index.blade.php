@extends('layout')
@section('module')
Ediciones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/escalas"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="escalas">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/escalas/app.js"></script>
    <script src="/js/app/escalas/controllers.js"></script>
@stop

@stop