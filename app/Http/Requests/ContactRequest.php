<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Statamic\Facades\GlobalSet;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'     => ['required', 'string', 'min:2', 'max:100'],
            'last_name'      => ['required', 'string', 'min:2', 'max:100'],
            'email'          => ['required', 'email:rfc', 'max:255'],
            'phone'          => [
                'required',
                'string',
                'max:30',
                'regex:/^(?:(?:\+|00)33[\s.-]?|0)[1-9](?:[\s.-]?\d{2}){4}$/',
            ],
            'message'        => ['required', 'string', 'min:10', 'max:5000'],
            'website'        => ['prohibited'],
            'form_loaded_at' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        $messages = $this->cmsMessages();
        $messages['website.prohibited'] = '';

        return $messages;
    }

    public function withValidator($validator): void
    {
        $messages = $this->cmsMessages();

        $validator->after(function ($validator) use ($messages) {
            $loadedAt = $this->input('form_loaded_at');

            if (is_numeric($loadedAt)) {
                $delta = time() - (int) $loadedAt;

                if ($delta < 2) {
                    $validator->errors()->add(
                        'form_loaded_at',
                        $messages['form_loaded_at.too_fast'] ?? ''
                    );
                }
            }
        });
    }

    private function cmsMessages(): array
    {
        $list = GlobalSet::findByHandle('contact')?->inCurrentSite()?->get('validation_messages') ?? [];

        return collect($list)
            ->mapWithKeys(fn ($item) => [$item['key'] => $item['message']])
            ->all();
    }
}
