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
        return view(
            'livewire.user.upload-photo'
        );
    }
    public function storagePhoto()
    {
        $this->validate([
            'photo' =>
                'required|image|max:3072'
        ]);
        $user = auth()->user();
        $path = $this->uploadPhoto(
            $user->name
        );
        if($path){
            $this->updateDatabase($user,
                $path
            );
            return redirect()
                ->route('tweets.index');
        }
    }
    protected function uploadPhoto($userName)
    {
        $nameFile = Str::slug($userName)
            .'.'.$this->photo
            ->getClientOriginalExtension();
        return $this->photo
            ->storeAs('users',$nameFile);
    }
    protected function updateDatabase(
        $user, $path)
    {
        $user->profile_photo_path = $path;
        $user->update();
    }
}