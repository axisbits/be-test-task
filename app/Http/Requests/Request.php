<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * @var array<mixed,mixed>
     */
    private $validated = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Returns the validation rules that apply to the request.
     *
     * @return array<string,array<mixed,mixed>>
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Get the validated data from the request.
     *
     * @param array<mixed,mixed>|int|string|null $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        return \data_get($this->mergeValidated($validated), $key, $default);
    }

    /**
     * Allows to make changes into validated data.
     *
     * @param array<mixed,mixed> $validated
     *
     * @return array<mixed,mixed>
     */
    protected function mergeValidated(array $validated): array
    {
        return \array_merge_recursive($validated, $this->validated);
    }

    /**
     * Allows to make changes into validated data.
     *
     * @param array<mixed,mixed> $validated
     *
     * @return void
     */
    protected function addValidated($validated): void
    {
        $this->validated = $validated;
    }

    /**
     * @param mixed $keys
     *
     * @return array<int|string,mixed>
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validatedArray(...$keys): array
    {
        if (empty($keys)) {
            return $this->validated();
        }

        foreach ($keys as $key) {
            $validated[$key] = \data_get($this->validated(), $key);
        }

        return $validated;
    }
}
