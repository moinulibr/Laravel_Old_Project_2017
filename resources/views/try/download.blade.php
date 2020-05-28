<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <table style="border:1px solid gray;">
            <tr style="border:1px solid gray;">
                <td style="border:1px solid gray;">Name</td>
                <td style="border:1px solid gray;">Email</td>
                <td style="border:1px solid gray;">Phone</td>
            </tr>
            @foreach ($users as $item)
                <tr style="border:1px solid gray;">
                    <td style="border:1px solid gray;">{{ $item->name }}</td>
                    <td style="border:1px solid gray;">{{ $item->email }}</td>
                    <td style="border:1px solid gray;">{{ $item->phone }}</td>
                </tr>
            @endforeach
    </table>
    
</body>
</html>