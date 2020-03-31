<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 5.8 - PHP Training Schema</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .table td, .table th {
            padding: 0.25rem !important;
            vertical-align: middle !important;
        }
        .fa.fa-plus, .fa.fa-2x.fa-plus{
            color: #178613;
        }
        .fa.fa-plus:hover, .fa.fa-2x.fa-plus:hover{
            color: #32c90c;
        }
        .fa.fa-pencil, .fa.fa-2x.fa-pencil{
            color: #2a1d76;
        }
        .fa.fa-pencil:hover, .fa.fa-2x.fa-pencil:hover{
            color: #4b34d2;
        }
        .fa.fa-trash{
            color: #760925;
        }
        .fa.fa-trash:hover{
            color: #cd1040;
        }
        .fa.fa-2x.fa-home{
            color: #764b2b;
        }
        .fa.fa-2x.fa-home:hover{
            color: #d3864d;
        }
        .fa {
            opacity: 1;
            font-size: 18px;
            width: 24px;
            display: inline-block;
            border-radius: 50%;
            box-shadow: 1px 1px 2px 2px #ccc;
            padding: .15em .15em;
            background: #fff;
            cursor: pointer;
            line-height: 18px!important;
            margin-top: 5px;
            color: #454545;
        }
        .fa.fa-2x {
            font-size: 24px;
            width: 48px;
            display: inline-block;
            border-radius: 50%;
            box-shadow: 1px 1px 2px 2px #ccc;
            padding: .28em .28em;
            background: #fff;
            cursor: pointer;
            line-height: 32px!important;
            margin-top: 5px;
            color: #454545;
        }
    </style>
</head>
<body>
<div class="container">
    @yield('main')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $(function () {
        TriggerAlertClose();
    });

    function TriggerAlertClose() {
        window.setTimeout(function () {
            $(".alert").fadeTo(300, 0).slideUp(300, function () {
                $(this).remove();
            });
        }, 1000);
    }
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>
</body>
</html>
