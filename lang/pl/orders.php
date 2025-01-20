<?php

return [
    'attributes' => [
        'order_id' => 'Numer',
        'client_name' => 'Klient',
        'worker_name' => 'Pracownik',
        'order_state_name' => 'Stan zamówienia',
        'date' => 'Data',
        'date_of_order' => 'Data zamówienia',
        'seller_name' => 'Sprzedawca',
        'joint_amount' =>'Kwota łączna',
        'price' => 'Cena',
        'description' => 'Opis',
        'products' =>'Produkty',
        'employee' =>'Pracownik',

    ],
    'actions' => [
        'remove_order_action' => 'Usuń zamówienie',
        'add_order_action' => 'Dodaj zamówienie',
        'edit_order_action' => 'Zmodyfikuj zamówienie',
        'show_orders_action' => 'Pokaż zamówienia',
        'show_order_detail_action' => 'Pokaż zamówienie',
        'create' => 'Dodaj zamówienie',
        'category_name' => 'Nazwa kategorii',
        'choose_client' => 'Wprowadź klienta',
        'choose_seller' => 'Wprowadź sprzedawcę',
        'choose_product' => 'Wprowadź produkt',
        'choose_order' => 'Wybierz zamówienie',

    ],
    'labels' => [
        'create_form_title' => 'Dodawanie zamówienia',
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
    'dialogs'=>[
        'products_question'=>[
            'title'=>'Zamówienia towarów',
            'description'=>'Czy chcesz dodać towary do zamówienia ?',
            'second_description'=>'Czy chcesz dodać następny towar do zamówienia ?', 
        ]
    ]

];
