<?php

namespace App\Rules;

use App\Models\Area;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CityHasAreas implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Area::query()->where("city_id", $value)->exists()){
            $fail( 'The selected city does not have any areas.');
        }
    }
}
