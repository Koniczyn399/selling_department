<?php

return [
    'attributes' => [
        'product_id' => 'ID',
        'category_name' => 'Nazwa kategorii',
        'manufacturer_name' => 'Nazwa producenta',
        'manufacturer_id' => 'ID Producenta',
        'product_name' => 'Nazwa produktu',
        'price' => 'Cena',
        'unit' => 'Jednostka',
        'amount' => 'Ilość',
        'description' => 'Opis',

    ],
    'actions' => [
        'remove_product_action' => 'Usuń produkt',
        'add_product_action' => 'Dodaj produkt',
        'edit_product_action' => 'Zmodyfikuj produkt',
        'create' => 'Dodaj produkt',
        'choose_category' => 'Wybierz kategorię',
        'choose_manufacturer' => 'Wybierz producenta',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowgo produktu',
        'edit_form_title' => 'Edycja produktu',
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
