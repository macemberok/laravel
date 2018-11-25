<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pusher Test 📣</title>

    <meta name="yandex-verification" content="00d98bf50974d4bf" />

    <link href="/stylesheets/noty.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>

    <script src="/javascripts/bounce.js"></script>
    <script src="/javascripts/noty.js"></script>

    <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        const pusher = new Pusher('526e8d0c6abbea2a93c5', {
            cluster: 'us2',
            forceTLS: true
        });

        const channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            new Noty({
                text: "📢 🔔 Currency: " + data.message.currency + " - " + data.message.signal,
                type: 'warning',
                animation: {
                    open: function (promise) {
                        var n = this;
                        new Bounce()
                            .translate({
                                from     : {x: 450, y: 0}, to: {x: 0, y: 0},
                                easing   : "bounce",
                                duration : 1000,
                                bounces  : 4,
                                stiffness: 3
                            })
                            .scale({
                                from     : {x: 1.2, y: 1}, to: {x: 1, y: 1},
                                easing   : "bounce",
                                duration : 1000,
                                delay    : 100,
                                bounces  : 4,
                                stiffness: 1
                            })
                            .scale({
                                from     : {x: 1, y: 1.2}, to: {x: 1, y: 1},
                                easing   : "bounce",
                                duration : 1000,
                                delay    : 100,
                                bounces  : 6,
                                stiffness: 1
                            })
                            .applyTo(n.barDom, {
                                onComplete: function () {
                                    promise(function(resolve) {
                                        resolve();
                                    })
                                }
                            });
                    },
                    close: function (promise) {
                        var n = this;
                        new Bounce()
                            .translate({
                                from     : {x: 0, y: 0}, to: {x: 450, y: 0},
                                easing   : "bounce",
                                duration : 500,
                                bounces  : 4,
                                stiffness: 1
                            })
                            .applyTo(n.barDom, {
                                onComplete: function () {
                                    promise(function(resolve) {
                                        resolve();
                                    })
                                }
                            });
                    }
                }
            }).show();

            const ting = new Audio("{{ asset("ting.mp3") }}");
            ting.autoplay = true;
            ting.play();

        });
    </script>
</head>
<body>
<h1>Pusher Test 🎯</h1>
<p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>. 🎭
</p>
</body>