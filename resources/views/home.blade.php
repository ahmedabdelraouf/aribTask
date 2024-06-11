@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body" style="text-align: center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4>
                            {{ __('Welcome to employee management system!') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
