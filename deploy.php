<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project
set('project_name', getenv('CI_PROJECT_NAME'));
set('repository', getenv('CI_REPOSITORY_URL'));

// host
set('deploy_path', getenv('DEPLOY_PATH'));
set('deploy_host', getenv('DEPLOY_SERVER'));

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// set('allow_anonymous_stats', false);
// set('writable_mode', 'chmod');


// Hosts
host(get('deploy_host'))
    ->user('deployer')
    ->addSshOption('StrictHostKeyChecking', 'no')
    ->set('deploy_path', '/var/www/{{project_name}}');

// Tasks
task('artisan:optimize', function () {
});   // @overwrite

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');
