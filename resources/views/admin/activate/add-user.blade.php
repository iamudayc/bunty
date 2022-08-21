@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Add User</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">Home</a></li>
            <li class="active">Add User</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">  
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Create User</h4>
            </div>          
            <div class="panel-body">
                 @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                    @endforeach 
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert"> 
                        {{ Session::get('error') }}
                    </div>
                @endif

                <form action="{{url('admin/activate/store')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="parent_code_only" value="{!! $parent_code_only !!}" />
                    <input type="hidden" class="form-control" name="parent_id" value="{!! $parent_id !!}" />
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Parent</label>
                            <input type="text" class="form-control" readonly value="{!! $parent_code !!}" />
                        </div>
                        <div class="form-group required">
                            <label for="" class="control-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="form-group required">
                            <label class="control-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="form-group required">
                            <label class="control-label">PAN</label>
                            <input type="text" class="form-control" name="pan" required>
                        </div>
                        <div class="form-group required">
                            <label class="control-label">Mobile</label>
                            <input type="text" class="form-control" name="mobile" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" onkeyup="format_display(this.value)" >
                        </div>
                        <div class="form-group">
                            <label for="">Amount Code</label>
                            <input type="text" class="form-control" name="amount_display" id="amount_display"  >
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" >
                        </div>
                        
                        <div class="form-group required">
                            <label class="control-label">Password</label>
                            <input type="text" class="form-control" name="password" value="123456" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Activate</label>
                            <label class="radio-inline"><input type="radio" name="activate" value="1" checked>Yes</label>
                            <label class="radio-inline"><input type="radio" name="activate" value="0">No</label>
                        </div>
                        
                    </div>
                    <div class="col-md-12">
                        <a href="javascript:history.back()" class="btn btn-default">Back</a>
                        <button type="submit" class="btn btn-primary" onclick="format_display()">Submit</button>
                    </div>
                </form>            
            </div>
        </div>    
    </div>
</div>
@stop

@section('scripts')
<script>
    $( document ).ready(function() {
        let amount=$("#amount").val();
        format_display(amount);
        //alert(amount);
    });

    function format_display(amount)
    {
        let insert_amount=parseFloat(amount);
        let amount_display=0;
        //let amount=$("#amount").val();
        if(insert_amount>99999)
        {
            amount_display=insert_amount/100000+'GB';;
        }
        else
        {
            amount_display=insert_amount/1000+'MB';
        }
        //alert(amount_display);
        //console.log("amount_display:",amount_display);
        if(amount_display=="NaNMB")
        {
            $("#amount_display").val();
        }
        else
        {
            $("#amount_display").val(amount_display);
        }
        
    }
    //$('#role_table').dataTable();
    //console.log('ok')
    
    $('.select2').select2();
    $('.select2').change(function(){
        console.log('its change')
    })
</script>
@stop