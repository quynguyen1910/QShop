<?php

namespace App\Helpers;

class ParseVND {
    public static function formatCurrency($number) {
        return number_format($number, 0, ',', '.') . ' ₫';
    }
}
