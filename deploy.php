<?php
namespace Deployer;

require 'recipe/laravel.php';

// setting
set('application', 'my_project');
set('host', 'qa.local');
set('repository', 'git@gitlab.local:asper/testci.git');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// set('allow_anonymous_stats', false);
// set('writable_mode', 'chmod');


// Hosts
host(get('host'))
    ->user('deployer')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '/var/www/{{application}}');

// Tasks
task('artisan:optimize', function () {
});   // @overwrite

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');
