@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-12">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}  
                            </div>
                        @endif
                        @if(session()->get('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}  
                            </div>
                        @endif                        
                    </div>

                    <form action="/search" method="POST" role="search">
                        @csrf
                        <div class="mb-2 input-group">
                            <input type="text" class="form-control" name="q"
                                placeholder="Search users name or email"> 
                                <button type="submit" class="btn btn-secondary">
                                    Search<span class="glyphicon glyphicon-search">
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                           <h2> {{ __('Users') }} </h2>
                        </div>
                        <div>
                            <a href="{{ route('users.create')}}" class="btn btn-primary">Add New user</a>
                        </div>  
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Role</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($users)) 
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                                        @if (Auth::user()->can('update',  App\Models\User::find($user->id)))
                                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                                        @else
                                            <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary disabled">Edit</a>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                        @csrf                                        
                                        @if (Auth::user()->can('delete',  App\Models\User::find($user->id)))
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        @else
                                            <button class="btn btn-danger" disabled type="submit">Delete</button>
                                        @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if(!empty($users)) 
                        {{ $users->links() }}            
                    @endif
                <div>
            </div>
        </div>
    </div>
</div>
@endsection