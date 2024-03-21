<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Ministry GPdI Maranatha Medan</title>
    <link rel="icon" href="/images/logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        .container-fluid {
            height: 93%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-nav {
            height: 7%;
            width: 100%;
            display: flex;
            justify-content: left;
            align-items: center;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container-nav">
            <a class="navbar-brand" href="#">
                <img src="/images/logo2.jpg" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top">
                <span class="text-white">Data Ministry GPdI Maranatha Medan</span>
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h1 class="card-title text-center">{{ $counter->title }}</h1>
                </div>
                <div class="card-body text-center">
                    <h2 style="font-size: 160px" class="mb-5"><span id="counter">{{ $counter->count }}</span></h2>
                    <div class="btn-group mt-3" role="group">
                        <button id="decrement" type="button" class="btn btn-danger btn-lg mr-5"
                            style="padding: 18px 40px;">
                            <h1> - </h1>
                        </button>
                    </div>
                    <div class="btn-group mt-3" role="group">
                        <button id="increment" type="button" class="btn btn-success btn-lg"
                            style="padding: 18px 35px;">
                            <h1> + </h1>
                        </button>
                    </div>
                </div>
                <a href="/dashboard" class="btn btn-info mt-3">Submit</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var counterId = {{ $counter->id }}; // Get the initial counter ID

            $('#increment').click(function() {
                $.ajax({
                    type: 'POST',
                    url: '/increment/' + counterId, // Use the current counter ID
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#counter').text(data.count);
                    }
                });
            });

            $('#decrement').click(function() {
                $.ajax({
                    type: 'POST',
                    url: '/decrement/' + counterId, // Use the current counter ID
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#counter').text(data.count);
                    }
                });
            });
        });
    </script>
</body>

</html>
