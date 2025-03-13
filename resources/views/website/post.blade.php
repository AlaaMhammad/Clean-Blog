<x-layout>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('{{ asset($post->image) }}')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{ $post->title }}</h1>
                            <h2 class="subheading">{{ $post->subtitle }}</h2>
                            <span class="meta">
                                Posted in <a href="{{ route('website.category', $post->category->slug) }}"> {{ $post->category->name }} </a> by
                                <a href="{{ route('website.author', $post->author->username) }}">{{ $post->author->name }}</a>
                                on {{ $post->created_at->format('F d, Y') }} 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </article>
</x-layout>
