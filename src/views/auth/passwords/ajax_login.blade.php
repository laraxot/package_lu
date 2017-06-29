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