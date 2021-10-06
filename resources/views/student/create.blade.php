<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <form action="">
        <ul>
        </ul>
        <div class="form-group">
            <label for="">name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="">phone</label>
            <input class="form-control" type="text" name="phone" id="phone">
        </div>
        <div class="form-group">
            <label for="">name</label>
            <input class="form-control" type="email" name="name" id="email">
        </div>
        <div class="form-group">
            <label for="">name</label>
            <input class="form-control" type="text" name="course" id="course">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary add_student" name="" id="">
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

                $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });


        $(document).on('click', '.add_student', function(e){
            e.preventDefault();
            var data = {
                'name' :  $('#name').val(),
                'phone' :  $('#phone').val(),
                'email' :  $('#email').val(),
                'course' :  $('#course').val(),
            }



            $.ajax({
                url : '/student/store',
                type: 'POST',
                data: data,
                dataType: 'json',
                success:function(response){
                    $.each(response.errors, function(key, data){
                        $('ul').append('<li>'+data+'</li>')
                    })
                }

            })
        })
    </script>


</body>
</html>
