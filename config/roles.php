<?php

return [
    'roles' => [
        'admin_sparepart' => [
            'label' => 'Admin Spare Part',
            'menus' => [
                'kategori_barang',
                'barang',
                'penjualan',
                'pembelian',
                'laporan_persetujuan',
            ],
        ],
        'service_manager' => [
            'label' => 'Service Manager',
            'menus' => [
                'penjualan',
                'pembelian',
                'laporan_persetujuan',
            ],
        ],
    ],
    'menu_permissions' => [
        'kategori_barang' => [
            'admin_sparepart' => ['view', 'create', 'edit', 'delete'],
        ],
        'barang' => [
            'admin_sparepart' => ['view', 'create', 'edit', 'delete'],
        ],
        'penjualan' => [
            'admin_sparepart' => ['view', 'create', 'edit', 'delete'],
            'service_manager' => ['view'],
        ],
        'pembelian' => [
            'admin_sparepart' => ['view', 'create', 'edit', 'delete'],
            'service_manager' => ['view', 'create', 'edit', 'delete'],
        ],
        'laporan_persetujuan' => [
            'admin_sparepart' => ['view'],
            'service_manager' => ['view'],
        ],
    ],
];
