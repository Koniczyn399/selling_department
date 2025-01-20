<?php

return [
    'attributes' => [
        'order_product_id' => 'ID zamówienia towaru',
        'order_id' => 'ID Zamówienia',
        'product_name' => 'Nazwa towaru',
        'amount' => 'Ilość',
        'price' => 'Cena',
        'description' => 'Opis',

    ],
    'actions' => [
        'remove_orderproduct_action' => 'Usuń zamówienie towaru',
        'add_orderproduct_action' => 'Dodaj zamówienie towaru',
        'edit_orderproduct_action' => 'Zmodyfikuj zamówienie towaru',
        'create' => 'Dodaj zamówienie towaru',
        'actions' => 'Akcje',
        'choose_product'=>'Wybierz towar',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowgo zamówienia towaru',
        'edit_form_title' => 'Edycja zamówienia towaru',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano zamówienie towaru :name',
            'updated' => 'Zaktualizowano zamówienie towaru :name',
            'destroyed' => 'Usunięto zamówienie towaru :name',
            'restored' => 'Przywrócono zamówienie towaru :name',
        ],
    ],

];
