@extends('management.layouts.master')
@section('title')
    Permissions  - {{config('app.dashboard')}}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Permissions List</h2>
                <code class="text-danger"><h4>Be Careful Developer Use only</h4></code>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create Permission</a>
                @endcan
            </div>
        </div>
    </div>
{{--    @if ($message = Session::get('success'))--}}
{{--        <div class="alert alert-success">--}}
{{--            <p>{{ $message }}</p>--}}
{{--        </div>--}}
{{--    @endif--}}

<div class="card">
    <div class="body table-responsive">
        <table class="table " id="myTable">
            <thead>
            <tr>
{{--                <th>No</th>--}}
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($roles as $key => $role)
                <tr>
{{--                    <td>{{ ++$i }}</td>--}}
                    <td>{{ $role->name }}</td>
                    <td>
{{--                        <a class="btn btn-info" href="{{ route('permissions.show',$role->id) }}">Show</a>--}}
                        {{--                    @can('role-edit')--}}
                        <a class="btn btn-primary" href="{{ route('permissions.edit',$role->id) }}">Edit</a>
                        {{--                    @endcan--}}
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $role->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>


</div>


{{--    {!! $roles->render() !!}--}}
@endsection
