<div>
    <p>Show tweets</p>
    <form method="POST" wire:submit.prevent="create">
        <input name="content" id="content" type="text" cols="30" rows="10" wire:model="content">
        @error('content') {{ $message }} @enderror
        <button>Criar Tweet</button>
    </form>
    <hr>
    @foreach($tweets as $tweet)
        @if($tweet->user->photo)
            <img src="{{ url('storage/'.$tweet->user->photo)}}" alt="">
        @else
            <img src="{{ url('img/pizza.jpg')}}" alt="">
        @endif
        {{$tweet->user->name}} - {{$tweet->content}}
        @if($tweet->likes->count())
            <a href="#" title="deslike" wire:click.prevent="unLike({{$tweet->id}})">Deslike</a>
        @else
        <a href="#" title="Like" wire:click.prevent="like({{$tweet->id}})">Like</a>
        @endif<br>
    @endforeach
    </hr>
    <div>
        {{$tweets->links()}}
    </div>

</div>
