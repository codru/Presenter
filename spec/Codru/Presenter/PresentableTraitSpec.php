<?php

namespace spec\Codru\Presenter;

use Codru\Presenter\PresentableTrait;
use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PresentableTraitSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('spec\Codru\Presenter\Foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('spec\Codru\Presenter\Foo');
    }

    function it_fetches_a_valid_presenter()
    {
        Mockery::mock('FooPresenter');

        $this->present()->shouldBeAnInstanceOf('FooPresenter');
    }

    function it_throws_up_if_invalid_presenter_provided()
    {
        $this->presenter = 'Invalid';

        $this->shouldThrow('Codru\Presenter\Exceptions\PresenterException')
            ->during('present');
    }

    function it_caches_the_presenter_for_future_use()
    {
        Mockery::mock('FooPresenter');

        $one = $this->present();
        $two = $this->present();

        $one->shouldBe($two);
    }
}

class Foo
{
    use PresentableTrait;

    public $presenter = 'FooPresenter';
}
