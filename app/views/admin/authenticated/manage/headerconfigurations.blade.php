@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Header Modification </small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Header Modification </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="look">
            <form action="{{ URL::secure('/9gag-admin/look')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Website Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Website Title" value="{{MetaData::where('type','=','details')->first()->title}}">
                </div>
                
                <div class="form-group">
                    <label for="description">Website Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Website Description" value="{{MetaData::where('type','=','details')->first()->description}}">
                </div>
            
                <div class="form-group">
                    <label for="categories">Categories (separted by commas)</label>
                    <input type="text" class="form-control" name="categories" placeholder="Content Categories" value="{{MetaData::where('type','=','details')->first()->categories}}">
                </div>
                
                @if(Session::has('lookupdate'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('lookupdate')}}</p>
                </div>
                @endif
              
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Languages</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->
@stop