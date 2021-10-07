<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>ajax crud</title>
  </head>
  <body>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">index</th>
            <th scope="col">name</th>
            <th scope="col">phone</th>
            <th scope="col">email</th>
            <th scope="col">course</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
<br><br><br><br>

    <form action="">
        <ul>
        </ul>

        <div class="form-group">
            <input type="hidden" name=""  id="student_id">
            <label for="">name</label>
            <input  class="form-control" type="text" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="">phone</label>
            <input class="form-control"  type="text" name="phone" id="phone">
        </div>
        <div class="form-group">
            <label for="">email</label>
            <input class="form-control"  type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="">course</label>
            <input class="form-control"  type="text" name="course" id="course">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary add_student" value="submit" name="" id="">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary update_student" value="Update" name="" id="">
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

        getData();
        function getData(){
            $.ajax({
                url: '/students',
                type: 'GET',
                dataType: 'json',
                success:function(response){
                    console.log(response.students)
                    $('tbody').html("")
                    $.each(response.students, function(key, item){
                        $('tbody').append('<tr>\
                        <td>'+item.id+'</td>\
                        <td>'+item.name+'</td>\
                        <td>'+item.phone+'</td>\
                        <td>'+item.email+'</td>\
                        <td>'+item.course+'</td>\
                        <td> <button value="'+item.id+'" class="btn btn-primary edit"> edit </button> </td>\
                        <td> <button value="'+item.id+'" class="btn btn-danger delete"> delete </button> </td>\
                        </tr>')
                    })
                }
            });
        }
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
                    if(response.status == 400){
                        $.each(response.errors, function(key, data){
                        $('ul').append('<li>'+data+'</li>')
                        })
                    }else{
                        $('ul').text(response.message)
                        getData();
                    }
                }

            })
        })//store

        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var id = $(this).val();
            if(id){
                $.ajax({
                    url: '/students/edit/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success:function(response){
                        console.log(response.edit)
                        $('#student_id').val(response.edit.id)
                        $('#name').val(response.edit.name)
                        $('#phone').val(response.edit.phone)
                        $('#email').val(response.edit.email)
                        $('#course').val(response.edit.course)
                    }
                })
            }
        })//edit done

        $(document).on('click','.update_student', function(e){
            e.preventDefault();
            var id = $('#student_id').val();
            var data = {
                'name' :  $('#name').val(),
                'phone' :  $('#phone').val(),
                'email' :  $('#email').val(),
                'course' :  $('#course').val(),
            }
            if(id){
                $.ajax({
                    url:'/students/update/'+id,
                    type: 'POST',
                    data: data,
                    dataType: 'JSON',
                    success:function(response){
                        if(response.errors == 400){
                            $.each(response.errors, function(key, item){
                            $('ul').append('<li>'+item+'</li>')
                            })
                        }else{
                            $('ul').text('update successfully')
                            getData()
                        }

                    }
                })
            }
        })//update

        $(document).on('click', '.delete', function(e){
            e.preventDefault()
            var id = $(this).val()
            $.ajax({
                url:'/students/delete/'+id,
                type:'GET',
                dataType: 'json',
                success:function(response){
                    getData()
                }
            })
        })


    </script>


</body>
</html>
