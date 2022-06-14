<div>
<div class="p-5">
    @if($addGroup)
        <form wire:submit.prevent="save">
            <input wire:model.defer="title" type="text">
        </form>
    @else
    <button wire:click="addGroup">
        Добавить
    </button>
    @endif
</div>

    <div wire:sortable="sorting" wire:sortable-group="" class="flex px-4 pb-8 mt-3">
        @foreach($groups as $group)
            <div wire:key="group-{{$group->id}}" wire:sortable.item="{{$group->id}}" class="p-2 mr-3">
                <div>
                    <h3 wire:sortable.handle> {{$group->title}}</h3>

                    <button wire:click="deleteGroup({{$group->id}})">x</button>
                </div>

                <div>
                    <div wire:sortable-group.item-group="{{$group->id}}">

                        @foreach($group->cards as $card)
                            <div wire:key="card-{{$card->id}}" wire:sortable-group.item="{{$card->id}}">
                                <span>{{$card->title}}</span>

                                <button wire:click="deleteCard({{$card->id}})">x</button>
                            </div>
                        @endforeach
                    </div>

                    @if($addCard==$group->id)
                        <form wire:submit.prevent="save">
                            <input wire:model.defer="title" type="text">
                        </form>
                    @else
                    <button wire:click="addCard({{$group->id}})" class="mt-3 mt-6">
                        Добавить
                    </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
