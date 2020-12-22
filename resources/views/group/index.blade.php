@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('MY GROUPS') }}</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Goup Name</th>
                            <th>Home county</th>
                            <th>Admin</th>
                            @if ($groups[0]->adminId == Auth::user()->id)
                            <th>Operation</th>
                            @endif
                        </thead>
                        <tbody>
                            @if (count($groups)>0)
                            @foreach ($groups as $group)
                            <tr>
                                <td><a href="{{route('group.show',[$group->id])}}">{{$group->groupname}}</a> </td>
                                <td>{{$group->homecounty}}</td>
                                <td>{{\Illuminate\Support\Facades\DB::table('users')->where('id', $group->adminId)->value('fname')}}
                                </td>
                                @if ($group->adminId == Auth::user()->id)
                                <td><a onclick="return confirm('Are you sure ?')" href="{{route('deleteGroup',[$group->id])}}">Trash</a></td>
                                @endif
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
