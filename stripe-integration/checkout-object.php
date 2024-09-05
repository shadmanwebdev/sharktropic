<?php

$data = [
    "id" => "cs_test_a1BgGubfmUyPXiu18pQkxWyCdFI3pbwYWMJXFkMGAtfCK9lB34iPdSWK6E",
    "object" => "checkout.session",
    "after_expiration" => NULL,
    "allow_promotion_codes" => NULL,
    "amount_subtotal" => 1000,
    "amount_total" => 1000,
    "automatic_tax" => [
        "enabled" => false,
        "liability" => NULL,
        "status" => NULL,
    ],
    "billing_address_collection" => NULL,
    "cancel_url" => "http://localhost/smartlyclean/stripe-integration/cancel.php",
    "client_reference_id" => NULL,
    "client_secret" => NULL,
    "consent" => NULL,
    "consent_collection" => NULL,
    "created" => 1708572449,
    "currency" => "usd",
    "currency_conversion" => NULL,
    "custom_fields" => [],
    "custom_text" => [
        "after_submit" => NULL,
        "shipping_address" => NULL,
        "submit" => NULL,
        "terms_of_service_acceptance" => NULL,
    ],
    "customer" => NULL,
    "customer_creation" => "if_required",
    "customer_details" => [
        "address" => [
            "city" => NULL,
            "country" => "BD",
            "line1" => NULL,
            "line2" => NULL,
            "postal_code" => NULL,
            "state" => NULL,
        ],
        "email" => "synotype@gmail.com",
        "name" => "ss",
        "phone" => NULL,
        "tax_exempt" => "none",
        "tax_ids" => [],
    ],
    "customer_email" => NULL,
    "expires_at" => 1708658849,
    "invoice" => NULL,
    "invoice_creation" => [
        "enabled" => false,
        "invoice_data" => [
            "account_tax_ids" => NULL,
            "custom_fields" => NULL,
            "description" => NULL,
            "footer" => NULL,
            "issuer" => NULL,
            "metadata" => [
            ],
            "rendering_options" => NULL,
        ],
    ],
    "livemode" => false,
    "locale" => NULL,
    "metadata" => [
    ],
    "mode" => "payment",
    "payment_intent" => "pi_3OmSx3H4rZ2esk0g1QbWqDzF",
    "payment_link" => NULL,
    "payment_method_collection" => "if_required",
    "payment_method_configuration_details" => [
        "id" => "pmc_1MvI0KH4rZ2esk0gXOQkMB5A",
        "parent" => NULL,
    ],
    "payment_method_options" => [],
    "payment_method_types" => ["card", "link", "cashapp"],
    "payment_status" => "paid",
    "phone_number_collection" => [
        "enabled" => false,
    ],
    "recovered_from" => NULL,
    "setup_intent" => NULL,
    "shipping_address_collection" => NULL,
    "shipping_cost" => NULL,
    "shipping_details" => NULL,
    "shipping_options" => [],
    "status" => "complete",
    "submit_type" => NULL,
    "subscription" => NULL,
    "success_url" => "http://localhost/smartlyclean/stripe-integration/success.php?session_id={CHECKOUT_SESSION_ID}",
    "total_details" => [
        "amount_discount" => 0,
        "amount_shipping" => 0,
        "amount_tax" => 0,
    ],
    "ui_mode" => "hosted",
    "url" => NULL,
];






?>