<?php

namespace App\Presenters;

use App\Transformers\Transformer;
use League\Fractal\TransformerAbstract;
use Prettus\Repository\Presenter\FractalPresenter;

class Presenter extends FractalPresenter
{
    /**
     * Transformer.
     *
     * @var string|TransformerAbstract
     */
    protected $transformer;

    /**
     * Set the transformer for the object.
     *
     * @param string|TransformerAbstract $transformer The transformer to set
     *
     * @return $this
     */
    public function setTransformer(string|TransformerAbstract $transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }

    /**
     * Transformer.
     *
     * @return TransformerAbstract $transformer
     */
    public function getTransformer(): TransformerAbstract
    {
        if (! $this->transformer) {
            return new Transformer;
        }

        $transformer = \is_object($this->transformer) ? $this->transformer : new $this->transformer;

        if (! $transformer instanceof TransformerAbstract) {
            throw new \Exception('Transformer must be an instance of '.TransformerAbstract::class);
        }

        return $transformer;
    }
}
