@foreach ($blogs as $blog )
            <div class="col-md-12 mb-4">
                <h2>#{{ $blog->id }} - {{ $blog->title }}</h2>
                <p>{{ $blog->description }}</p>
            </div>
 @endforeach