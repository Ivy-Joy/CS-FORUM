@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">GROUP MEMBERS</div>
                <div class="card-body" style="height: 380px;overflow-y: scroll;">
                    <table class="table table-bordered">
                        <thead>
                            <th>Name</th>
                        </thead>
                        <tbody>
                            @foreach ($user_ids as $user_id)
                                @if($user_id->user_id == Auth::user()->id)
                                    <tr>
                                        <td class="bg-info">You are a Member.</td>
                                    </tr>
                                    @php
                                    $post=true;
                                    @endphp
                                    @break
                                @else
                                     <tr>
                                      <td> <a href="#" class="btn btn-outline-success btn-xs membership" id="{{$group->id}}"> Be a member.</a></td>  
                                    </tr>
                                    @php
                                    $post=false;
                                    @endphp
                                    @break
                                @endif                                
                            @endforeach
                            @foreach ($user_ids as $user_id)
                                <tr>
                                    <td>{{\Illuminate\Support\Facades\DB::table('users')->where('id', $user_id->user_id)->value('fname')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-uppercase">{{$group->groupname}} {{ __('group conversation') }}</div>
                <div class="card-body" style="height: 380px;
                overflow-y: scroll;">
                    {{-- display cnversations --}}
                    @if (count($groupConversations)>0)

                    @foreach ($groupConversations as $item)
                    <p style="clear: both"
                        class="card p-1 @if($item->author_id == Auth::user()->id) float-right @endif">
                        {!! $item->userText !!}
                        <span
                            class="font-weight-bold font-italic">Author: {{\Illuminate\Support\Facades\DB::table('users')->where('id', $item->author_id)->value('fname')}}</span>
                    </p>
                    @endforeach
                    @else
                        <div class="text-info">No conversations yet</div>
                    @endif
                    @if($post)
                    <form action="" id="groupConversation" class="mb-0" style="">
                        <input type="hidden" name="groupid" value="{{$group->id}}">
                        <input type="hidden" name="authorid" value="{{Auth::user()->id}}">
                        <div class="form-group" style="clear: both">
                            <label for="userText">Write Post</label>
                            <textarea name="userText" id="userText" class="form-control"></textarea>
                        </div>
                        <button style="width: 80px" class="btn btn-outline-success text-center float-right btn-sm"
                            type="submit">Post</button>
                    </form>
                    @else
                    <div class="alert alert-danger">You are not a group Member.<a href="#" id="{{$group->id}}" class="membership">Become a member.</a></div>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        // membership
        $('.membership').on('click', function(){
            console.log($(this).attr('id'));
            $.ajax({
                url: '/membership/'+$(this).attr('id'),
                type: 'GET',
                dataType: 'json',
                cache:false,
                success: function(resp){
console.log(resp)
                },
                error: function(err){
console.log(err)
                }
            })
        });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $('#groupConversation').on('submit', function(e){
                e.preventDefault();
                submit();
            });
        function submit(){
            $.ajax({
                "_token": "{{ csrf_token() }}",
                url:'{{route("groupConversation.store")}}',
                type:'POST',
                data: $('#groupConversation').serializeArray(),
                success: function(response){
                    location.reload();
                    console.log(response)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }
    })
</script>
@endsection
