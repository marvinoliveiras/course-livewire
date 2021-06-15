<?php
namespace App\Http\Livewire\User;
use Livewire\{Component,
    WithFileUploads};
use Illuminate\Support\Str;
class UploadPhoto extends Component
{
    use WithFileUploads;
    public $photo;
    public function render()
    {
        return view('livewire.user.upload-photo');
    }
    public function storagePhoto()
    {
        $user = auth()->user();
        $this->validate([
            'photo' => 'required|image|max:3072'
        ]);
        $nameFile = Str::slug($user->name)
            .'.'.$this->photo
            ->getClientOriginalExtension();
        $path = $this->photo
            ->storeAs('users',$nameFile);
        if($path){
            $user->profile_photo_path = $path;
            $user->update();
            return redirect()
                ->route('tweets.index');
        }
    }
}
