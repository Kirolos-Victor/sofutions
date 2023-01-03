@extends('layouts.admin')

@section('content')
    @include('includes.content-wrapper',['page'=>'Employees'])
    <!-- Main content -->
    <employee-index></employee-index>
    <!-- /.content -->
@endsection
