<?php

namespace App;


class SageParentResource extends SageResource {

    protected $items;

    public function __construct($json = null){
        $this->items = collect($json["items"]);
        unset($json["items"]);
        parent::__construct($json);
    }

    public function items() {
        return $this->items;
    }

    public function create( $tags = [] ){
        parent::create($tags);
        return $this->createItems();
    }

    public function createItems(){
        $this->items = collect($this->items)->map(function ($item){
            $item->setParentId($this->Id);
            return $item->create();
        });
        return $this;
    }

    public function destroy(){
        $this->items->each(function ($item) {
            $item->destroy();
        });
        parent::destroy();
    }
}