<?php

return[
    'attributes' =>[
        'clients'=>'Klient',
        'id'=> 'ID',
        'name'=>'Imię',
        'phone_number' =>'Nr telefonu',
        'last_name'=>'Nazwisko',
        'nip'=>'NIP',
        'post_code'=>'Kod pocztowy',
        'city'=>'Miasto',
        'street'=>'Ulica',
        'street_number'=>'Numer domu',

        'email'=>'Adres e-mail',
        'unit_nr'=>'Numer lokalu',
        'description'=>'Opis',
        'roles'=>'Role',
    ],
    'actions' => [
        'create' => 'Dodaj nowego klienta',
        'show_user_orders' => 'Pokaż zamówienia klienta',
        'show_user' => 'Pokaż klienta',
        'edit_user' => 'Zmodyfikuj klienta',
        'remove_user' => 'Usuń klienta',
    ],

    'labels' => [
        'create_form_title' => 'Dodawanie nowego klienta',
        'edit_form_title' => 'Edycja klienta',
    ],
    
    'messages' => [
        'successes' => [
            'stored' => 'Dodano klienta :name',
            'updated' => 'Zaktualizowano klienta :name',
            'destroyed' => 'Usunięto klienta :name',
            'restored' => 'Przywrócono klienta :name',
        ],
    ],
];