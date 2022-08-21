<?php 
    use App\Helper\general;
?>
@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Earnings</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li><a href="{{ url('admin/earnings') }}">Earnings</a></li>
            <li class="active">Earning Details</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Earning Details</h4>
            </div>
            @if (\Session::has('error'))
                <div class="alert alert-warning">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <div class="panel-body">
                <div style="padding-bottom: 10px;">
                    <h2>Details of Earnings for {!! $name !!}</h2>
                </div>
                
                <div class="table-responsive">
                    <table class="display nowrap" id="role_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>#</th>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Earning</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_arr as $i => $data)
                            <tr>
                                <td>{{ $data['id'] }}</td>                                
                                <td>{{$i+1}}</td>                                
                                
                                <td>{{ date("F", mktime(0, 0, 0, $data['month'], 10)) }}</td>
                                <td>{{ $data['year'] }}</td>
                                <td>{{ $data['amount'] }}</td>                               
                                <td>
                                    <a href="{{url('admin/earnings/edit/'.$data['id'] ) }}" class="btn btn-info">Edit</a>
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
    //$('#role_table').dataTable();
   // console.log('ok')
    $(document).ready(function() {
        $('#role_table').DataTable( {
            order: [[ 0, "desc" ]],
           // dom: 'Bfrtip',
           /* buttons: [
               { 
                  extend: 'csv',
                  text: 'Export User List',
                  exportOptions: {
                    //columns: 'th:not(:last-child)'
                    columns: [ 1, 2, 3 ]
                  }
               }
            ],*/
            columnDefs: [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        } );
    } );
</script>
@stop