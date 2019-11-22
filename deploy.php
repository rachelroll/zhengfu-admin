<?php

namespace Deployer;

require 'recipe/laravel.php';

set('application', 'zhengfu-admin');

set('bin/php', function () {
    return '/usr/bin/php';
});

set('bin/composer', function () {
    if (commandExist('composer')) {
        $composer = locateBinaryPath('composer');
    }
    if (empty($composer)) {
        run("cd {{release_path}} && curl -sS https://getcomposer.org/installer | {{bin/php}}");
        $composer = '{{release_path}}/composer.phar';
    }

    return '{{bin/php}} ' . $composer;
});

// Project repository
set('repository', 'git@gitee.com:hello-trump/zhengfu-admin.git');

set('composer_options',
    '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --no-dev --optimize-autoloader --ignore-platform-reqs');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', TRUE);
//set('writable_mode', 'chmod');
//set('writable_chmod_mode', '0775');

set('keep_releases', 3);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('prod')->hostname('219.157.119.107')->port(8222)->user('gonglianwangluo')->set('deploy_path', '/var/www/{{application}}')->stage('staging');

// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new-front release.

before('deploy:symlink', 'artisan:migrate');



/**
 * Main task
 */
desc('Deploy your project');

task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'artisan:optimize:clear',
    //'env:upload',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);

//task('deploy:upload', function () {
//    upload('build/', '{{release_path}}/public');
//});

desc('Upload .env file');
task('env:upload', function () {
    upload('.env.prod', '{{release_path}}/.env');
});

task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php7.3-fpm restart');
});

task('restart:supervisorctl', function () {
    //run('supervisorctl restart all');
});

desc('Composer dump autoload');
task('composer:dump:autoload', function () {
    run('cd {{release_path}} &&  composer dump-autoload');
});

task('build', [
    //'composer:dump:autoload',
    //'bower:install',
    //'npm:install',
    //'npm:run:production',
    'reload:php-fpm',
]);

after('deploy', 'build');
after('deploy', 'success');


