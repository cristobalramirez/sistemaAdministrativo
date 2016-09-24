@extends('layout')
@section('module')
Ediciones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/ediciones"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="ediciones">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/ediciones/app.js"></script>
    <script src="/js/app/ediciones/controllers.js"></script>
@stop

@stop