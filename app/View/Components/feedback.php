<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class feedback extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;
    public $comment;
    public $stars;
    public $createdAt;
    public $editable;
    public $id;

    public function __construct($title, $comment, $stars, $createdAt, $editable, $id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->comment = $comment;
        $this->stars = is_object($stars) && method_exists($stars, '__toString')
            ? (int)$stars->__toString()
            : (int)$stars;        $this->createdAt = $createdAt;
        $this->editable = $editable;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feedback');
    }

    public function stars()
    {
        $starsValue = is_object($this->stars) && method_exists($this->stars, '__toString')
            ? (int)$this->stars->__toString()
            : (int)$this->stars;

        return [
            'full' => max(0, min(5, $starsValue)),
            'empty' => max(0, min(5, 5 - $starsValue))
        ];
    }

    /**
     * Format the date
     */
    public function formattedDate()
    {
        return $this->createdAt->format('d/m/Y H:i');
    }

}
