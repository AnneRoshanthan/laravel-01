<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class=" text-white font-sans">


     <body>
        <!-- <script src="{{ asset('js/app.js') }}"></script>
        <script>
            window.Echo.channel('chat')
                .listen('SendMessages', (e) => console.log('chat' + e.message));
        </script> -->


    </body> 

        <div class="container bg-gradient-to-br from-purple-400 via-pink-500 to-red-500 mx-auto max-w-screen-md p-4">
            <div class="bg-white bg-opacity-90 shadow-md rounded-lg p-4">
                <!-- Chat header -->
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-2">
                    <div class="text-lg font-semibold text-gray-800">Chat with John Doe</div>
                    <div class="text-sm text-green-400">Online</div>
                </div>
    
                <!-- Chat messages -->
                <div class="mt-4 space-y-4">
                    <!-- Sender message -->
                    <div class="flex items-start justify-start">
                        <div class="bg-blue-600 py-2 px-3 rounded-lg max-w-xs">
                            Hello, how can I help you?
                        </div>
                    </div>
    
                    <!-- Receiver message -->
                    <div class="flex items-start justify-end">
                        <div class="bg-pink-400 py-2 px-3 rounded-lg max-w-xs">
                            Hi there! I have a question.
                        </div>
                    </div>
    
                    <!-- Add more colorful messages here -->
                </div>
    
                <!-- Chat input -->
                <div class="mt-4 flex">
                    <input type="text" placeholder="Type a message..." class="flex-1 py-2 px-3 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500">
                    <button class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">Send</button>
                </div>
            </div>
        </div>
    </body>
</html>
