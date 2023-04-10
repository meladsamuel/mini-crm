@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-3">
            <div class="card">
                <div class="card-header">
                    Create Company
                </div>
                <div class="card-body">
                    <form class="g-3 needs-validation" novalidate method="POST" action="{{route('companies.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name *</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" placeholder="Enter Company Name">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback is-invalid" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" type="email" name="email" placeholder="Enter Email Address">
                            @if ($errors->has('email'))
                            <span class="invalid-feedback is-invalid" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="website">Website</label>
                            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" id="website" name="website" placeholder="Enter Website Name">
                            @if ($errors->has('website'))
                            <span class="invalid-feedback is-invalid" role="alert">
                                <strong>{{ $errors->first('website') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Company Logo</label>
                            <input name="logo" class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" type="file" id="logo">
                            @if ($errors->has('logo'))
                            <span class="invalid-feedback is-invalid" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
