@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit user') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                        @endif
                        <form method="post" action="{{ route('users.update', $user->id) }}">
                            @method('PATCH') 
                            @csrf
                            <div class="form-group">    
                                <label for="name">User Full Name:</label>
                                <input type="text" class="form-control" name="name"  value="{{ $user->name }}"  />
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password"/>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role">
                                    <option value="employee" @if( $user->role == "employee" ){ selected = 'selected' } @endif >Employee</option>
                                    <option value="admin" @if( $user->role == "admin" ){ selected = 'selected' } @endif >Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection