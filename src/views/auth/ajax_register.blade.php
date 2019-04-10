{{--
<div class="mfp-with-anim mfp-dialog clearfix">
--}}
<div class="loginRes"></div>
<i class="fa fa-edit dialog-icon"></i>
<h3>Member Register</h3>
<h5>Ready to get best offers? Let's get started!</h5>
<form class="dialog-form" role="form" method="POST" action="{{ route('register',['lang'=>$lang]) }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label>UserName</label>
        <input type="text" name="username" placeholder="username" class="form-control" required autofocus>
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input type="text" name="email" placeholder="email@domain.com" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" placeholder="My secret password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Repeat Password</label>
        <input type="password" placeholder="Type your password again" name="password_confirmation" class="form-control" required>
    </div>
    {{--
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label>Your Area</label>
                <input type="password" placeholder="Boston" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Postal/Zip</label>
                <input type="password" placeholder="12345" class="form-control">
            </div>
        </div>
    </div>
    <div class="checkbox">
        <label>
            <input type="checkbox">Get hot offers via e-mail
        </label>
    </div>
    --}}
    <input type="submit" value="Sign up" class="btn btn-primary">
</form>
<ul class="dialog-alt-links">
    <li><a href="{{ route('login',['lang'=>$lang]) }}" class="ajax-popup-link" data-effect="mfp-zoom-out">Already member</a>
    </li>
</ul>
{{--
</div>
--}}