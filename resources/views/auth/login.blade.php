
<form action="{{ route('login') }}" method="POST">
    @csrf
    <label for="chk" aria-hidden="true" >LOGIN</label>

    @if($errors->login->any())
        <div class="error_text" style="font-size: 13px;">
            <span>{{ $errors->login->any() ? $errors->login->first() : '' }}</span>
        </div>
    @endif
    <input type="username" name="name" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>

    <h5 class="or">or</h5>

    <div class="socmed-icon">
        <div class="effect aeneas">
            <div class="buttons">
              <a href="#" class="fb" title="Join us on Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="#" class="tw" title="Join us on Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href="#" class="google" title="Join us on Google+"><i class="fa fa-google" aria-hidden="true"></i></a>
            </div>
          </div>
    </div>
</form>
