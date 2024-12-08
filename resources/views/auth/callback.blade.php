<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
</head>
<body>
    <script>
        if (window.opener) {
            window.opener.postMessage({
                success: true,
                redirectUrl: "{{ $redirectUrl }}"
            }, "{{ url('/user/dashboard') }}");
        }

        window.close();
    </script>
</body>
</html>
