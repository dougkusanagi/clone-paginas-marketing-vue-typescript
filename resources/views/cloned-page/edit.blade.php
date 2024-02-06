<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <style>
        body {
            background: #eee;
            padding: 12px;
        }

        #host {
            background: #fff;
            padding: 12px;
        }
    </style>

    @vite(['resources/js/app.js'])
</head>

<body>
    <p>
        <button type="button" id="saveCopy">Salvar</button>
    </p>

    <div id="host"></div>
</body>

</html>
