<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\Group;
use Livewire\Component;

class Trello extends Component
{
    public $title;

    public $addGroup = false;

    public $addCard = '';

    protected $rules = [
        'title' =>'required'
    ];

    public function addGroup()
    {
        $this->addGroup = true;
    }

    public function addCard($group_id)
    {
        $this->addCard = $group_id;
    }

    public function deleteGroup($id)
    {
        Group::destroy($id);
    }

    public function deleteCard($id)
    {
        Card::destroy($id);
    }

    public function save()
    {
        $data = $this->validate();

        if($this->addGroup){
            Group::create($data);
        }
        else {
            $data['group_id']=$this->addCard;

            Card::create($data);
        }
    $this->reset();
    }

    public function sorting($order)
    {
        foreach ($order as $group){
            Group::where(['id'=>$group['value']])->update(['sort'=>$group['order']]);

            if(isset($group['items'])){
                foreach ($group['items'] as $item) {
                    Card::where(['id'=>$item['value']])->update(['sort'=>$item['order']]);
                }
            }
        }
    }

    public function render()
    {
        $groups= Group::orderby('sort')->get();

        return view('livewire.trello', [
                'groups'=>$groups,
            ]);
    }
}
