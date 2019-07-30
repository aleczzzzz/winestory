@extends('app')

@section('content')
    <div class="container">
        <form action="{{ route('users.profile.update') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" value="{{ $profile ? $profile->firstname : null }}" class="form-control" placeholder="Enter First Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" value="{{ $profile ? $profile->lastname : null }}" class="form-control" placeholder="Enter Last Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="middlename">Middlename</label>
                    <input type="text" name="middlename" value="{{ $profile ? $profile->middlename : null }}" class="form-control" placeholder="Enter Middle Name">
                </div>
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="{{ $profile ? $profile->address : null }}" class="form-control" placeholder="Enter Address">
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" name="city" value="{{ $profile ? $profile->city : null }}" class="form-control" placeholder="Enter City">
                </div>
                <div class="form-group col-md-6">
                    <label for="state">State</label>
                    <input type="text" name="state" value="{{ $profile ? $profile->state : null }}" class="form-control" placeholder="Enter State">
                </div>
                <div class="form-group col-md-6">
                    <label for="country">Country</label>
                    <input type="text" name="country" value="{{ $profile ? $profile->country : null }}" class="form-control" placeholder="Enter Country">
                </div>
                <div class="form-group col-md-6">
                    <label for="zip">Zip Code</label>
                    <input type="text" name="zip" value="{{ $profile ? $profile->zip : null }}" class="form-control" placeholder="Enter Zip Code">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" value="{{ $profile ? $profile->phone : null }}" class="form-control" placeholder="Enter Phone Nmber">
                </div>
                <div class="form-group col-md-6">
                    <label for="mobile">Modile Number</label>
                    <input type="text" name="mobile" value="{{ $profile ? $profile->mobile : null }}" class="form-control" placeholder="Enter Mobile Number">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
