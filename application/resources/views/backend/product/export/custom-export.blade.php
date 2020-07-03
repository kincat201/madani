<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

<table>
    <tr style="font-weight:bold">
        <td>No</td>
        @foreach($model as $field => $value)
            <td>{{$value}}</td>
        @endforeach
    </tr>
    @foreach($datas as $key => $data)
        <tr>
            <td>{{$key+1}}</td>
            @foreach($model as $field => $value)
                <td>{{$data->$field}}</td>
            @endforeach
        </tr>
    @endforeach
</table>

<style>
    h4{
        text-align : center;
    }
    table tr td{
        border : 1px solid #000;
        vertical-align : center;
        text-align : center;
    }
</style>
</body>
</html>
