@extends('layouts.admin')
@section('content')
    @include('includes.content-wrapper',['page'=>'Companies'])
    <section class="content mb-5">
        <form action="{{route('companies.update',$company->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Update Company</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{$company->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{$company->email}}">
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" id="website" class="form-control" name="website"
                               value="{{$company->website}}">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" id="logo" class="form-control" name="logo">
                        <img class="mt-3" src="{{url('storage/images/'.$company->logo)}}" style="width: 100px; height: 100px">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12">
                    <a href="{{route('companies.index')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Update the company</button>
                </div>
            </div>
        </form>
    </section>

@endsection
