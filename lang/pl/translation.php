<?php

use App\Enums\Auth\RoleType;

return [
    'navigation' => [
        'rooms' => 'Pokoje',
        'users' => 'Użytkownicy',
        'categories' => 'Kategorie',
        'komponents' => 'Komponenty',
        'devices' => 'Urządzenia',
        'manufacturers' => 'Producenci',
        'orderstates' => 'Stany zamównień',
        'orders'=> 'Zamówienia',
        'commissionkomponents'=> 'Pozycje zlecenia',
        'products'=> 'Produkty',
        'commissionservices'=> 'Usługi zlecenia',
        'orderproducts'=> 'Zamówienia produktów ',
        'orderdetails'=> 'Szczegóły zamówienia ',
        'services'=>'Usługi',
        'commissions'=> 'Zlecenia',
        'others'=> 'Pozostałe'
        
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
        'save' => 'Zapisz',
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
