<div style="font-family:Georgia, Times New Roman, Courier; width: 100%; background:#f9f9fb; position:relative; height: 100%; display:block; overflow:auto;">
    <div style="width:50%; margin: 100px auto; position:relative; height:auto;">
        <div style="text-align:center">
             <h1>Hello {{ $username }},</h1>
        </div>
        <div style="text-align:center">
             <h2>{{Emailer::where('type','=','activate_admin')->first()->title}}</h2>
        </div>
    </div>

    <div style="background-color:white; width: 40%; position:relative; display:block; height:auto; margin : 100px auto; border: 1px solid grey; border-radius : 5px;">
        <div style=" width: 95%; height:auto; margin : 20px auto; text-align:center; font-size: 16px;">
            {{Emailer::where('type','=','activate_admin')->first()->body}}
        </div>
        <div style="width: 95%; height:auto; margin : 20px auto; text-align:center; text-align: justify">
            <a href="{{ $link }}" style="border-radius: 5px; display:block; text-align:center; margin: 30px auto; width:100px;  height:20px;  color:white;  background-color:black;  font-size: 14px;  padding :15px; text-decoration:none;">
            Verify Account
            </a>
        </div>
    </div>
</div>