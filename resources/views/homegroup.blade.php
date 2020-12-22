@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                Please check the form below for errors
            </div>
            @endif
            <form action="{{route('group.store')}}" id="usersForm" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="text-uppercase col-sm-6">
                                <a href="/group" class="btn btn-outline-info btn-sm">{{ __('Groups') }}</a></div>
                            <div class="fom-group col-sm-6">
                                <label for="homecounty">Select Home county</label>
                                <select name="homecounty" id="homecounty" class="form-control" required>
                                    <option value="" selected disabled>Select Home County</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="usersTable-container">
                            <div class="form-group">
                                <label>Group Name:</label>
                                <div class="">
                                    <input type="text" name="groupName" id="groupName" class="form-control" required>
                                </div>
                            </div>
                            <input type="hidden" name="adminId" value="{{Auth::user()->id}}">
                            <table class="table table-bordered table-striped" id="usersTable">
                                <thead>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Registration Number</th>
                                    <th>Date Joined</th>
                                </thead>
                                <tbody id="userData">
                                </tbody>
                                <tfoot>
                                    <th>Select</th>
                                    <th>Name</th>
                                    <th>Registration Number</th>
                                    <th>Date Joined</th>
                                </tfoot>
                            </table>
                            <button type="submit" class="btn btn-success btn-sm">+ Create Group</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        // initialize datatables
        // $('#usersTable').DataTable();
        // hide users table on load
        $('.usersTable-container').hide();

        $.ajax({
            url:'/counties',
            type:'get',
            dataType:'json',
            success: function(data){
                $.each(data, function(key, value){
                  $('#homecounty').append('<option value='+value.name+'>'+value.name+'</option>')
                });
                // console.log(JSON.stringify(data))
            },
            error: function(err){
                console.log(err)
            }
        });
        // on change search for users
        $('#homecounty').on('change', function(){
            // hide if it was initially open
            $('.usersTable-container').hide(800);
            // search for users in this county
            $.ajax({
                url:'/users/'+$(this).val(),
                type:'get',
                dataType:'json',
                success: function(data){
                    // console.log(data)
                if (data.length == 0) {
                alert('No user data for selected county')
                }else{
                // show the table
                    $('.usersTable-container').show(1000);
                    // clear initial user data
                    $('#userData').html('');
                // append the user rows
                $.each(data, function(key, value){
                    $('#userData').append(
                        '<tr><td><input type="checkbox" value='+value.id+' name="groupUser[]"/></td><td>'+value.username+'</td><td>'+value.regnumber+'</td><td>'+(new Date(value.created_at)).toDateString()+'</td></tr>'
                    );
                })
                }

                }
            })
        })
        $('#usersForm').on('submit', function(e){
            // e.preventDefault();
            console.log($(this).serializeArray())
        })
    })
</script>
@endsection
