<?php 


return [
	'role_menu' => [
        'account',
        'dashboard',
        'notes',
        'activities',
        'leads',
        'leadsource',
        'leadstage',
        'dealstages',
        'deals',
        'tasks',
        'products',
        'pages',
        'customers',
        'users',
        'invoices',
        'payments',
        'activity_log',
        'database_backup',
        'email_template',
        'reports',
        'master_data',
        'bulk_import',
        'organizations',
    ],
    'payment_method' => [
        'cash',
        'card',
        'cheque',
        'imps',
        'neft',
        'rtgs',
        'upi'
    ],
    'payment_status' => [
        'pending',
        'paid',
        'failed'
    ],
    'payment_gateway' => [
        'razorpay' => 'Razor Pay',
        'ccavenue' => 'CCAvenue',
        'payumoney' => 'PayUmoney',
        'paybiz' => 'PayBiz',
        'citrus' => 'Citrus'
    ]
];