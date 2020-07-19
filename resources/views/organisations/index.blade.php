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
                    </div>

                    <form action="/search-org" method="POST" role="search">
                        @csrf
                        <div class="mb-2 input-group">
                            <input type="text" class="form-control" name="q"
                                placeholder="Search organisation name"> 
                                <button type="submit" class="btn btn-secondary">
                                    Search<span class="glyphicon glyphicon-search">
                                </button>
                            </span>
                        </div>
                    </form>

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                           <h2> {{ __('Organisations') }} </h2>
                        </div>
                        <div>
                            <a href="{{ route('organisations.create')}}" class="btn btn-primary">Add New Organisation</a>
                        </div>  
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Phone</td>
                            <td>Country</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($organisations)) 
                                @foreach($organisations as $organisation)
                                <tr>
                                    <td>{{$organisation->id}}</td>
                                    <td>{{$organisation->name}}</td>
                                    <td>{{$organisation->phone}}</td>
                                    <td>{{$organisation->country}}</td>                                    
                                    <td>
                                        <a href="{{ route('organisations.edit',$organisation->id)}}" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('organisations.destroy', $organisation->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @if(!empty($organisations)) 
                        {{ $organisations->links() }}            
                    @endif
                <div>
            </div>
        </div>
    </div>
</div>
@endsection