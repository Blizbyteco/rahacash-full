<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Layout extends Component
{
    public $title;

    public function __construct($title = null)
    {
        return $this->title = $title ?? config("app.name");
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layout.app');
    }

}
