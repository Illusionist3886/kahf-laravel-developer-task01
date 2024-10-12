<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccine Registration Status</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div>
    @if(session('success'))
    <div class="w-full p-3 rounded-md bg-green-400">
      {{ session('success') }}
    </div>
    @endif
    <div>
    <a href="{{ route('search') }}" class="my-4 inline-block text-blue-600">Click Here</a> to Check Status.
    </div>
  </div>
</body>
</html>