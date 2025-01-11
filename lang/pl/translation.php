<?php

use App\Enums\Auth\RoleType;

return [
    'navigation' => [
        'users' => 'Klienci',
        'clients' => 'Klienci',
        'categories' => 'Kategorie',
        'komponents' => 'Komponenty',
        'devices' => 'Urządzenia',
        'manufacturers' => 'Producenci',
        'orderstates' => 'Stany zamównień',
        'orders'=> 'Zamówienia',

        'products'=> 'Towary',

        'orderproducts'=> 'Zamówienia produktów ',
        'orderdetails'=> 'Szczegóły zamówienia ',


        'others'=> 'Pozostałe',
        
        'account' =>'Konto'
        
    ],
    'attributes' => [
        'actions' => 'Akcje',
        'created_at' => 'Utworzono',
        'updated_at' => 'Zaktualizowano',
        'deleted_at' => 'Usunięto',
    ],
    'roles' => [
        RoleType::USER->value => 'Użytkownik',
        RoleType::WORKER->value => 'Pracownik',
        RoleType::ADMIN->value => 'Administrator',
    ],
    'placeholder' => [
        'enter' => 'Wprowadź',
        'select' => 'Wybierz',
        'save' => 'Zatwierdź',
        'cancel' => 'Anuluj'
    ],
    'messages' => [
        'successes' => [
            'stored_title' => 'Utworzono',
            'updated_title' => 'Zaktualizowano',
        ],
    ],
    'relations' =>[
        
        'CategoryName'=> 'Nazwa kategorii',
    ]
];
