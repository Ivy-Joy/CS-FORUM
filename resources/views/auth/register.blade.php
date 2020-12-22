@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-uppercase text-center h3">{{ __('cs forum registration') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="fname">First Name <span class="text-danger">*</span> </label>
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                                    name="fname" value="{{ old('fname') }}" autocomplete="fname" autofocus>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lName">Last name <span class="text-danger">*</span> </label>
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                                    name="lname" value="{{ old('lname') }}" autocomplete="lname">

                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">{{ __('E-Mail Address') }}
                                    <span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="phoneno">Phone Number <span class="text-danger">*</span></label>
                                <input id="phoneno" type="text"
                                    class="form-control @error('phoneno') is-invalid @enderror" name="phoneno"
                                    value="{{ old('phoneno') }}" autocomplete="phoneno">

                                @error('phoneno')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="htown">Home Town<span class="text-danger">*</span></label>
                                <select name="htown" id="htown"
                                    class="form-control @error('htown') is-invalid @enderror">
                                    <option value="" selected disabled>Select County</option>
                                </select>
                                @error('htown')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                <select name="gender" id="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="male" {{ (old("gender") == 'male' ? "selected":"") }}>Male</option>
                                    <option value="female" {{ (old("gender") == 'female' ? "selected":"") }}>Female
                                    </option>
                                    <option value="other">Other</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="regnumber">Registration Number <span class="text-danger">*</span></label>
                                <input id="regnumber" type="text" class="form-control @error('regnumber') is-invalid @enderror"
                                    name="regnumber" value="{{ old('regnumber') }}" autocomplete="regnumber">

                                @error('regnumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="username">Username<span class="text-danger">*</span></label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" autocomplete="username">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="password">{{ __('Password') }}<span class="text-danger">*</span></label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="">{{ __('Confirm Password') }}<span
                                        class="text-danger">*</span></label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 font-italic font-weight-light">
                                All fields marked <span class="text-danger">*</span> are mandatory
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary ">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $.ajax({
            url:'/counties',
            type:'GET',
            datatype:'json',
            success: function(data){
                // console.log(JSON.stringify(data[0].name))
                $.each(data, function(key, value) {
                    $("#htown").append(
                    '<option value='+value.name+'{{ (old("country") == '+ value.name +' ? "selected":"") }}>' + value.name + '</option>');
                });
            },
            error: function(err){
                console.log(err)
            }
        });
        // regnumber validation
        $('#regnumber').on('change', function(){
            console.log($(this).val());
           var regno = $(this).val().toUpperCase();
           var arrReg = regno.split('/');
                console.log(arrReg)

        // test first part of the registration number
        if (regno.startsWith('CI/',0)) {
            // should be five integer values ../00000/
            if (!((arrReg[1].length == 5) && $.isNumeric(arrReg[1]))) {
                fal();
            }
            if(!$.isNumeric(arrReg[2])){
                fal();
            }

        }else if(regno.startsWith('SB30/PU/',0)){
             // should be five integer values ../00000/
             if (!((arrReg[2].length == 5) && $.isNumeric(arrReg[2]))) {
                fal();
            }
            if(!$.isNumeric(arrReg[3])){
                fal();
            }
        }else{
            fal();
        }
            function fal() {
                alert('This is not a valid Registration Number');
                $('#regnumber').val('');
            }
        })
    })
</script>
@endsection
