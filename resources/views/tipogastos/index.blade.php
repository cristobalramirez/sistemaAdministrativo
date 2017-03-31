@extends('layout')
@section('module')
Ediciones
@stop
@section('base_url')
<base href="{{URL::to('/')}}/tipogastos"/>
@stop
@section('css-customize')
@stop
@section('content')
<section ng-app="tipogastos">
    <div ng-view>

    </div>
</section>

@section('js-customize')
<script src="/js/app/tipogastos/app.js"></script>
    <script src="/js/app/tipogastos/controllers.js"></script>
@stop

@stop