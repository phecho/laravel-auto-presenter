<?php namespace McCool\LaravelAutoPresenter;

use McCool\LaravelAutoPresenter\Decorators\AtomDecorator;
use McCool\LaravelAutoPresenter\Decorators\CollectionDecorator;
use McCool\LaravelAutoPresenter\Decorators\PaginatorDecorator;

class PresenterDecorator
{
    /**
     * The decorators.
     *
     * @var array
     */
    protected $decorators = array();

    /**
     * Create a new presenter decorator.
     *
     * This is the class that decorates models, paginators and collections.
     *
     * @param \McCool\LaravelAutoPresenter\Decorators\AtomDecorator       $atom
     * @param \McCool\LaravelAutoPresenter\Decorators\CollectionDecorator $collection
     * @param \McCool\LaravelAutoPresenter\Decorators\PaginatorDecorator  $pagination
     *
     * @return void
     */
    public function __construct(AtomDecorator $atom, CollectionDecorator $collection, PaginatorDecorator $pagination)
    {
        $this->decorators['atom'] = $atom;
        $this->decorators['collection'] = $collection;
        $this->decorators['pagination'] = $pagination;
    }

    /**
     * Things go in, get decorated (or not) and are returned.
     *
     * @param mixed $subject
     *
     * @return mixed
     */
    public function decorate($subject)
    {
        foreach ($this->decorators as $decorator) {
            if ($decorator->canDecorate($subject)) {
                return $decorator->decorate($subject);
            }
        }

        return $subject;
    }
}
