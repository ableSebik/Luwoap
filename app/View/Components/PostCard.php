<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostCard extends Component
{
    public $blogPost;
    public $postDay;
    public $postMonth;

    public function __construct($blogPost, $postDay, $postMonth)
    {
        $this->blogPost = $blogPost;
        $this->postDay = $postDay;
        $this->postMonth = $postMonth;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}
