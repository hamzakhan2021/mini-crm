<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Image; // Use the Intervention Image facade

class ImageMinDimensions implements ValidationRule
{
    protected $minWidth;
    protected $minHeight;

    public function __construct($minWidth, $minHeight)
    {
        $this->minWidth = $minWidth;
        $this->minHeight = $minHeight;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (is_string($value) && File::exists($value)) {
            $image = Image::make($value);
            if ($image->width() >= $this->minWidth && $image->height() >= $this->minHeight) {
                return true;
            }
        }

        $fail("The $attribute must have a minimum size of {$this->minWidth}x{$this->minHeight} pixels.");
        return false;
    }
}
