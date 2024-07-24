<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table{
            border:1px solid #ccc;

        }
        /*table tr{*/
        /*    border:1px solid #ccc;*/
        /*}*/
        table tr td{
            border:1px solid #ccc;
        }
    </style>
</head>
<body>

<h2> مرحبا  </h2>
<p>  لديك حجز جديد    </p>
<table class="table table-bordered">
    <tbody>
    <tr>
        <td>  الاسم   </td>
        <td> {{$name}} </td>
    </tr>
    <tr>
        <td> البريد الالكتروني  </td>
        <td> {{$email}} </td>
    </tr>
    <tr>
        <td> رقم الهاتف  </td>
        <td>  {{ $phone  }}</td>
    </tr>
    <tr>
        <td> بداية الرحلة  </td>
        <td> {{ $place_from }} </td>
    </tr>
    <tr>
        <td> مكان الوصول  </td>
        <td> {{$place_to}} </td>
    </tr>
    <tr>
        <td> تاريخ الحجز  </td>
        <td> {{ $travel_date  }} </td>
    </tr>
    <tr>
        <td> توقيت الحجز  </td>
        <td> {{$travel_time}} </td>
    </tr>
    </tbody>
</table>

</body>
</html>
