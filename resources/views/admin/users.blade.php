@extends('layouts.admin')

@section('title')
{{ trans('admin.users_title') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
@if ( $errors->any() )
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <strong> {{ $error }} </strong>
        </div>
    @endforeach
@endif

@if (session('message'))
    <div class="alert alert-warning" role="alert">
        <strong> {{ session('message') }} </strong>
    </div>
@endif

<div class="card-body">
    <table id="table1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> {{ trans('admin.name') }} </th>
                <th> {{ trans('admin.email') }} </th>
                <th> {{ trans('admin.country') }} </th>
                <th> {{ trans('admin.phone') }} </th>
                <th> {{ trans('admin.created_at') }} </th>
                <th> {{ trans('admin.roles') }} </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->country->name }} </td>
                    <td> {{ $user->country->phone_code }} {{ $user->phone }} </td>
                    <td> {{ $user->created_at }} </td>
                    <td>
                        @if ($user->id != Auth::user()->id)
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#edit-roles-modal-{{ $user->id }}">
                                <ul>
                                    @foreach ($user->roles as $role)
                                        <li> {{ $role->name }} </li>
                                    @endforeach
                                </ul>
                            </button>

                            <div class="modal fade" id="edit-roles-modal-{{ $user->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-default">
                                        <div class="modal-header">
                                            <h4 class="modal-title"> {{ trans('admin.edit') }} </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="{{ route('admin_users_update', ['id' => $user->id]) }}">
                                            {{ csrf_field() }}
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <td></td>
                                                        <td>{{ config('default.yes') }}</td>
                                                        <td>{{ config('default.no') }}</td>
                                                    </tr>

                                                    @foreach ($roles as $role)
                                                        @if (($role->name != 'normal') && ($role->name != 'root'))
                                                            <tr>
                                                                <td>{{ $role->name }}</td>
                                                                @role('root')
                                                                    @if ($user->hasRole($role->name))
                                                                        <td>
                                                                            <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="1" checked>
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="0">
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="0" checked>
                                                                        </td>
                                                                    @endif
                                                                @else
                                                                    @if ($role->name == 'admin')
                                                                        @if ($user->hasRole($role->name))
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="1" checked readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="0" readonly>
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="1" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="0" checked readonly>
                                                                            </td>
                                                                        @endif
                                                                    @else
                                                                        @if ($user->hasRole($role->name))
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="1" checked>
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="0">
                                                                            </td>
                                                                        @else
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="1">
                                                                            </td>
                                                                            <td>
                                                                                <input type="radio" name="{{ config('default.rolerq') }}{{ $role->id }}" value="0" checked>
                                                                            </td>
                                                                        @endif
                                                                    @endif
                                                                @endrole 
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>{{ $role->name }}</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    {{ trans('admin.close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ trans('admin.update') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <ul>
                                @foreach ($user->roles as $role)
                                    <li><b><i> {{ $role->name }} </i></b></li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('js')
<script src="{{ asset('bower_components/adminlte3/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/datatable.js') }}"></script>
@endsection
