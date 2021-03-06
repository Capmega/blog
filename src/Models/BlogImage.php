<?php

namespace Capmega\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Capmega\Base\Helpers\{Images, Html};

class BlogImage extends Model
{
    public function blogPost()
    {
        return $this->hasOne('Capmega\Blog\Models\BlogPost', 'id', 'blog_post_id');
    }

    public function save(array $options = [])
    {
        if (empty($this->id)) {
            $this->sizes = $this->blogPost->sizes;
        }
        parent::save($options);
    }

    public function getSizesAttribute($value)
    {
        return unserialize($value);
    }

    public function removeImage($rm_original = true)
    {
        Images::removeImage('blogs/'.$this->blog_post_id.'/', $this->id, $this->extension, $rm_original);
    }

    public function convertImage()
    {
        Images::convertImage('blogs/'.$this->blog_post_id.'/', $this->id, $this->extension, $this->sizes);
    }

    public function getImage($size = 'medium', $htmlOptions = [], $options = [])
    {
        return Html::image(
            'storage/blogs/'.$this->blog_post_id.'/'.$this->id.'-'.$size.'.jpg',
            array_merge($htmlOptions, ['alt' => $this->alt]),
            $options
        );
    }

    public function getUrl($size = 'medium')
    {
        return asset('storage/blogs/'.$this->blog_post_id.'/'.$this->id.'-'.$size.'.jpg');
    }
}
