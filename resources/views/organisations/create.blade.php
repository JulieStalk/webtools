@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add an Organisation') }}</div>
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
                        <form method="post" action="{{ route('organisations.store') }}">
                            @csrf
                            <div class="form-group">    
                                <label for="name">Organisation Name:</label>
                                <input type="text" class="form-control" name="name"/>
                            </div>
                            <div class="form-group">
                                <label for="webstie">Website:</label>
                                <input type="text" class="form-control" name="website"/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="phone" class="form-control" name="phone"/>
                            </div>
                            <div class="form-group"> <!-- in real app would have city, address2 & postcode fields-->
                                <label for="address">Address:</label>
                                <input type="address" class="form-control" name="address"/>
                            </div>
                            <div class="form-group"> <!-- in real app coming from a country table-->
                                <label for="country">Country</label>
                                <select class="form-control" id="country" name="country">
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Australia">Australia</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Organisation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection