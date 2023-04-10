@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a class="mb-4 btn btn-success" href="{{ route('employees.create') }}" role="button">Create New Employee</a>
        </div>
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <div class="mb-4 col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive-md">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Phone</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $key => $employee)
                                <tr>
                                    <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->company->name }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="{{route('employees.edit', $employee->id)}}" role="button" class="btn btn-light btn-sm">Edit</a>
                                            <form method="post" action="{{route('employees.destroy', $employee->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button role="button" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @if(count($employees) == 0)
                                <tr>
                                    <td class="text-center p-4" colspan="5">No Data</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            {!! $employees->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
