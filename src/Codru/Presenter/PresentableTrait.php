<?php

namespace Codru\Presenter;

use Codru\Presenter\Exceptions\PresenterException;

trait PresentableTrait
{
    protected $presenterInstance;

    public function present()
    {
        if (!$this->presenter || !class_exists($this->presenter)) {
            throw new PresenterException("Please set the $this->presenter property to your presenter path.");
        }

        if (!isset($this->presenterInstance)) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }
}
