<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Define Charset -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Responsive Meta Tag -->
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

        <!-- Responsive and Valid Styles -->
        <style type="text/css">
            body{
                width: 100%;
                background-color: #F1F2F7;
                margin:0;
                padding:0;
                -webkit-font-smoothing: antialiased;
                font-family: Helvetica, Arial, sans-serif;
            }

            html{
                width: 100%;
            }

            table{
                font-size: 11px;
                border: 0;
            }

            .header {
                text-align: center;
                margin: 30px auto;
            }

            article{
                padding:30px 100px;
            }

            footer{
                background-color: #7087A3;
                text-align: center;
                color:#fff;
                padding:5px;
            }

            .break{
                padding:5px 0px;
            }
            
        </style>
    </head>

    <body>
        <header>
            <div class="header">
                <img  style="position: absolute;left: 105px;" src="{{ url('storage'.'/'.$CONF->logo) }}" alt="logo" width="155">
                <h2 style="text-align: right; margin-right: 100px; padding-bottom:10px;">PENGAJUAN SIMPANAN</h2>
            </div>
        </header>
        <article style="padding-top:120px">
            @yield('content')
        </article>
        <footer style="position: absolute;bottom: 0; width: 100%;text-align: center;">
            Copyright © {{date('Y')}} {{$CONF->title}}. All Rights Reserved
        </footer>
    </body>
</html>
