<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/Aleix-ef/repasoExtraordinaria.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('4.212.15.106')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/futbol-femeni');

// Hooks

after('deploy:failed', 'deploy:unlock');
