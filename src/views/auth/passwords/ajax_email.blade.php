{{--
<div class="mfp-with-anim mfp-dialog clearfix">
--}}
<div class="loginRes"></div>
    <i class="fa fa-retweet dialog-icon"></i>
    <h3>Password Recovery</h3>
    <h5>Forgot your password? Don't worry we can deal with it</h5>
    <form class="dialog-form" role="form" method="POST" action="{{ asset('/password/email') }}">{{ csrf_field() }}
        <label>E-mail</label>
        <input type="text" placeholder="email@domain.com" class="form-control" name="email">
        <input type="submit" value="Request new password" class="btn btn-primary">
    </form>
    <br/>
    <ul class="dialog-alt-links">
        <li><a href="{{ asset('/login') }}" class="ajax-popup-link"  data-effect="mfp-zoom-out">Already member</a>
        </li>
        <li><a href="{{ asset('/register') }}" class="ajax-popup-link"  data-effect="mfp-zoom-out">Not member yet</a>
        </li>
    </ul>
{{--    
</div>
--}}