@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Complain Dashboard') }}</div>
                <div class="card-body">
                   <h3>New</h3>
                    <table class="table table-striped table-bordered  table-sm">
                        <thead>
                            <th>sn</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Function</th>
                        </thead>
                        @foreach (\Illuminate\Support\Facades\DB::table('helps')->where('status', 0)->get() as $key => $complain)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$complain->email}}</td>
                                <td>{{$complain->message}}</td>
                                <td><!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                                      Respond
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Response Text</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <form action="{{route('save.response')}}" method="post">
                                            @csrf
                                          <div class="modal-body">
                                                <input type="hidden" name="respid" value="{{$complain->id}}">
                                                <div class="form-groug">
                                                    <textarea name="response" class="form-control" placeholder="Add Response Text"></textarea>
                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Respond</button>
                                          </div>
                                        </form>

                                        </div>
                                      </div>
                                    </div></td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                   <h3>Responded</h3>
                    <hr>
                    <table class="table table-striped table-bordered  table-sm">
                        <thead>
                            <th>sn</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Response</th>
                        </thead>
                        @foreach (\Illuminate\Support\Facades\DB::table('helps')->where('status', 1)->get() as $key => $complain)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$complain->email}}</td>
                                <td>{{$complain->message}}</td>
                                <td>{{$complain->response}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
