<?php

use App\Enums\Auth\RoleType;

return [
    'navigation' => [
        'users' => 'Klienci',
        'clients' => 'Klienci',
        'employees'=> 'Pracownicy',
     
        'categories' => 'Kategorie',
        'komponents' => 'Komponenty',
        'devices' => 'Urządzenia',
        'manufacturers' => 'Producenci',
        'orderstates' => 'Stany zamównień',
        'orders'=> 'Zamówienia',
        'orders_history'=> 'Historia zamówień',

        'products'=> 'Towary',

        'orderproducts'=> 'Zamówienia towarów ',
        'orderdetails'=> 'Szczegóły zamówienia ',
        'main_page' =>'Strona główna',
        'log_in'=>'Zaloguj się',
        'register'=>'Zarejestruj się',

        'selling_department'=>'Dział Sprzedaży',
        'others'=> 'Pozostałe',
        'account' =>'Konto',
       
        
    ],
    'login'=>[

        'forgot_password'=>'Zapomniałeś hasła?',
        'password'=>'Hasło',
        'remember'=>'Zapamiętaj mnie',


    ],
    'attributes' => [
        'actions' => '',
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
        'cancel' => 'Anuluj',
        'edit' =>'Edytuj',
        'remove' => 'Usuń',
    ],
    'messages' => [
        'successes' => [
            'stored_title' => 'Utworzono',
            'updated_title' => 'Zaktualizowano',
        ],
    ],
    'relations' =>[
        
        'CategoryName'=> 'Nazwa kategorii',
    ],
    'dialogs'=>[
        'yes'=>'Tak',
        'no'=>'Nie',
    ]
    
];
