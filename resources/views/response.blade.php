@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My responses') }}</div>

                <div class="card-body">
                    <table class="table table-striped table-bordered  table-sm">
                        <thead>
                            <th>sn</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Response</th>
                        </thead>
                        @if (count($responses) > 0)
                        @foreach ($responses as $key => $response)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$response->email}}</td>
                            <td>{{$response->message}}</td>
                            <td>{{$response->response}}</td>
                        </tr>
                        @endforeach
                            @else
                            <tr>
                                <td colspan="4" class="text-center">No Responses</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
