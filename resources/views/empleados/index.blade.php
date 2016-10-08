@extends('layout')
@section('module')
Empleados
@stop
@section('base_url')
<base href="{{URL::to('/')}}/empleados"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="empleados">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/empleados/app.js"></script>
    <script src="/js/app/empleados/controllers.js"></script>
@stop

@stop