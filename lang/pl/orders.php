<?php

return [
    'attributes' => [
        'order_id' => 'ID',
        'client_name' => 'Klient',
        'worker_name' => 'Pracownik',
        'order_state_name' => 'Stan zamówienia',
        'deadline_of_completion' => 'Termin realizacji',
        'date_of_completion' => 'Data realizacji',
        'price' => 'Cena',
        'description' => 'Opis',

    ],
    'actions' => [
        'remove_order_action' => 'Usuń zamówienie',
        'add_order_action' => 'Dodaj zamówienie',
        'edit_order_action' => 'Zmodyfikuj zamówienie',
        'show_orders_action' => 'Pokaż zamówienia',
        'show_order_detail_action' => 'Pokaż zamówienie',
        'create' => 'Dodaj zamówienie',
        'category_name' => 'Nazwa kategorii',
        'choose_client' => 'Wybierz klienta',
        'choose_worker' => 'Wybierz pracownika',
        'choose_order_state' => 'Wybierz stan',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego zamówienia',
        'edit_form_title' => 'Edycja zamówienia',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano zamówienie :name',
            'updated' => 'Zaktualizowano zamówienie :name',
            'destroyed' => 'Usunięto zamówienie :name',
            'restored' => 'Przywrócono zamówienie :name',
        ],
    ],

];
