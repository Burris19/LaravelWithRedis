@extends('app')

@section('content')
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" >
                <div id="messages" ></div>
            </div>
        </div>
    </div>
    <script>
        var socket = io.connect('http://192.168.10.10:8890', { query: 'id_store=2'});
        socket.on('message', function (data) {
            $( "#messages" ).append( "<p>"+data+"</p>" );
        });

        socket.on('new_order', function (data) {
            $( "#messages" ).append( "<p>Nueva order por " + data + "</p>" );
        });

        socket.on('new_user', function (data) {
            $( "#messages" ).append( "<p>Nuevo usuario " + data + "</p>" );
        });
    </script>


@endsection