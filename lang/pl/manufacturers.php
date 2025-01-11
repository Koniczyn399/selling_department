<?php

return [
    'attributes' => [
        'manufacturer_id' => 'ID',
        'manufacturer_name' => 'Nazwa producenta',
    ],
    'actions' => [
        'remove_manufacturer_action' => 'Usuń producenta',
        'add_manufacturer_action' => 'Dodaj producenta',
        'edit_manufacturer_action' => 'Zmodyfikuj producenta',
        'create' => 'Dodaj producenta',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego producenta',
        'edit_form_title' => 'Edycja producenta',
    ],
    'messages' => [
        'successes' => [
            'stored' => 'Dodano producenta :name',
            'updated' => 'Zaktualizowano producenta :name',
            'destroyed' => 'Usunięto producenta :name',
            'restored' => 'Przywrócono producenta :name',
        ],
    ],

];
