@extends('admin.layouts.master')

@section('breadcumb')
<div class="page-title">
    <h3>Update User</h3>
    <div class="page-breadcrumb">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);">Home</a></li>
            <li class="active">Update User</li>
        </ol>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-white">  
            <div class="panel-heading clearfix">
                <h4 class="panel-title">Update User</h4>
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

                
                <form action="{{url('admin/activate/update-user')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="parent_id" value="{!! $data['id'] !!}" />
                    {{csrf_field()}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">User Code</label>
                            <input type="text" class="form-control" name="parent_code" value="{!! $data['name'] !!}" />
                        </div>
                        <div class="form-group required">
                            <label for="" class="control-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{!! $data['first_name'] !!}" required>
                        </div>
                        <div class="form-group required">
                            <label class="control-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{!! $data['last_name'] !!}" required>
                        </div>
                        <div class="form-group required">
                            <label class="control-label">PAN</label>
                            <input type="text" class="form-control" name="pan" value="{!! $data['pan'] !!}" required>
                        </div>
                        <div class="form-group required">
                            <label class="control-label">Mobile</label>
                            <input type="text" class="form-control" name="mobile" value="{!! $data['mobile'] !!}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{!! $data['amount'] !!}"  onkeyup="format_display(this.value)" >
                        </div>
                        <div class="form-group">
                            <label for="">Amount Code</label>
                            <input type="text" class="form-control" name="amount_display" id="amount_display" value="{!! $data['amount_display'] !!}"  >
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" value="{!! $data['email'] !!}" >
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="control-label">Activate</label>
                            <label class="radio-inline"><input type="radio" name="activate" value="1" <?php if($data['activate']==1) echo 'checked'; ?> >Yes</label>
                            <label class="radio-inline"><input type="radio" name="activate" value="0" <?php if($data['activate']==0) echo 'checked'; ?>>No</label>
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
    
    /*$('.select2').select2();
    $('.select2').change(function(){
        console.log('its change')
    })*/
</script>
@stop