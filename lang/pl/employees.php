<?php

return[
    'attributes' =>[
        'id'=> 'ID',
        'name'=>'Imię',
        'last_name'=>'Nazwisko',
  
        'nip'=>'NIP',
        'post_code'=>'Kod pocztowy',
        'city'=>'Miasto',
        'street'=>'Ulica',
        'street_number'=>'Numer domu',

        'email'=>'Adres e-mail',

        'position'=>'Stanowisko',
        'roles'=>'Role',
    ],
    'actions' => [

        'create' => 'Dodaj nowego pracownika',
    ],

    'labels' => [
        'create_form_title' => 'Dodawanie nowego pracownika',
        'edit_form_title' => 'Edycja pracownika',
    ],

    'messages' => [
        'successes' => [
            'stored' => 'Dodano pracownika :name',
            'updated' => 'Zaktualizowano pracownika :name',
            'destroyed' => 'Usunięto pracownika :name',
            'restored' => 'Przywrócono pracownika :name',
        ],
    ],
];