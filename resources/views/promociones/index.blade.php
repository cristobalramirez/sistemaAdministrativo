@extends('layout')
@section('module')
Promociones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/promociones"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="promociones">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/promociones/app.js"></script>
    <script src="/js/app/promociones/controllers.js"></script>
@stop

@stop