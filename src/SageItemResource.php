<?php

namespace App;


class SageItemResource extends SageResource {

    const PARENT_ID     = null;

    public function setParentId($parentId) {
        $this->attributes[static::PARENT_ID] = $parentId;
    }

}