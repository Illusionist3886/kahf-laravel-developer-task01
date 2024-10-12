<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COVID Vaccination System</title>
  <link rel="stylesheet" href="{{ asset('assets/app-B9x6yrQY.css') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="">
        <h2 class="text-2xl text-center">
            Welcome to COVID Vaccine Registration System.
        </h2>
        <div class="my-5 w-full flex justify-evenly">
            <a href="{{ route('registration') }}" class="flex items-center bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-nonefocus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:bg-gray-400 disabled:opacity-50 disabled:cursor-not-allowed">
                Registration
            </a>
            <a href="{{ route('search') }}" class="flex items-center bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-nonefocus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 disabled:bg-gray-400 disabled:opacity-50 disabled:cursor-not-allowed">
                Check Status
            </a>
        </div>
        <p>
            <small>Please kindly provide a feedback even if not selected. <a href="mailto:contact.delowar@gmail.com" class="text-blue-800">contact.delowar@gmail.com</a></small>
        </p>

    </div>
</body>
</html>