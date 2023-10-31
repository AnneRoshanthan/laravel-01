<x-app-layout>
    <!-- <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script> -->
    
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        window.Echo.private('chat')
            .listen('SendMessages', (e) => {
                console.log('SendMessages: ' + e.message)
                document.getElementById('msg').innerHTML = e.message
            });

            Echo.private(`blog.{{Auth::user()->_id}}`)
    .listen('BlockPost', (e) => {
        console.log(e);
    });

    Echo.channel(`postforall`)
    .listen('BlockPostForAll', (e) => {
        console.log(e);
    });
    </script>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("logged in!") }}
                </div>
            </div>

            <span id="msg"></span>

            <div class=" text-white font-sans">
                <div class="container bg-gradient-to-br from-purple-400 via-pink-500 to-red-500 mx-auto max-w-screen-md p-4">
                    <div class="bg-white bg-opacity-90 shadow-md rounded-lg p-4">
                        <!-- Chat header -->
                        <div class="flex items-center justify-between border-b-2 border-gray-200 pb-2">
                            <div class="text-lg font-semibold text-gray-800">{{ Auth::user()->_id }}</div>
                            <div class="text-lg font-semibold text-gray-800" id="typing"></div>
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
            </div>
        </div>
    </div>
</x-app-layout>


<h5 id="typing"></h5>

<div>
    <h2>Notification</h2>
    

</div>

<!-- <button id="myButton">CLICK</button> -->
<!-- <button onclick="handleSubmitNewMessage()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-5">Submit</button> -->
<!-- <button onclick="handle()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-5">Submit</button> -->


<!-- <input type="text" onfocus="handleSubmitNewMessage()"> -->

<input type="text" id="myInput">

<button onclick="hi()" class="btn btn-success">Hi</button>


<!-- <script>
    // ws://localhost:6001/app/12345
    const socket = io(`ws://localhost:6001/websocket`, {
  query: {
    appKey: '12345',
  },
});
console.log({socket});
</script> -->

<!-- <script>
    const socket = io(`http://${window.location.hostname}:6001`, {
  query: {
    appKey: '12345',
  },
});

socket.on('connect', () => {
  console.log('Socket.IO connection opened');
});

function hello() {
  const message = {
    id: 1,
    payload: {
      name: "Rosan",
      message: "Hello, server!"
    }
  };

  // Send the message to the server
  socket.emit('message', JSON.stringify(message));
}
</script> -->







<button onclick="hello()">HELLO</button>

<script>
    const inputElement = document.getElementById('myInput');
    inputElement.addEventListener('focus', () => {
        Echo.private(`chat`)
            .whisper('typing', {
                name: sender
            });
    });

    // Remove the text when the input field loses focus
    inputElement.addEventListener('blur', () => {
        Echo.private(`chat`)
            .whisper('typing', {
                name: false
            });
    });
</script>

<script>
    let socket = new WebSocket(`ws://${window.location.hostname}:6001/websocket?appKey=12345`);
    socket.onopen = function(event) {console.log('WebSocket connection opened');}

    function hello() {

        const message = {
        id: 1,
        payload: {
            name: "Rosan",
            message: "Hello, server!"
        }
    };
    socket.send(JSON.stringify(message));
        
    }
    
    socket.onmessage = function(event) {
        console.log("event", event);
    }

</script>

<script>
    Echo.private(`chat`)
        .listenForWhisper('typing', (e) => {
            console.log(e);
            if (e.name.name) {
                document.getElementById('typing').innerHTML = e.name.name + " is typing"
            } else {
                document.getElementById('typing').innerHTML = ""
            }

        });
</script>