@extends('layout')
@section('module')
Paises
@stop
@section('base_url')
<base href="{{URL::to('/')}}/paises"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="paises">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/paises/app.js"></script>
    <script src="/js/app/paises/controllers.js"></script>
@stop

@stop