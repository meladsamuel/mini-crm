@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header">
                    Company
                </h5>
                <div>
                    <img width="100%" src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} logo">
                </div>
                <table class="table table-condensed">
                    <tbody>
                        <tr>
                            <td class="col-xs-4">Name</td>
                            <td>{{ $company->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $company->email?? "-" }}</td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>{{ $company->website?? "-" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header">Employees</h5>
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $key => $employee)
                        <tr>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                        </tr>
                        @endforeach
                        @if(count($employees) == 0)
                        <tr>
                            <td class="text-center p-4" colspan="3">No Data</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            {!! $employees->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
