<?php

namespace App\Http\Requests\Project;

use App\Models\Attribute;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' =>  isset($this->project->id) ? 'sometimes' : 'required' .'|string|max:255',
            'status' => isset($this->project->id) ? 'sometimes' : 'required' .'|in:' . implode(',', array_keys(config('enums.project_status'))),
            'attributes' => isset($this->project->id) ? 'sometimes' : 'required' . '|array',
            'attributes.*.attribute_id' => [
                'required',
                'exists:attributes,id',
            ],
            'attributes.*.value' => [
                'required',
                function ($attribute, $value, $fail) {
                    $attributeId = $this->input(str_replace('.value', '.attribute_id', $attribute));

                    $attributeModel = Attribute::find($attributeId);
                    if (!$attributeModel) {
                        $fail("Attribute with ID  {$attributeId} does not exist.");
                        return;
                    }

                    // we validate the value based on the attribute type (text, date, number, select)
                    switch ($attributeModel->type) {
                        case 'text':
                            if (!is_string($value)) {
                                $fail("Attribute {$attributeModel->name} must be a string.");
                            }
                            break;
                        case 'date':
                            $dateFormat = 'Y-m-d';
                            $parsedDate = \DateTime::createFromFormat($dateFormat, $value);

                            if (!$parsedDate || $parsedDate->format($dateFormat) !== $value) {
                                $fail("Attribute {$attributeModel->name} must be a valid date format: {$dateFormat}.");
                            }
                            break;
                        case 'number':
                            if (!is_numeric($value)) {
                                $fail("Attribute {$attributeModel->name} must be a number.");
                            }
                            break;
                        case 'select':
                            $select_options = json_decode($value, true);

                            if (!is_array($select_options) || !array_is_list($select_options)) {
                                $fail("Attribute {$attributeModel->name} must be a valid JSON array of options.". implode(', ', array_keys($select_options)));
                            }
                            break;
                        default:
                            $fail("Unspported attribute type: {$attributeModel->type}");
                    }
                },
            ],
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            foreach ($rules as $key => $rule) {
                if (is_array($rule) && in_array('required', $rule)) {
                    $rules[$key] = array_diff($rule, ['required']);
                }
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Project name is required.',
            'status.required' => 'Project status is required.',
            'status.in' => 'Project status must be one of the allowed values ' . implode(', ', array_keys(config('enums.project_status'))),
            'attributes.required' => 'Attributes array is required.',
            'attributes.*.attribute_id.required' => 'Attribute ID is required for each attribute.',
            'attributes.*.attribute_id.exists' => 'Attribute with ID :input does not exist.',
            'attributes.*.value.required' => 'Value for attribute with ID :attribute_id is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
               'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
