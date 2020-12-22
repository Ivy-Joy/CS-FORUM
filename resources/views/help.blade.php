@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Write to us') }}</div>
                <div class="card-body">
                    <form action="{{route('save.help')}}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="{{old('email', Auth::user()->email)}}"  required>
                        </div>
                        <div class="form-group">
                            <label for="email">Message</label>
                            <textarea name="message" id="message" class="form-control" required></textarea>
                        </div>
                        <button class="btn btn-outline-success btn-sm float-right" type="submit">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
