<div class="popup" id="new-uploadpost">
	<div class="overlay"></div>
	<div class="new-uploadpost ahzp-ready">
		<div class="wrapper">
            <h1>Upload Picture</h1>
            <form action="{{ URL::secure('/upload/item/photo')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <p>Upload funny pictures, paste pictures URL, accepting GIF/JPG/PNG (Max size: 3MB)</p>
                </div>
                <div class="form-group">
                    <input type="file" class="uploader" name="file">
                    @if($errors->has('file'))
                        <p class="formerrors">* {{$errors->first('file')}}</p>
                    @endif
                </div>
                
              
                <div class="form-group">
                    <label for="about">Post Title (max. 120)</label>
                    <textarea class="form-control" rows="5" maxlength="120" name="title"></textarea>
                     @if($errors->has('title'))
                        <p class="formerrors">* {{$errors->first('title')}}</p>
                    @endif
                </div>
               
                <div class="form-group">
                    <label># Tags (max. 3)</label>
                    <input type="text" class="form-control" name="tags" id="hashtags" placeholder="#">
                    @if($errors->has('tags'))
                        <p class="formerrors">* {{$errors->first('tags')}}</p>
                    @endif
                     @if(Session::has('tagserror'))
                        <p class="formerrors">* {{Session::get('tagserror')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="language">Language</label>
                    <select class="form-control" name=language id="sel1">
                        <option value="">Choose Language</option>
                        <?php
                            $languages = Language::where('enabled','=',1)->lists('name');
                            
                            foreach ($languages as $k=>$v) {
                                echo '<option value="'.$v.'">'.$v.'</option>';
                            }
                        ?>
                    </select>
                    @if($errors->has('language'))
                        <p class="formerrors">* {{$errors->first('language')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="categories">Choose Categories (max. 2)</label><br>
                    <div class="row">
                        <?php
                            $categories = MetaData::where('type','=','details')->first()->categories;
                            $categories = explode(',',$categories);
                            
                            foreach($categories as $category){
                                ?>
                                <div class="col-xs-4">
                                    <input class="categories" name="{{ucfirst(str_replace(' ','',$category))}}" type="checkbox"> {{ucfirst(str_replace(' ','',$category))}} <br>
                                </div>
                               
                                <?php
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        @if(Session::has('postcategorieserror'))
                            <p class="formerrors">* {{Session::get('postcategorieserror')}}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-submit">Upload</button>
                </div>
            </form>
        </div>
	</div>
</div>

<div class="popup" id="url-uploadpost">
	<div class="overlay"></div>
	<div class="url-uploadpost ahzp-ready">
		<div class="wrapper">
            <h1>Upload Picture</h1>
            <form action="{{ URL::secure('/upload/item/url')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <p>Upload funny pictures, paste pictures URL, accepting GIF/JPG/PNG (Max size: 3MB)</p>
                </div>
                <div class="form-group">
                    <label for="url">Image URL</label>
                    <input class="form-control" rows="5" placeholder="http://" maxlength="120" name="url">
                    @if(Session::has('invalidurl'))
                        <p class="formerrors">* {{Session::get('invalidurl')}}</p>
                    @endif
                    @if($errors->has('url'))
                        <p class="formerrors">* {{$errors->first('url')}}</p>
                    @endif
                </div>
                
              
                <div class="form-group">
                    <label for="about">Post Title (max. 120)</label>
                    <textarea class="form-control" rows="5" maxlength="120" name="title"></textarea>
                     @if($errors->has('title'))
                        <p class="formerrors">* {{$errors->first('title')}}</p>
                    @endif
                </div>
               
                <div class="form-group">
                    <label># Tags (max. 3)</label>
                    <input type="text" class="form-control" name="tags" id="url-postHashTags" placeholder="#">
                    @if($errors->has('tags'))
                        <p class="formerrors">* {{$errors->first('tags')}}</p>
                    @endif
                    @if(Session::has('tagserror'))
                        <p class="formerrors">* {{Session::get('tagserror')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="language">Language</label>
                    <select class="form-control" name=language id="sel1">
                        <option value="">Choose Language</option>
                        <?php
                            $languages = Language::where('enabled','=',1)->lists('name');
                            
                            foreach ($languages as $k=>$v) {
                                echo '<option value="'.$v.'">'.$v.'</option>';
                            }
                        ?>
                    </select>
                    @if($errors->has('language'))
                        <p class="formerrors">* {{$errors->first('language')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="categories">Choose Categories (max. 2)</label><br>
                    <div class="row">
                        <?php
                            $categories = MetaData::where('type','=','details')->first()->categories;
                            $categories = explode(',',$categories);
                            
                            foreach($categories as $category){
                                ?>
                                <div class="col-xs-4">
                                    <input class="categories" name="{{ucfirst(str_replace(' ','',$category))}}" type="checkbox"> {{ucfirst(str_replace(' ','',$category))}} <br>
                                </div>
                               
                                <?php
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        @if(Session::has('postcategorieserror'))
                            <p class="formerrors">* {{Session::get('postcategorieserror')}}</p>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-submit">Upload</button>
                </div>
            </form>
        </div>
	</div>
</div>
