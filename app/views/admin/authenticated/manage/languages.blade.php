@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Languages Manager </small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Languages Manager </li>
    </ol>
</section>

<section class="content">
  
    
    <div class="row">
        <div class="lang-records">  
            
            <table class="table table-condensed">
                <thead class="cf">
                    <tr>
                        <td>
                            <b>Language Name</b>
                        </td>
                        <th>
                            <b>Simplified Name</b>
                        </th>
                        
                        <th>
                            <b>Language ISO Code</b>
                        </th>
                
                        <th>
                            <b>Enbabled</b>
                        </th>
                    </tr>
                </thead>
                
                
            @foreach($languages as $language)
                <tbody>
                    <tr>
                        <td>
                            {{$language->name}}
                        </td>
                        <td>
                            {{$language->simplified_name}}
                        </td>
                        <td>
                            {{$language->code}}
                        </td>
                        <td>
                            @if($language->enabled)
                                Yes
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                </tbody>
            @endforeach
            </table>
        </div>
        
        <div class="languages">       
            <form action="{{ URL::secure('/9gag-admin/language')}}" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="name">Language Name </label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                    @if($errors->has('name'))
                       *{{$errors->first('name')}}
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="s_name">Language Simplified Name (English) </label>
                    <input type="text" class="form-control" name="s_name" placeholder="Simplfied Name">
                    @if($errors->has('s_name'))
                       *{{$errors->first('s_name')}}
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="l_code">Language Code</label>
                    <input type="text" class="form-control" name="l_code" placeholder="Language ISO Code">
                    @if($errors->has('l_code'))
                       *{{$errors->first('l_code')}}
                    @endif
                </div>

                @if(Session::has('languagesupdate'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('languagesupdate')}}</p>
                </div>
                @endif
              
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Language</button>
                </div>
            </form>    
        </div>
    </div>
</section>
<!-- /.content -->
@stop