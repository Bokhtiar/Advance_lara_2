@extends('welcome')
@section('user_content')


    <a href="{{ route('todos.index') }}">List Of Todos</a>
    <form action="" method="POST" class="form-group">
        @csrf
        <div class="mb-3 form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="mb-3 form-group">
            <label for="">Description</label>
            <textarea name="description" id="description" cols="10" rows="3" class="form-control"></textarea>
        </div>
        <div class="mb-3 form-group">
            <input type="submit" name="" id="submit" value="Create New Todo" id="">
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //store
        $(document).on('click', '#submit', function(e){
            e.preventDefault();
            var data = {
                'title' : $('#title').val(),
                'description' : $('#description').val(),
            }
            $.ajax({
                url: '/todo/store',
                type: 'POST',
                data: data,
                dataType: 'json',
                success:function(response){
                    console.log(response)
                }//end succss function
            });
        });
    </script>
@endsection
