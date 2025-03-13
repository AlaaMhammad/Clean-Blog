<x-layout>

    <header class="masthead" style="background-image: url('{{ asset('website/assets/img/home-bg.jpg') }}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Category: {{ $category->name }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @foreach ($posts as $post )
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="{{ route('website.post', $post) }}">
                            <h2 class="post-title">{{ $post->title }}</h2>
                            <h3 class="post-subtitle">{{ $post->subtitle }}</h3>
                        </a>
                        <p class="post-meta">
                            Posted in <a href="{{ route('website.category', $post->category->slug) }}"> {{ $post->category->name }} </a> by
                            <a href="{{ route('website.author', $post->author->username) }}">{{ $post->author->name }}</a>
                            on {{ $post->created_at->format('F d, Y') }} 
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                @endforeach
                {{ $posts->links() }}
                <!-- Pager-->
            </div>
        </div>
    </div>
</x-layout>

