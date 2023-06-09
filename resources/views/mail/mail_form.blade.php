<html lang="en">
<head>
    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 40%;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        .container {
            padding: 2px 16px;
        }
        .middle {
            margin-right: auto;
            margin-left: auto;
        }
    </style>
    <title>Mail</title>
</head>
<body>
<div class="card middle">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" alt="Avatar" style="width:100%">
    <div class="container">
        <h4 style="text-align: center; font-size: 32px;"><b>VDT Laravel App</b></h4>
            <p style="font-size: 16px;">Your new password is: "{{ $data_user['password'] }}"</p>
        <p>Thanks for reading</p>
    </div>
</div>
</body>
</html>
