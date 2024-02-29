<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Komentar {{ $count1 + $count2 }}</h5>
            @if (auth()->check())
            <form action="/posts/{{ $post->slug }}/store" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Tulis Komentar</label>
                    <textarea name="body" class="form-control" id="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
            @endif
            @foreach ($post->comments as $comment)
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                <img src="/image/avatar.png" alt="User Avatar" class="img-fluid rounded-circle" style="width:50px;">
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <p class="mt-3">{{ $comment->body }}</p>
                        <div class="d-flex align-items-center justify-content-between">
                            @if (auth()->check())
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-reply-id="{{ $comment->id }}" data-bs-target="#exampleModal{{ $comment->id }}">
                                Balas
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form class="form" id="replyBox2{{ $comment->id }}" action="/posts/{{ $post->slug }}/comments/{{ $comment->id }}/replies" method="POST" data-reply-id="{{ $comment->id }}">
                                        @csrf
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="body" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                                    <label for="floatingTextarea2">Comments</label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="d-flex align-items-center justify-content-end">
                                <small><i class="bi bi-chat"></i> {{ $count3[$comment->id] }}</small>
                                @if(auth()->check() && auth()->user()->id == $comment->user_id)
                                <form action="{{ route('comment.destroy', ['comment' => $comment, 'slug' => $slug]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="" style=" border:0ch; background-color:white;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                        </svg></button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @foreach ($comment->replies as $reply)
                            @if ($reply->parent === null)
                            <div class="reply mt-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <img src="/image/avatar.png" alt="User Avatar" class="img-fluid rounded-circle" style="width:50px;">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $reply->user->name }}</h6>
                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <p class="mt-3"><strong>{{ $reply->parent ? $reply->parent->user->name : $reply->comment->user->name }}</strong> - {{ $reply->body }}</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    @if(auth()->check())
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-reply-id="{{ $reply->id }}" data-bs-target="#exampleModalReply{{ $reply->id }}">
                                        Balas
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalReply{{ $reply->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form class="form" id="replyBox{{ $reply->id }}" action="/posts/{{ $post->slug }}/comments/{{ $comment->id }}/replies/{{ $reply->id }}/replies" method="POST" data-reply-id="{{ $reply->id }}">
                                                @csrf
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <textarea class="form-control" name="body" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                                            <label for="floatingTextarea2">Comments</label>
                                                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                            <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-end">
                                        @if(auth()->check())
                                            @if(auth()->user()->isAdmin() || auth()->user()->id == $reply->user_id)
                                        <form action="{{ route('reply.destroy', ['reply' => $reply, 'slug' => $slug]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="" style=" border:0ch; background-color:white;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                </svg></button>
                                        </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @foreach ($reply->replies as $childReply)
                                <div class="ml-3">
                                    <div class="reply mt-5">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <img src="/image/avatar.png" alt="User Avatar" class="img-fluid rounded-circle" style="width:50px;">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $childReply->user->name }}</h6>
                                                <small class="text-muted">{{ $childReply->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <p class="mt-2"><strong>{{ $childReply->parent ? $childReply->parent->user->name : $childReply->comment->user->name }}</strong>- {{ $childReply->body }}</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            @if (auth()->check())
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-reply-id="{{ $childReply->id }}" data-bs-target="#exampleModal{{ $childReply->id }}">
                                                Balas
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $childReply->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form class="form" id="replyBox2{{ $childReply->id }}" action="/posts/{{ $post->slug }}/comments/{{ $comment->id }}/replies/{{ $childReply->id }}/replies" method="POST" data-reply-id="{{ $childReply->id }}">
                                                        @csrf
                                                            <div class="modal-body">
                                                                <div class="form-floating">
                                                                    <textarea class="form-control" name="body" placeholder="Leave a comment here" id="floatingTextarea2"></textarea>
                                                                    <label for="floatingTextarea2">Comments</label>
                                                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                                    <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="d-flex align-items-center justify-content-end">
                                            @if(auth()->check())
                                                @if(auth()->user()->isAdmin() || auth()->user()->id == $childReply->user_id)
                                                <form action="{{ route('reply.destroy', ['reply' => $childReply, 'slug' => $slug]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="" style=" border:0ch; background-color:white;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                        </svg></button>
                                                </form>
                                                @endif
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach  
                            </div>                                 
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>