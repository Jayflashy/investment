@extends('admin.layouts.master')
@section('title', "Investment Plans")
@section('content')
<div class="col-12">
<div class="card">
    <div class="card-header">
        <div class="align-items-center d-flex justify-content-between">
            <h5>All Plans</h5>
            <a href="{{route('admin.plan.create')}}" class="btn btn-primary">Create Plan</a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Return</th>
                    <th>Duration</th>
                    <th>Invest Period</th>
                    <th>Gross Return</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($plans as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$item->name}}</td>
                    <td><img src="{{my_asset($item->image)}}" alt="{{$item->name}}" height="40px"></td>
                    <td>{{format_price($item->price)}}</td>
                    <td>{{format_price($item->return)}}</td>
                    <td>{{$item->duration}} Hours</td>
                    <td>{{$item->days}} Days</td>
                    <td>{{format_price($item->return * $item->days)}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{route('admin.plan.edit',$item->id)}}" title="edit"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{route('admin.plan.delete',$item->id)}}"><i class="fa fa-trash" title="delete"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
