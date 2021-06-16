<?php
namespace App\Http\Livewire;
use App\Models\{Tweet};
use Livewire\{Component,
    WithPagination
};
class TweetController extends Component
{
    use WithPagination;
    public $content;
    protected $rules = [
        'content' =>
            'required|min:3|max:255',
    ];
    public function render()
    {
        $tweets = Tweet::with('user')
            ->latest()
            ->paginate(15);
        return view(
            'livewire.show-tweets',
            ['tweets' => $tweets]
        );
    }
    public function create()
    {
        $this->validate();
        auth()->user()->tweets()
            ->create([
                'content' =>
                    $this->content
            ]);
        $this->content = '';
        /*Tweet::create([
            'content' =>
                $this->content,
            'user_id' =>
                $auth()->user()->id
        ]);*/
    }
    public function like($idTweet)
    {
        $tweet = Tweet::find($idTweet);
        $tweet->likes()->create([
            'user_id' =>
                auth()->user()->id
        ]);
    }
    public function unLike(Tweet $tweet)
    {
        $tweet->likes()->delete([
            'user_id' =>
                auth()->user()->id
            
        ]);
    }
}
