@extends('admin.layouts.master')



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Services</h4>
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="panel-body">
                <!-- <div style="padding-bottom: 10px;">
                    <a href="{{url('admin/user/create')}}" class="btn btn-success"> <i class="fa fa-plus"></i> Create </a>
                </div> -->
                <div class="table-responsive">
                    <table class="table" id="service_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Key</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $i => $service)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$service->key}}</td>
                                <td>{{$service->value}}</td>
                                <td>
                                <a href="{{url('admin/content/service/edit/'.$service->id)}}" class="btn btn-info">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script>
    $('#service_table').dataTable();
    console.log('ok')
</script>
@stop