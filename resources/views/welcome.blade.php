<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container" id="blogs-container">
        <div class="row text-center bg-dark text-light mb-3">
            <div class="col-md-12">
                <h1>Infinite Scroll</h1>
            </div>
        </div> 

        <div class="row my-5">
            @foreach ($blogs as $blog )
            <div class="col-md-12 mb-4">
                <h2>#{{ $blog->id }} - {{ $blog->title }}</h2>
                <p>{{ $blog->description }}</p>
            </div>
            @endforeach

            {{-- Loader --}}
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center mb-5" style="z-index: 9999" id="loader_con">
                    <div class="spinner-border" id="loader" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            {{-- Loader End--}}
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>

    let page = 2;
    let lastPage = {{ $blogs->lastPage() }};
    $(window).scroll(function (){
        // console.log('scrolling');
        // console.log('scrolling Top', $(window).scrollTop());
        // console.log('Document height', $(document).height());
        // console.log('widnow height', $(window).height());
        if($(window).scrollTop() + $(window).height() >= $(document).height() -5){
            if(lastPage >= page){
                loadBlogs(page);
                page++;
            }
        }

    });


    function loadBlogs(page){
        $.ajax({
        url: '/get-blogs',
        type: 'get',
        data: {page:page},
        dataType: 'json',
        beforeSend: function () {
            $('#loader').show();
            $('#loader_con').show();
        },
        success: function(response){
            console.log(page);
            console.log(response);
            if(response["status"] === true){
                    $('#blogs-container').append(response['html']);
                    $('#loader').hide();
                    $('#loader_con').hide();
             
            }else{
                $('#loader').hide();
                $('#loader_con').hide();
            }
        },
        error: function() {
            // Hide the loader in case of an error
            $('#loader').hide();
            $('#loader_con').hide();
        }
    });
    }
   
</script>


</html>