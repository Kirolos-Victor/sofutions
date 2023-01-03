@extends('layouts.admin')
@section('content')
    @include('includes.content-wrapper',['page'=>'Companies'])
    <section class="content mb-5">
        <form action="{{route('companies.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Create Company</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" id="website" class="form-control" name="website" value="{{old('website')}}">
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" id="logo" class="form-control" name="logo">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-12">
                    <a href="{{route('companies.index')}}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success float-right">Create a new company</button>
                </div>
            </div>
        </form>
    </section>

@endsection
