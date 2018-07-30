@if ($posts)
        <div class="row">
            @foreach ($posts as $post)
                <div class="post">
                    <div class="col-md-4 col-sm-6 col-xs-8">
                        <div class="panel panel-default">
                            <div class="panel-heading text-center">
                                <img src="{{ $post->image_url }}" width="100%" height="100%" alt="">
                            </div>
                            <div class="panel-body text-center">
                                @if ($post->id)
                                    <p class="post-content"><a href="{{ route('posts.show', $post->id) }}">{{ $post->content }}</a></p>
                                @else
                                    <p class="item-content"><a href="#">{{ $post->content }}</a></p>
                                @endif
                                
                                <p class="post-content">{{ $post->restaurant_name }}</p>
                                
                                <div class="buttons text-center">
                                    @if (isset($post->like_count))
                                        <?php $like_number = $post->like_count ?>
                                    @else
                                        <?php $like_number = 0 ?>
                                    @endif
                                        
                                    <div class="like-number">
                                        <p class="text-center">{{ $like_number }} Likes</p>
                                    </div>
                                        
                                    @if (Auth::check())
                                        @include('posts.like_button', ['post' => $post])
                                    @endif
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif