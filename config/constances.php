<?php

return [

    /**
     * User types in the system
     * -----------------------------------------------------------------------------------------------------------------
     */
    'user_types' => [
        'PATIENT' => 1,
        'DOCTOR' => 2,
        'PHARMACY' => 3,
        'LAB' => 4,
        'NURSE' => 5
    ],
    'patient_categories' =>[
        'Heart Patient' =>1,
        'Diabetic Patient' =>2,
        'General' =>3
    ],
    'patient_categories_inverse' =>[
        '1' => 'Heart Patient',
        '2' => 'Diabetic Patient',
        '3' => 'General'
    ]
];
