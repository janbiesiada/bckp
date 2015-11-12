@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Privacy Policy </small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Policy Editor </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="privacyeditor">
            
            <form action="{{ URL::secure('/9gag-admin/editor/policy')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="policy">Privacy Policy</label>
                    <textarea class="form-control" rows="5" name="policy">{{MetaData::where('type','=','details')->first()->privacypolicy}}</textarea>
                </div>
                
                @if(Session::has('policyupdate'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('policyupdate')}}</p>
                </div>
                @endif
                
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
            
        </div>
    </div>
</section>
<!-- /.content -->
@stop