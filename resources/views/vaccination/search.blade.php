<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vaccine Status Check</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <section class="w-full md:w-1/2">
    <div class="my-5 bg-white p-8 rounded-lg shadow-lg w-full">
      <h2 class="text-2xl font-bold text-center mb-6 flex justify-center items-center">
        <img src="{{ asset('/images/vaccine-1dose.png') }}" class="w-6 pr-1" /> 
        COVID-19 Vaccine Status
      </h2>
    
      <div class="mb-4">
        <label for="nid" class="block text-gray-700 font-medium mb-1">NID Number <span class="text-red-500">*</span></label>
        <input type="text" id="nid" name="nid" placeholder="NID Number" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div class="text-center">
        <button type="button" id="search" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
          Search
        </button>
      </div>

      <div id="responseMessage" class="mt-4 text-center text-gray-700"></div>
    </div>
  </section>

  <script>
      document.getElementById('search').addEventListener('click', async function(event) {

          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          let nid = document.getElementById('nid').value;

          if (!nid) {
              document.getElementById('responseMessage').innerHTML = '<span class="text-red-500">Please enter a valid NID.</span>';
              return;
          }

          const responseMessage = document.getElementById('responseMessage');
          responseMessage.innerHTML = ''; 

          try {
              const response = await fetch(`/get-status-by-nid?nid=${nid}`, {
                  method: 'GET',
                  headers: {
                      'X-CSRF-TOKEN': csrfToken
                  }
              });

            if (response.status === 404) {
                responseMessage.innerHTML = `
                    <p class="text-red-500">Status: Not registered</p>
                    <a href="{{ route('registration') }}" class="text-blue-500 underline">Click here to register</a>`;
            } else {

              const result = await response.json();

              if (result.vaccine_status == 'Not Scheduled') {
                  responseMessage.innerHTML = `<p class="text-yellow-500">Status: Registered but not scheduled for vaccine yet</p>`;
              } else if (result.vaccine_status == 'Scheduled') {
                  responseMessage.innerHTML = `<p class="text-green-500">Status: Scheduled for vaccination on ${result.vaccine_schedule?.schedule_date}</p>`;
              } else if (result.vaccine_status === 'Vaccinated') {
                  responseMessage.innerHTML = `<p class="text-green-500">Status: Vaccinated</p>`;
              }
            }
              
          } catch (error) {
              document.getElementById('responseMessage').innerHTML = `<span class="text-red-500">Error fetching status. Please try again later.</span>`;
          }
      });
  </script>
</body>
</html>