<?php

require dirname(__FILE__) . '/vendor/autoload.php';
require dirname(__FILE__) . '/admin_user.php';


$client = new \UserAdmin\UserServiceClient(
    'localhost:50051',
    [
        'credentials' => Grpc\ChannelCredentials::createInsecure(),
    ]
);

$authorizations = [
    [
        'id' => 1,
        'slug' => 'update_contribution_pages',
        'value' => '1'
    ],
    [
        'id' => 2,
        'slug' => 'create_users',
        'value' => '1'
    ]
];

$permissions = new \UserAdmin\PermissionBlob();

$permissions->setAdminUserEmail('bmdowning@bluestatedigital.com');
$permissions->setApplication('torchlight');

foreach ($authorizations as $auth) {
    $a = new \UserAdmin\Authorization();
    $a->setId($auth['id']);
    $a->setSlug($auth['slug']);
    $a->setValue($auth['value']);
    $permissions->setAuth($a);
}

print_r($permissions);

list($reply, $status) = $client->updateUser($permissions)->wait();

echo 'Printing Reply:';
print_r($reply);

echo 'Printing Status:';
print_r($status);

