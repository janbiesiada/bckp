@extends('admin.authenticated.dashboard')
@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Advertisement Manager </small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Advertisement Manager </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        
        <div class="advertistement">
            
            <div class="panel panel-default">
                <div class="panel-heading"><b>Sidebar Spot (300x250)</b></div>
                <div class="panel-body">
                    <div class="spot1">
                        <div class="display">
                            
                            @if(Ads::find(1)->uri)
                            <div class="ad" style="background-image : url('{{Ads::find(1)->uri}}');" >
                            @else
                            <div class="ad" style="background-color:grey" >
                            @endif
                                <div class="size">
                                    300x250
                                </div>
                                
                            </div>
                        </div>
                        
                        
                        <div class="options">
                            <form action="{{ URL::secure('/9gag-admin/adverts')}}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="spot1">
                                </div>
                                @if(Session::has('spot1update'))
                                <div class="form-group">
                                    <p style="color:green">{{Session::get('spot1update')}}</p>
                                </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Save Advert</button>
                                @if(Ads::find(1)->uri)
                                    <button type="button" class="btn btn-warning remove-advert" data-id="1" >Remove Advert</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><b>Sidebar Spot (200X500)</b></div>
                <div class="panel-body">
                    <div class="spot2">
                        <div class="display">
                            @if(Ads::find(2)->uri)
                            <div class="ad" style="background-image : url('{{Ads::find(2)->uri}}');" >
                            @else
                            <div class="ad" style="background-color:grey" >
                            @endif
                                <div class="size">
                                    200X500
                                </div>
                            </div>
                        </div>
                        <div class="options">
                            <form action="{{ URL::secure('/9gag-admin/adverts')}}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    
                                    <input type="file" name="spot2">
                                </div>
                                @if(Session::has('spot2update'))
                                <div class="form-group">
                                    <p style="color:green">{{Session::get('spot2update')}}</p>
                                </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Save Advert</button>
                                @if(Ads::find(2)->uri)
                                    <button type="button" class="btn btn-warning remove-advert" data-id="2" >Remove Advert</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><b>Comments Spot (320x100)</b></div>
                <div class="panel-body">
                    <div class="spot3">
                        <div class="display">
                            @if(Ads::find(3)->uri)
                            <div class="ad" style="background-image : url('{{Ads::find(3)->uri}}');" >
                            @else
                            <div class="ad" style="background-color:grey" >
                            @endif
                                <div class="size">
                                    320x100
                                </div>
                            </div>
                        </div>
                        <div class="options">
                            <form action="{{ URL::secure('/9gag-admin/adverts')}}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    
                                    <input type="file" name="spot3">
                                </div>
                                @if(Session::has('spot3update'))
                                <div class="form-group">
                                    <p style="color:green">{{Session::get('spot3update')}}</p>
                                </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Save Advert</button>
                                @if(Ads::find(3)->uri)
                                    <button type="button" class="btn btn-warning remove-advert" data-id="3" >Remove Advert</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><b>Sidebar Spot (160x600)</b></div>
                <div class="panel-body">
                    <div class="spot4">
                        <div class="display">
                            @if(Ads::find(4)->uri)
                            <div class="ad" style="background-image : url('{{Ads::find(4)->uri}}');" >
                            @else
                            <div class="ad" style="background-color:grey" >
                            @endif
                                <div class="size">
                                    160x600
                                </div>
                            </div>
                        </div>
                        <div class="options">
                            <form action="{{ URL::secure('/9gag-admin/adverts')}}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="spot4">
                                </div>
                                @if(Session::has('spot4update'))
                                <div class="form-group">
                                    <p style="color:green">{{Session::get('spot4update')}}</p>
                                </div>
                                @endif
                                <button type="submit" class="btn btn-primary">Save Advert</button>
                                @if(Ads::find(4)->uri)
                                    <button type="button" class="btn btn-warning remove-advert" data-id="4" >Remove Advert</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop