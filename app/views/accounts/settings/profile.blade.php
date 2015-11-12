@extends('index')

@section('title')
<title>Profile Settings - 9GAG</title>
@stop

@section('profilesettings')
<div class="settings-account">
    <div class="row">
        <div class="col-xs-4">
            <div class="list-group">
                <a href="/settings/account" class="list-group-item ">Account</a>
                <a href="/settings/password" class="list-group-item">Password</a>
                <a href="/settings/profile" class="list-group-item active">Profile</a>
                <a href="/settings/notifications" class="list-group-item ">Notification</a>
            </div>
        </div>
        <div class="col-xs-6">
            
            
            <div class="settingsform">
                <h2>Profile</h2>
                <form action="{{ URL::secure('/settings/profile')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profilepicture"> Avatar</label><br>
                        <div class="profilepic">
                            <img class="img-responsive" src="{{Session::get('auth')['dp_uri']}}"><br><br>
                        </div>
                        
                        
                        <input type="file" name="profilePicture">
                    </div>
                    
                    <div class="form-group">
                        <label for="profilecover"> Profile Cover</label><br>
                        <div class="profilecover">
                            <img class="img-responsive" src="{{Session::get('auth')['cover_uri']}}"><br>
                        </div>
                        <input type="file" name="profilecover">
                    </div>
                    
                     <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" class="form-control" name="name" value="{{Session::get('auth')['name']}}" placeholder="Full Name">
                        @if($errors->has('name'))
                            * {{$errors->first('name')}}
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Gender</label>
                        <select class="form-control" name=gender id="sel1">
                            <?php
                                $get_gender = User::where('username','=',Session::get('auth')['username'])->first()->gender;
                                $g_check = false;
                                $gender = [
                                    "male",
                                    "female",
                                    "unspecified"
                                ];
                                
                                foreach ($gender as $k=>$v) {
                                    if($v === $get_gender){
                                        echo '<option style="background-color:#10A8E3;color:white;" value="'.$get_gender.'">'.$get_gender.'</option>';
                                    
                                        $g_check = true;
                                    }
                                }
                                
                                if($g_check === false){
                                    echo '<option value="">Select a gender</option>';
                                }
                                
                                foreach ($gender as $k=>$v) {
                                    if($v != $get_gender){
                                        echo '<option value="'.$v.'">'.$v.'</option>';
                                    }
                                }
                            ?>
                            
                            
                        </select>
                    </div>
                    
                    <div class="form-group bdays">
                        
                        <?php
                            $get_dob = User::where('username','=',Session::get('auth')['username'])->first()->dob;
                            
                            if($get_dob){
                                $month_range    = range(1,12);
                                $day_range  = range(1,31);
                                $year_range   = range(1959,2015);
                                $orderdate = explode('-', $get_dob);
                                $month = $orderdate[1];
                                $day   = $orderdate[2];
                                $year  = $orderdate[0];
                        ?>
                        <label for="about">Birthday</label><br>
                        
                        <select class="form-control" id="month" name="dob_month">
                            <?php
                                foreach ($month_range as $k=>$v) {
                                    if($v == $month){
                                        echo '<option style="background-color:#10A8E3; color:white;" value="'.$month.'">'.$month.'</option>';
                                    }
                                }
                                
                                foreach ($month_range as $k=>$v) {
                                    echo '<option value="'.$v.'">'.$v.'</option>';
                                }
                            ?>
                        </select>
                        
                        
                        <select class="form-control" id="day" name="dob_day">
                            <?php
                                foreach ($day_range as $k=>$v) {
                                    if($v == $day){
                                        echo '<option style="background-color:#10A8E3;color:white;" value="'.$day.'">'.$day.'</option>';
                                    }
                                }
                                
                                foreach ($day_range as $k=>$v) {
                                    echo '<option value="'.$v.'">'.$v.'</option>';
                                }
                            ?>
                        </select>
                        
                        <select class="form-control" id="month" name="dob_year">
                            <?php
                                    foreach ($year_range as $k=>$v) {
                                        if($v == $year){
                                            echo '<option style="background-color:#10A8E3;color:white;" value="'.$year.'">'.$year.'</option>';
                                        }
                                    }
                                    
                                    foreach ($year_range as $k=>$v) {
                                        echo '<option value="'.$v.'">'.$v.'</option>';
                                    }
                            ?>
                        </select>
                        
                        <?php
                        
                            }else{
                        ?>
                            <label for="about">Birthday</label><br>                                                
                                <select class="form-control" id="month" name="dob_month">
                                	<option value="">MM</option>
                                	<option value="1">1</option>
                                	<option value="2">2</option>
                                	<option value="3">3</option>
                                	<option value="4">4</option>
                                	<option value="5">5</option>
                                	<option value="6">6</option>
                                	<option value="7">7</option>
                                	<option value="8">8</option>
                                	<option value="9">9</option>
                                	<option value="10">10</option>
                                	<option value="11">11</option>
                                	<option value="12">12</option>
                                </select>
                                 <select class="form-control" id="day" name="dob_day">
                                	<option value="">DD</option>
                                	<option value="1">1</option>
                                	<option value="2">2</option>
                                	<option value="3">3</option>
                                	<option value="4">4</option>
                                	<option value="5">5</option>
                                	<option value="6">6</option>
                                	<option value="7">7</option>
                                	<option value="8">8</option>
                                	<option value="9">9</option>
                                	<option value="10">10</option>
                                	<option value="11">11</option>
                                	<option value="12">12</option>
                                	<option value="13">13</option>
                                	<option value="14">14</option>
                                	<option value="15">15</option>
                                	<option value="16">16</option>
                                	<option value="17">17</option>
                                	<option value="18">18</option>
                                	<option value="19">19</option>
                                	<option value="20">20</option>
                                	<option value="21">21</option>
                                	<option value="22">22</option>
                                	<option value="23">23</option>
                                	<option value="24">24</option>
                                	<option value="25">25</option>
                                	<option value="26">26</option>
                                	<option value="27">27</option>
                                	<option value="28">28</option>
                                	<option value="29">29</option>
                                	<option value="30">30</option>
                                	<option value="31">31</option>
                                </select>
                                 <select class="form-control" id="year" name="dob_year">
                                	<option value="">YYYY</option>
                                	<option value="2015">2015</option>
                                	<option value="2014">2014</option>
                                	<option value="2013">2013</option>
                                	<option value="2012">2012</option>
                                	<option value="2011">2011</option>
                                	<option value="2010">2010</option>
                                	<option value="2009">2009</option>
                                	<option value="2008">2008</option>
                                	<option value="2007">2007</option>
                                	<option value="2006">2006</option>
                                	<option value="2005">2005</option>
                                	<option value="2004">2004</option>
                                	<option value="2003">2003</option>
                                	<option value="2002">2002</option>
                                	<option value="2001">2001</option>
                                	<option value="2000">2000</option>
                                	<option value="1999">1999</option>
                                	<option value="1998">1998</option>
                                	<option value="1997">1997</option>
                                	<option value="1996">1996</option>
                                	<option value="1995">1995</option>
                                	<option value="1994">1994</option>
                                	<option value="1993">1993</option>
                                	<option value="1992">1992</option>
                                	<option value="1991">1991</option>
                                	<option value="1990">1990</option>
                                	<option value="1989">1989</option>
                                	<option value="1988">1988</option>
                                	<option value="1987">1987</option>
                                	<option value="1986">1986</option>
                                	<option value="1985">1985</option>
                                	<option value="1984">1984</option>
                                	<option value="1983">1983</option>
                                	<option value="1982">1982</option>
                                	<option value="1981">1981</option>
                                	<option value="1980">1980</option>
                                	<option value="1979">1979</option>
                                	<option value="1978">1978</option>
                                	<option value="1977">1977</option>
                                	<option value="1976">1976</option>
                                	<option value="1975">1975</option>
                                	<option value="1974">1974</option>
                                	<option value="1973">1973</option>
                                	<option value="1972">1972</option>
                                	<option value="1971">1971</option>
                                	<option value="1970">1970</option>
                                	<option value="1969">1969</option>
                                	<option value="1968">1968</option>
                                	<option value="1967">1967</option>
                                	<option value="1966">1966</option>
                                	<option value="1965">1965</option>
                                	<option value="1964">1964</option>
                                	<option value="1963">1963</option>
                                	<option value="1962">1962</option>
                                	<option value="1961">1961</option>
                                	<option value="1960">1960</option>
                                	<option value="1959">1959</option>
                                </select>
                                </br></br>
                            
                        
                        <?php
                            }
                        ?>
                    </div>
                        
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Location</label>
                        <select class="form-control" name=location id="sel1">
                            <?php
                                $loc_check = false;
                                $location = User::where('username','=',Session::get('auth')['username'])->first()->location;
                                $countries = $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                
                                
                                foreach ($countries as $k=>$v) {
                                    if($v === $location){
                                        echo '<option style="background-color:#10A8E3;color:white;" value="'.$location.'">'.$location.'</option>';
                                        $loc_check = true;
                                    }
                                }
                                
                                if($loc_check === false){
                                    echo '<option value="">Choose Location</option>';
                                }
                                
                                foreach ($countries as $k=>$v) {
                                    if($v != $location){
                                        echo '<option value="'.$v.'">'.$v.'</option>';
                                    }
                                }
                            ?>
                            
                            
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="about">Tell people who you are</label>
                        <?php
                            $about = User::where('username','=',Session::get('auth')['username'])->first()->about;
                        ?>
                        <textarea class="form-control" rows="5" name="about"><?php echo $about; ?></textarea>
                    </div>
                    @if(Session::has('settingnotification'))
                    <div class="form-group">
                        <p style="color:red">{{Session::get('settingnotification')}}</p>
                    </div>
                    @endif
                    <button type="submit" class="btn-submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop