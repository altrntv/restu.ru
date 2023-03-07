<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .content {
            display: flex;
            height: 100vh;
        }

        .wok {
            width: 65%;
            padding: 0 3em;
        }

        .salad {
            width: 35%;
            padding: 0 3em;
            background-color: #ef4507;
        }

        h1 {
            font-size: 4em;
            text-transform: uppercase;
        }

        .salad {
            color: white;
        }

        table.iksweb {
            width: 100%;
        }

        td {
            font-size: 2em;
            padding: 0.25em 0;
        }
    </style>
</head>
<body>
<div class="content">

    <div class="wok">
        <h1>Wok</h1>
        <table class="iksweb">
            <tbody>
            @foreach($nomenclature as $product)
                @if(stripos($product->name, 'Салат') === false)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }} руб.</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="salad">
        <h1>Салаты</h1>
        <table class="iksweb">
            <tbody>
            @foreach($nomenclature as $product)
                @if(stripos($product->name, 'Салат') !== false)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }} руб.</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
