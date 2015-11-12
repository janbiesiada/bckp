<div class="language-menu">
    <div class="container">
        <ul class="languages">
            
            <?php
                $languages = Language::where('enabled','=',1)->get();
                    foreach ($languages as $v) {
                        if($v === Session::get('language')){
                            echo '<li class="active"><a href="/'.$v->code.'">'.$v->name.'</a></li>';
                        }else{
                            echo '<li><a href="/'.$v->code.'">'.$v->name.'</a></li>';
                        }
                    }
                ?>
    	   
    	</ul>
    </div>
    
    <span class="closelanguages">
        x
    </span>
</div>
