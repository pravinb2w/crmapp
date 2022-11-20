<?php
// $payFromMethod = planSettings('payment_gateway');
// $dynamic_gateways = [];
// if( isset( $payFromMethod ) && !empty( $payFromMethod ) ) {
//     $payFrom = explode( ',', $payFromMethod );
//     if( !empty( $payFrom ) ) {
//         foreach ($payFrom as $item) {
//             if( $item == 'payu') {
//                 $field = 'payumoney';
//                 $value = 'PayUmoney';
//             } else if($item == 'ccavenue') {
//                 $field = 'ccavenue';
//                 $value = 'CCAvenue';
//             } else if($item == 'razorpay') {
//                 $field = 'razorpay';
//                 $value = 'Razor Pay';
//             }
//             $dynamic_gateways[$field] = $value;
//         }
//     }
// } else {
$dynamic_gateways = [
                        'razorpay' => 'Razor Pay',
                        'ccavenue' => 'CCAvenue',
                        'payumoney' => 'PayUmoney'
                    ];


$dynamic_tasks = '';

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
        'global_configuration',
        'tasks',
        'products',
        'pages',
        'customers',
        'customer_document_approval',
        'document_types',
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
        'newsletter',
        'settings'
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
    'payment_gateway' => $dynamic_gateways,
    'workflow_type' => [
        'New Customer Addition',
        'New Lead Addition',
        'New Deal Addition',
        'New Organization Addition',
        'Activity on all Leads',
        'Activity on all Deals',
        'Conversion from Lead to Deal',
        'Deal stage changed',
        'Invoice Creation',
        'Deal won/lose',
        'Payment Remainder',
        'Thanks mail for the payment received',
    ],
    'email_type' => [
        'otp_login',
        'new_registration',
        'new_lead',
        'fresh_lead_internal',
        'forgot_password',
        'deal_conversion',
        'deal_conversion_internal',
        'stage_completed',
        'invoice_creation',
        'invoice_creation_internal',
        'deal_won/loss',
        'success_payment',
        'cancel_payment',
        'payment_url',
        'payment_remainder',
        'general_task',
    ],
];