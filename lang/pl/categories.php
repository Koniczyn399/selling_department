<?php

return [
    'attributes' => [
        'category_id' => 'ID',
        'category_name' => 'Nazwa kategorii',
    ],
    'actions' => [
        'remove_category_action' => 'Usuń kategorię',
        'add_category_action' => 'Dodaj kategorię',
        'edit_category_action' => 'Zmodyfikuj kategorię',
        'create' => 'Dodaj kategorię',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowej kategorii',
        'edit_form_title' => 'Edycja kategorii',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano kategorię :name',
            'updated' => 'Zaktualizowano kategorię :name',
            'destroyed' => 'Usunięto kategorię :name',
            'restored' => 'Przywrócono kategorię :name',
        ],
    ],

];
