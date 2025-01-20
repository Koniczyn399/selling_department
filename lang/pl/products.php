<?php

return [
    'attributes' => [
        'product_id' => 'id',

        'manufacturer_name' => 'Nazwa producenta',
        'manufacturer_id' => 'ID Producenta',
        'product_name' => 'Nazwa ',
        'price' => 'Cena',
        'unit' => 'Jednostka miary',
        'amount' => 'Ilość',
        'description' => 'Opis',

    ],
    'actions' => [
        'remove_product_action' => 'Usuń towar',
        'add_product_action' => 'Dodaj towar',
        'edit_product_action' => 'Zmodyfikuj towar',
        'create' => 'Dodaj towar',
        'show_product' => 'Pokaż towar',


    ],
    'labels' => [
        'create_form_title' => 'Dodawanie towaru',
        'edit_form_title' => 'Edycja towaru',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano produkt :name',
            'updated' => 'Zaktualizowano produkt :name',
            'destroyed' => 'Usunięto produkt :name',
            'restored' => 'Przywrócono produkt :name',
        ],
    ],

];
