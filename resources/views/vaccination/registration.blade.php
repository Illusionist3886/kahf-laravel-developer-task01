<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register for Vaccine</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <header class="w-full md:w-1/2">
    <div class="my-5 bg-white p-8 rounded-lg shadow-lg w-full">
      <h2 class="text-2xl font-bold text-center mb-6 flex justify-center items-center">
        <img src="{{ asset('/images/vaccine-1dose.png') }}" class="w-6 pr-1" /> 
        COVID-19 Vaccine Registration
      </h2>
      <p class="mb-5 text-center">
        <span class="text-yellow-600">Already Registered? Check status</span> <a href="{{ route('search') }}" class="text-blue-500" target="_blank">here.</a>
      </p>

      <form action="{{ route('complete-registration') }}" method="POST">
        @csrf
        <!-- Full Name -->
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-medium mb-1">Full Name <span class="text-red-500">*</span></label>
          @error('name')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
          <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Vaccine Centers -->
        <div class="mb-4">
          <label for="vaccine_center_id" class="block text-gray-700 font-medium mb-1">Select Your Center <span class="text-red-500">*</span></label>
          @error('vaccine_center_id')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
  
          <select id="vaccineCenters" name="vaccine_center_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="" disabled {{ old('vaccine_center_id') ? '' : 'selected' }}>Select Vaccine Center</option>
            @foreach($vaccineCenters as $vaccineCenter)
              <option value="{{ $vaccineCenter->id }}" {{ old('vaccine_center_id') == $vaccineCenter->id ? 'selected' : '' }}>{{ $vaccineCenter->name }}</option>
            @endforeach
          </select>

        </div>

        <!-- NID Number -->
        <div class="mb-4">
          <label for="nid" class="block text-gray-700 font-medium mb-1">NID Number <span class="text-red-500">*</span></label>
          @error('nid')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
          <input type="text" id="nid" name="nid" value="{{ old('nid') }}" placeholder="Enter your NID number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        

        <!-- Phone Number -->
        <div class="mb-4">
          <label for="phone" class="block text-gray-700 font-medium mb-1">Phone Number</label>
          @error('phone')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
          <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email Address -->
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-medium mb-1">Email Address <span class="text-red-500">*</span></label>
          @error('email')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        

        <!-- Password Section -->
        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-medium mb-1">Password <span class="text-red-500">*</span></label>
          @error('password')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
          <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password <span class="text-red-500">*</span></label>
          @error('password_confirmation')
            <span class="text-red-500 text-sm mb-1 block">{{ $message }}</span>
          @enderror
          <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
          <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Register
          </button>
        </div>

      </form>
    </div>
  </header>

</body>
</html>