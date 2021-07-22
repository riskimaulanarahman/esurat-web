<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
  'menu' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Dashboard',
            'url' => '/',
            'route-name' => 'admin.index'
        ],
        // [
        //     'icon' => 'fa fa-hdd',
        //     'title' => 'Data Absensi',
        //     'url' => '/data-absensi',
        //     'route-name' => 'admin.report'
        // ],
        // ,[
        //     'icon' => 'fa fa-users',
        //     'title' => 'Kelola User',
        //     'url' => '/master-user',
        //     'route-name' => 'admin.masteruser'
        // ],
        [
            'icon' => 'fa fa-hdd',
            'title' => 'Kelola Surat',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/surat-masuk',
                    'title' => 'Surat Masuk',
                    'route-name' => 'admin.suratmasuk'
                ],[
                    'url' => '/surat-keluar',
                    'title' => 'Surat Keluar',
                    'route-name' => 'admin.suratkeluar'
                ]]
                ],
        [
            'icon' => 'fa fa-hdd',
            'title' => 'Kelola User',
            'url' => 'javascript:;',
            'caret' => true,
            'sub_menu' => [
                [
                    'title' => 'Data User',
                    'url' => '/master-user',
                    'route-name' => 'admin.masteruser'
                ],[
                    'url' => '/master-karyawan',
                    'title' => 'Data Karyawan',
                    'route-name' => 'admin.masterkaryawan'
                ],
                [
                    'url' => '/master-jabatan',
                    'title' => 'Master Jabatan',
                    'route-name' => 'admin.masterjabatan'
                ]
            ]
        ]
        // ,[
        //     'icon' => 'fa fa-file',
        //     'title' => 'Generate Absensi',
        //     'url' => '/generate-qr',
        //     'route-name' => 'admin.generateqr'

        // ],
        
    ]
];
