<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    protected $listeners=[
        'cancelEditing'=>'cancelEditing',
        'commentUpdated'=>'commentUpdated'
    ];
    public Comment $comment;
    public bool $editing = false;
    public bool $replying = false;
    public function mount(Comment $comment){
        $this->comment = $comment;
    }
    
    public function render()
    {
      
        return view('livewire.comment-item');
    
    }
    public function deleteComment(){
        $user = auth()->user();
        if(!$user){
            return redirect('/login');
        }

        
        if($this->comment->user_id != $user->id){
            return response('You are not allowed to perform this action.',403);
        }
        $id = $this->comment->id;
        $this->comment->delete();
        $this->dispatch('commentDeleted',$id);
    }
    public function  startCommentEdit(){
        $this->editing = true;
    }

    public function cancelEditing(){
        $this->editing = false;
    }
    public function commentUpdated(){
        $this->editing = false;
    }

    public function startReply(){
        $this->replying= true;
    }
}
