@extends('layout')
@section('module')
Agencias
@stop
@section('base_url')
<base href="{{URL::to('/')}}/agencias"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="agencias">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/agencias/app.js"></script>
    <script src="/js/app/agencias/controllers.js"></script>
@stop

@stop