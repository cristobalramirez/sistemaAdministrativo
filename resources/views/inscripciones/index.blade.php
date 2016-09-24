@extends('layout')
@section('module')
Inscripciones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/inscripciones"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="inscripciones">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/inscripciones/app.js"></script>
    <script src="/js/app/inscripciones/controllers.js"></script>
@stop

@stop