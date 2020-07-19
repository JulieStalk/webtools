@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Organisation') }}</div>
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
                        <form method="post" action="{{ route('organisations.update', $organisation->id) }}">
                            @method('PATCH') 
                            @csrf
                            <div class="form-group">    
                                <label for="name">Organisation Name:</label>
                                <input type="text" class="form-control" name="name"  value="{{ $organisation->name }}"  />
                            </div>
                            <div class="form-group">
                                <label for="website">Website:</label>
                                <input type="website" class="form-control" name="website" value="{{ $organisation->website }}" />
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="phone" class="form-control" name="phone" value="{{ $organisation->phone }}"/>
                            </div>
                            <div class="form-group"> <!-- in real app would have city, address2 & postcode fields-->
                                <label for="address">Address:</label>
                                <input type="address" class="form-control" name="address" value="{{ $organisation->address }}"/>
                            </div>
                            <div class="form-group"> <!-- in real app coming from a country table-->
                                <label for="country">Country</label>
                                <select class="form-control" id="country" name="country">
                                    <option value="New_Zealand" @if( $organisation->country == "New Zealand" ){ selected = 'selected' } @endif >New Zealand</option>
                                    <option value="Australia" @if( $organisation->country == "Australia" ){ selected = 'selected' } @endif >Australia</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update Organisation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection