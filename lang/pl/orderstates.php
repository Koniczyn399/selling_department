<?php

return [
    'attributes' => [
        'order_state_id' => 'ID',
        'order_state_name' => 'Nazwa stanu',
    ],
    'actions' => [
        'remove_order_state_action' => 'Usuń stan',
        'add_order_state_action' => 'Dodaj stan',
        'edit_order_state_action' => 'Zmodyfikuj stan',
        'create' => 'Dodaj stan',

    ],
    'labels' => [
        'create_form_title' => 'Tworzenie nowego stanu',
        'edit_form_title' => 'Edycja stanu',
    ],

    'messages' => [
        'successes' => [
            'stored' => 'Dodano stan :name',
            'updated' => 'Zaktualizowano stan :name',
            'destroyed' => 'Usunięto stan :name',
            'restored' => 'Przywrócono stan :name',
        ],
    ],

];
