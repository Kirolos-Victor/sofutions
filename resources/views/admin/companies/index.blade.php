@extends('layouts.admin')

@section('content')
    @include('includes.content-wrapper',['page'=>'Companies'])
    <!-- Main content -->
    <company-index></company-index>
    <!-- /.content -->

@endsection
