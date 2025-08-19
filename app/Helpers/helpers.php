<?php

if (!function_exists('units')) {
    function units()
    {
        return [
            'pcs' => 'Pieces',
            'kg' => 'Kilograms',
            'ltr' => 'Liters',
            'box' => 'Boxes',
            'set' => 'Sets',
            'dozen' => 'Dozens',
            'roll' => 'Rolls',
            'pack' => 'Packs',
        ];
    }

    if (!function_exists('brands')) {
        function brands()
        {
            return [
                'Indomie' => 'Indomie',
                'Coca-Cola' => 'Coca-Cola',
                'Peak' => 'Peak',
                'Golden Penny' => 'Golden Penny',
                'Nestle' => 'Nestle',
            ];
        }
    }
}
