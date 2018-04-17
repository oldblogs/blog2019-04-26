@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Laravel</div>
                <div class="card-body">
                    <button type="button" class="btn btn-link"><a href="https://laravel.com/docs">Documentation</a></button>
                    <button type="button" class="btn btn-link"><a href="https://laracasts.com">Laracasts</a></button>
                    <button type="button" class="btn btn-link"><a href="https://laravel-news.com">News</a></button>
                    <button type="button" class="btn btn-link"><a href="https://forge.laravel.com">Forge</a></button>
                    <button type="button" class="btn btn-link"><a href="https://github.com/laravel/laravel">GitHub</a></button>
                </div>
            </div>
        </div>

        <example-component></example-component>
        <vue-test></vue-test>

    </div>
</div>
@endsection
