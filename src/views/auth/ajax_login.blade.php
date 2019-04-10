{{--
<div class="mfp-with-anim mfp-dialog clearfix">
--}}
<div class="loginRes"></div>
<i class="fa fa-sign-in dialog-icon"></i>
    <h3>Member Login </h3>
    <h5>Welcome back, friend. Login to get started</h5>
    <div class="btn-group" style="padding:3px">
        <a  href='/login/google' class='btn btn-danger' title="Sign in with Google"><i class="fa fa-google-plus"  style="width:1em;"></i></a>
        <a  href='/login/facebook' class='btn btn-primary' title="Sign in with Facebook"><i class="fa fa-facebook" style="width:1em;"></i></a>
        <a  href='/login/twitter' class='btn btn-info' title="Sign in with Twitter"><i class="fa fa-twitter" style="width:1em;"></i></a>
    </div>

    <form method="POST" action="{{ route('login',['lang'=>$lang]) }}" accept-charset="UTF-8" class="dialog-form" id="formLogin">{{ csrf_field() }}
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
        <li><a href="{{ route('register',['lang'=>$lang]) }}" class="ajax-popup-link"  data-effect="mfp-zoom-out">Not member yet</a>
        </li>
        <li><a href="{{ route('password.request',['lang'=>$lang]) }}{{-- asset('/password/reset') --}}" class="ajax-popup-link" data-effect="mfp-zoom-out">Forgot password</a>
        </li>
       
    </ul>
{{--
</div>
--}}