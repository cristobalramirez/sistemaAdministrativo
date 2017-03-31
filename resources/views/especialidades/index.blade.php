@extends('layout')
@section('module')
Ediciones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/especialidades"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="especialidades">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/especialidades/app.js"></script>
    <script src="/js/app/especialidades/controllers.js"></script>
@stop

@stop