<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        function functionBefore(){
            $("#information").text("five minute please. . .")
        }
        function funcSuccess(data){
            $("#information").text(data)
        }

        $(document).ready(function(){
            $("#load").bind("click",function (){
                var admin='Admin';
                $.ajax({
                    url:"blog/public/ajax/content.php",
                    type:"POST",
                    data:({name:admin,number:5}),
                    dataType:"html",    //указываем тип данных которые передаются
                    beforSend:functionBefore, //функция которая будет выполнятся во время отправки   данных на сервер
                    success:funcSuccess  // функция в случаи выполнения скрипта
                });
            });
        });

    </script>
</head>
<body>
<p>All as working</p>
<p id="load" style="cursor:pointer">Загрузить данные</p>
<div id="information"></div>
</body>
</html>