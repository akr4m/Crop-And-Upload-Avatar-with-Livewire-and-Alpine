<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Spatie\Image\Image;
use Livewire\WithFileUploads;

class Avatar extends Component
{
    use WithFileUploads;
    
    public $avatar;

    public $x;
    public $y;
    public $width;
    public $height;

    public function render()
    { 
        return view('livewire.user.avatar');
    }

    public function save()
    {
        $avatar = $this->avatar->store('avatars', 'public');

        Image::load(storage_path('app/public/' . $avatar))
            ->manualCrop($this->width, $this->height, $this->x, $this->y)
            ->save();

        auth()->user()->update(compact('avatar'));

        $this->avatar = null;
    }
}
