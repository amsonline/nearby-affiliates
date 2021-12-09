<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invitees list</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="/style.css" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="pane">
            <div class="header">
                Invitees list
            </div>
            <div class="list-title">
                The following affiliates are living within 100km of our office, so we can invite them for our upcoming ceremony
            </div>
            <div class="list-content-wrapper">
                <div class="invitee-id">Affiliate ID</div>
                <div class="invitee-name">Name</div>
                <div class="invitee-id">Affiliate ID</div>
                <div class="invitee-name">Name</div>
                @foreach ($invitees as $invitee)
                        <div class="invitee-id">{{$invitee->affiliate_id}}</div>
                        <div class="invitee-name">{{$invitee->name}}</div>
                @endforeach
            </div>
        </div>
    </body>
</html>
