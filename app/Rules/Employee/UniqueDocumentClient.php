<?php

namespace App\Rules\Employee;

use Closure;
use App\Models\Employee;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueDocumentClient implements ValidationRule
{

    private $clientId;
    private $id;

    public function __construct($clientId, $id = 0)
    {
        $this->id = $id;
        $this->clientId = $clientId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $employeeNameExist = Employee::where('id', '!=', $this->id)
            ->where('document', $value)
            ->where('clientId', $this->clientId)
            ->exists();

        if ($employeeNameExist) {
            $fail('The :attribute is already in use within this client.');
        }
    }
}
