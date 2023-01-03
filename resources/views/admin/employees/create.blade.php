@extends('layouts.admin')
@section('content')
    @include('includes.content-wrapper',['page'=>'Employees'])
    <section class="content mb-5">
        <form action="{{route('employees.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Create Employee</h3>

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
                               value="{{old('first_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name"
                               value="{{old('last_name')}}">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <select class="form-select" name="company_id" id="company">
                            @foreach($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" name="phone" value="{{old('phone')}}">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12">
                    <a href="{{route('employees.index')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Create a new employee</button>
                </div>
            </div>
        </form>
    </section>

@endsection
