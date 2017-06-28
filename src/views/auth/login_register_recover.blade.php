  <!-- LOGIN REGISTER LINKS CONTENT -->
        <div id="login-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-sign-in dialog-icon"></i>
            <h3>Login</h3>
            <form id="withErrors" class="dialog-form" action="{{url('/login')}}" onsubmit="return true;" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>E-mail</label>
                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox">@lang('login.remember_me')
                    </label>
                </div>
                <p id="login-error" class="text-danger"></p>
                <input type="submit" value="@lang('login.sign_in')" class="btn btn-primary">
            </form>
            <ul class="dialog-alt-links">
                <li><a class="popup-text" href="#register-dialog" data-effect="mfp-zoom-out">@lang('login.not_registered')</a>
                </li>
                <li><a class="popup-text" href="#password-recover-dialog" data-effect="mfp-zoom-out">@lang('login.forgot_password')</a>
                </li>
            </ul>
        </div>


        <div id="register-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="fa fa-edit dialog-icon"></i>
            <h3>@lang('login.registration')</h3>
            <form action="{{url('/register')}}" id="registerForm" class="dialog-form" method="post" name="registerForm">
                {{ csrf_field() }}
                <div class="form-group" id="register-name">
                    <label class="control-label" for="name">@lang('login.name')</label>
                    <input class="form-control" id="name" name="name" required="" type="text">
                    <span class="help-block">
                        <strong id="register-errors-name"></strong>
                    </span>
                </div>
                <div class="form-group" id="register-email">
                    <label class="control-label" for="email">Email</label>
                    <input class="form-control" id="email" name="email" required="" type="email" value="">
                    <span class="help-block">
                        <strong id="register-errors-email"></strong>
                    </span>
                </div>
                <div class="form-group" id="register-password">
                    <label class="control-label" for="password">Password</label>
                    <input class="form-control" id="password" name="password" required="" type="password" value="">
                    <span class="help-block">
                        <strong id="register-errors-password"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="password-confirm">@lang('login.confirm_password')</label>
                    <input class="form-control" id="password-confirm" name="password_confirmation" type="password">
                    <span class="help-block">
                        <strong id="form-errors-password-confirm"></strong>
                    </span>
                </div>
                <div class="form-group" id="login-errors">
                    <span class="help-block">
                        <strong id="form-login-errors"></strong>
                    </span>
                </div>
                <div>
                    <button class="btn btn-primary">@lang('login.register')</button>
                </div>
            </form>
            <ul class="dialog-alt-links">
                <li><a class="popup-text" href="#login-dialog" data-effect="mfp-zoom-out">@lang('login.already_member')</a></li>
            </ul>
        </div>


        <div id="password-recover-dialog" class="mfp-with-anim mfp-hide mfp-dialog clearfix">
            <i class="icon-retweet dialog-icon"></i>
            <h3>@lang('login.password_recovery')</h3>
            <h5>@lang('login.password_recovery_description')</h5>
            <form class="dialog-form">
                {{ csrf_field() }}
                <label>E-mail</label>
                <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                <input type="submit" value="@lang('login.request_new_password')" class="btn btn-primary">
            </form>
        </div>
        <!-- END LOGIN REGISTER LINKS CONTENT -->
