@if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="/login" method="POST">
    @csrf
    
    <label>Username</label>
    <input type="text" name="username" value="{{ old('username') }}" required>
    @error('username') <span style="color: red;">{{ $message }}</span> @enderror

    <label>Password</label>
    <input type="password" name="password" required>

    <label>
        <input type="checkbox" name="remember"> Ingat Saya
    </label>

    <button type="submit">Log In</button>
</form>