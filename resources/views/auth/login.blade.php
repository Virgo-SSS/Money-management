
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
</form>
