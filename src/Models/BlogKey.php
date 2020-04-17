<?php

namespace Capmega\Blog\Models;

use Capmega\Base\Models\ResourceModel;

class BlogKey extends ResourceModel
{

    public function save(array $options = [])
    {
        $this->generateSeoname();
        $this->generateSeoname('value', 'seovalue');
        parent::save($options);
    }
}
