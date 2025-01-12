<?php

return[
    'attributes' =>[
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

        'description'=>'Opis',
        'roles'=>'Role',
    ],
    'actions' => [
        'assign_admin_role' => 'Ustaw rolę admina',
        'remove_admin_role' => 'Odbierz rolę admina',
        'assign_worker_role' => 'Ustaw rolę pracownika',
        'remove_worker_role' => 'Odbierz rolę pracownika',
        'create' => 'Dodaj nowego klienta',
    ],

    'labels' => [
        'create_form_title' => 'Dodawanie nowego klienta',
        'edit_form_title' => 'Edycja klienta',
    ],
];