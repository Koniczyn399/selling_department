<?php

return [
    'attributes' => [
        'order_product_id' => 'ID zamówienia produktu',
        'order_id' => 'ID Zamówienia',
        'product_name' => 'Nazwa produktu',
        'amount' => 'Ilość',
        'price' => 'Cena',
        'description' => 'Opis',

    ],
    'actions' => [
        'remove_orderproduct_action' => 'Usuń zamówienie produktu',
        'add_orderproduct_action' => 'Dodaj zamówienie produktu',
        'edit_orderproduct_action' => 'Zmodyfikuj zamówienie produktu',
        'create' => 'Dodaj zamówienie produktu',
        'actions' => 'Akcje',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowgo zamówienia produktu',
        'edit_form_title' => 'Edycja zamówienia produktu',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano zamówienie produktu :name',
            'updated' => 'Zaktualizowano zamówienie produktu :name',
            'destroyed' => 'Usunięto zamówienie produktu :name',
            'restored' => 'Przywrócono zamówienie produktu :name',
        ],
    ],

];
