<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
   

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
 <body>
        <script src="{{ asset('js/app.js') }}"></script>
<div class="bg-black">
    <h1>kwllo</h1>
</div>
<script>
    window.Echo.channel('events')
        .listen('RealTimeMessage', (e) => {
            console.log('RealTimeMessage: ' + e.message)
            document.getElementById('msg').innerHTML = e.message
        });
</script>

</body> 

<body class=" text-white font-sans">
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
                        <span id="msg"></span>
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
            <form action="{{ route('chat') }}" method="POST">
                @csrf
                <div class="mt-4 flex m-5 ">
                    <input type="text" placeholder="Type a message..." class="flex-1 py-2 px-3 rounded-full border border-gray-300 focus:outline-none focus:border-blue-500 text-black">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700">Send</button>
                </div>
            </form>

        </div>
    </div>

<div class="text-black">
    <h1>Welcome to our store!</h1>
    </br> 
   
    <ul>
    

    @if (count($products) > 0)
        @foreach ($products as $productWithPrices)
            <h2>{{ $productWithPrices['product']->name }}</h2>
            <p>Description: {{ $productWithPrices['product']->description }}</p>
            <ul>
                @foreach ($productWithPrices['prices'] as $price)
                    <li>Price: {{ $price->unit_amount / 100 }} {{ $price->currency }}</li>
                @endforeach
            </ul>
            <hr>
        @endforeach
    @else
        <p>No products with prices available.</p>
    @endif
    </ul>
    </div>
</body>

</html>