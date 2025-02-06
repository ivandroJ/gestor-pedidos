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

        'NOTIFICATION_CARDS_CONFIG' => [
        'error_msg' => [
            'color' => 'red',
            'text-color' => 'white',
            'icon' => 'exclamation-circle',
        ],
        'warning_msg' => [
            'color' => 'yellow',
            'text-color' => 'white',
            'icon' => 'exclamation-triangle',
        ],
        'info_msg' => [
            'color' => 'blue',
            'text-color' => 'white',
            'icon' => 'info-circle',
        ],
        'sucess_msg' => [
            'color' => 'green',
            'text-color' => 'white',
            'icon' => 'check-circle',
        ],
    ]

    ];
