<?php

return
    [
        'OPCOES_MENU_Aprovador' => [
            [
                'label' => 'Pedidos',
                'color' => 'yellow',
                'url' => '/pedidos',
                'icon' => 'fas fa-sticky-note'
            ],
            [
                'label' => 'Grupos',
                'color' => 'green',
                'url' => '/grupos',
                'icon' => 'fas fa-users'
            ],
            [
                'label' => 'Usuários',
                'color' => 'blue',
                'url' => '/usuarios',
                'icon' => 'fas fa-user'
            ],

        ],

        'OPCOES_MENU_Solicitante' => [
            [
                'label' => 'Pedidos',
                'color' => 'yellow',
                'url' => '/pedidos',
                'icon' => 'fas fa-sticky-note'
            ],



        ],

        'TIPOS_STATUS_PEDIDOS' => [
            'novo' => 'Novo',
            'revisao' => 'Em Revisão',
            'alteracoes' => 'Alterações Solicitadas',
            'aprovado' =>  "Aprovado",
            'rejeitado' => "Rejeitado",
        ],
        'PERFIS' => [
            'solicitante' => 'Solicitante',
            'aprovador' => 'Aprovador',
        ],


    ];
