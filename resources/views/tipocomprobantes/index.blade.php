@extends('layout')
@section('module')
Ediciones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/tipocomprobantes"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="tipocomprobantes">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/tipocomprobantes/app.js"></script>
    <script src="/js/app/tipocomprobantes/controllers.js"></script>
@stop

@stop