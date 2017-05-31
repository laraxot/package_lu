<span  class="loginRes"></span>
{{-- LOGIN REGISTER LINKS CONTENT --}}
  <div id="login-dialog" class="mfp-with-anim @if($_GET['target']!='#login-dialog_root') mfp-hide @endif mfp-dialog clearfix">
    <i class="fa fa-sign-in dialog-icon"></i>
    <h3>Member Login</h3>
    <h5>Welcome back, friend. Login to get started</h5>
    <form method="POST" action="{{ asset('/login') }}" accept-charset="UTF-8" class="dialog-form">{{ csrf_field() }}
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" placeholder="email@domain.com" class="form-control" name="email" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" placeholder="My secret password" class="form-control" name="password" />
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember">Remember me
            </label>
        </div>
        <input type="submit" value="Sign in" class="btn btn-primary">
    </form>
    <ul class="dialog-alt-links">
        <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">Not member yet</a>
        </li>
        <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">Forgot password</a>
        </li>
    </ul>
</div>
{{--  
 --}}

<div id="register-dialog" class="mfp-with-anim @if($_GET['target']!='#register-dialog_root') mfp-hide @endif  mfp-dialog clearfix">
    <i class="fa fa-edit dialog-icon"></i>
    <h3>Member Register</h3>
    <h5>Ready to get best offers? Let's get started!</h5>
    <form class="dialog-form" role="form" method="POST" action="{{ route('register') }}">{{ csrf_field() }}
        <div class="form-group">
            <label>Name</label>
            <input id="username" type="text" placeholder="your username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
        </div>
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" placeholder="email@domain.com" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" placeholder="My secret password" class="form-control" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label>Repeat Password</label>
            <input type="password" placeholder="Type your password again" class="form-control" name="password_confirmation" id="password-confirm" required>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Your Area</label>
                    <input type="text" placeholder="Boston" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Postal/Zip</label>
                    <input type="text" placeholder="12345" class="form-control">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox">Get hot offers via e-mail
            </label>
        </div>
        <input type="submit" value="Sign up" class="btn btn-primary">
    </form>
    <ul class="dialog-alt-links">
        <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Already member</a>
        </li>
    </ul>
</div>


<div id="password-recover-dialog" class="mfp-with-anim @if($_GET['target']!='#password-recover-dialog_root') mfp-hide @endif mfp-dialog clearfix">
    <i class="fa fa-retweet dialog-icon"></i>
    <h3>Password Recovery</h3>
    <h5>Forgot your password? Don't worry we can deal with it</h5>
    <form class="dialog-form" role="form" method="POST" action="{{ asset('/password/reset') }}">{{ csrf_field() }}
        <label>E-mail</label>
        <input type="text" placeholder="email@domain.com" class="form-control" name="email">
        <input type="submit" value="Request new password" class="btn btn-primary">
    </form>
    <br/>
    <ul class="dialog-alt-links">
        <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">Already member</a>
        </li>
        <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">Not member yet</a>
        </li>
    </ul>
</div>
{{--  END LOGIN REGISTER LINKS CONTENT --}}


<script>
$(".dialog-form").submit(function(e) {   
    //prevent Default functionality
    var myform = $(this);
    var querystring = myform.serialize();
    //alert(myform.serialize());
    e.preventDefault();
    //get the action-url of the form
    var actionurl = e.currentTarget.action;
    $('.loginRes').html("<i class=\"fa fa-refresh fa-spin\"><\/i>");
    //alert(actionurl);
    //do your own request an handle the results
    $.ajax({
        url: actionurl,
        type: 'post',
        dataType: 'json',
        data: querystring,
        success: function(data) {
            if(data.status==0){
                $('.loginRes').html('<div class="alert alert-danger" role="alert">'+data.msg+'</div>');
            }else{
                $('.loginRes').html('<div class="alert alert-success" role="alert">'+data.msg+'</div>');
                if(myform.attr('id')=='formLogin'){
                    location.reload();
                }
            }
            
           // ... do something with the data...
        }
    });
 
    return false;
});


$('.popup-text').magnificPopup({
    removalDelay: 500,
    closeBtnInside: true,
    callbacks: {
        beforeOpen: function() {
            this.st.mainClass = this.st.el.attr('data-effect');
        }
    },
    midClick: true
});

</script>       