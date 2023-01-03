@extends('layouts.admin')
@section('content')
    @include('includes.content-wrapper',['page'=>'Employees'])
    <section class="content mb-5">
        <form action="{{route('employees.update',$employee->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Update Employee</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" class="form-control" name="first_name"
                               value="{{$employee->first_name}}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name"
                               value="{{$employee->last_name}}">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <select class="form-select" name="company_id" id="company">
                            @foreach($companies as $company)
                                @if($employee->company_id == $company->id)
                                    <option value="{{$company->id}}" selected>{{$company->name}}</option>
                                @else
                                    <option value="{{$company->id}}">{{$company->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{$employee->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" name="phone"
                               value="{{$employee->phone}}">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12">
                    <a href="{{route('employees.index')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Update the employee</button>
                </div>
            </div>
        </form>
    </section>

@endsection
