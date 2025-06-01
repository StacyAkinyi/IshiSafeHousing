<!DOCTYPE html>
<html>
<head>
    <title>Two-Factor Authentication</title>
</head>
<body>
    <h1>Two-Factor Challenge</h1>

    <form method="POST" action="{{ url('/two-factor-challenge') }}">
        @csrf

        <div>
            <label for="code">Authentication Code</label>
            <input id="code" name="code" type="text" autofocus autocomplete="one-time-code">
        </div>

        <div>
            <label for="recovery_code">Or Recovery Code</label>
            <input id="recovery_code" name="recovery_code" type="text" autocomplete="one-time-code">
        </div>

        <button type="submit">Login</button>
    </form>

    @if ($errors->any())
        <div style="color:red;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
</body>
</html>
