@extends('layouts.app')
@section('content')
<script src="/js/app.js" defer></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div id="app" class="flex justify-center pt-16">
            <weather-app></weather-app>
            </div>
        </div>
    </div>
</div>
@endsection
