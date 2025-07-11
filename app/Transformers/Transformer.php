<?php

namespace App\Transformers;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;
use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{
    /**
     * Transform entity.
     *
     * @param mixed $model
     *
     * @return array<mixed,mixed>
     *
     * @throws \Illuminate\Database\Eloquent\InvalidCastException
     */
    public function transform($model): array
    {
        return $model->toArray();
    }

    /**
     * Call Include Method.
     *
     * @param Scope $scope
     * @param string $includeName
     * @param mixed $data
     *
     * @throws \Exception
     *
     * @return ResourceInterface|false
     */
    protected function callIncludeMethod(Scope $scope, string $includeName, mixed $data): ResourceInterface|false
    {
        /** @var ResourceInterface $resource */
        $resource = parent::callIncludeMethod($scope, $includeName, $data);

        return $resource->getData() ? $resource : $this->null();
    }
}
