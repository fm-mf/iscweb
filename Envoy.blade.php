@servers([ 'production' => 'deployer@isc.cvut.cz' ])

@setup
    $repository = "git@github.com:{$reponame}.git";
    $web_home = '/var/www';
    $app_dir = "{$web_home}/isc.cvut.cz";
    $releases_dir = "{$app_dir}/releases";
    $release = date('Y-m-d_H-i-s') . "_{$commit}";
    $new_release_dir = "{$releases_dir}/{$release}";
@endsetup

@story('deploy-production', ['on' => 'production'])
    clone_repository
    link_essentials
    run_composer
    run_npm
    link_other_sections
    update_symlinks
    update_cache
@endstory

@task('clone_repository')
    echo "Starting deployment ({{ $release }})"
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir -p {{ $releases_dir }}
    git clone -q -b {{ $branch }} {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('link_essentials')
    echo "Linking storage directory"
    [ -d {{ $app_dir }}/storage ] && rm -rf {{ $new_release_dir }}/storage || mv {{ $new_release_dir }}/storage {{ $app_dir }}/storage
    [ -d {{ $app_dir }}/storage/app/avatars ] || mkdir -p {{ $app_dir }}/storage/app/avatars
    [ -d {{ $app_dir }}/storage/app/events ] || mkdir -p {{ $app_dir }}/storage/app/events
    ln -sfnr {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo 'Linking .env file'
    [ -f {{ $app_dir }}/.env ] || cp {{ $new_release_dir }}/.env.example {{ $app_dir }}/.env
    ln -sfnr {{ $app_dir }}/.env {{ $new_release_dir }}/.env
@endtask

@task('run_composer')
    cd {{ $new_release_dir }}
    echo "Installing composer dependencies ..."
    composer install --no-dev --prefer-dist --no-scripts --optimize-autoloader -q
@endtask

@task('run_npm')
    echo "Installing Node dependencies ..."
    cd {{ $new_release_dir }}
    yarn install -s
    echo "Compiling JS and CSS assets ..."
    yarn production -s
    rm -rf node_modules
@endtask

@task('link_other_sections')
    ln -sr "{{ $web_home }}/blog" "{{ $new_release_dir }}/public/blog"
    ln -sr "{{ $web_home }}/blog" "{{ $new_release_dir }}/public/press"
    ln -sr "{{ $web_home }}/czechculturecourse" "{{ $new_release_dir }}/public/czechculturecourse"
    ln -sr "{{ $web_home }}/iscproisc" "{{ $new_release_dir }}/public/iscproisc"
    ln -sr "{{ $web_home }}/languages" "{{ $new_release_dir }}/public/languages"
    ln -sr "{{ $web_home }}/pw" "{{ $new_release_dir }}/public/pw"
    ln -sr "{{ $web_home }}/Tandem/www" "{{ $new_release_dir }}/public/tandem"
    ln -sr "{{ $web_home }}/wiki" "{{ $new_release_dir }}/public/wiki"
@endtask

@task('update_symlinks')
    echo 'Linking current release'
    [ -L {{ $app_dir }}/current ] && ln -sfnr $(readlink -f {{ $app_dir }}/current) {{ $app_dir }}/prev
    ln -sfnr {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('update_cache')
    cd {{ $new_release_dir }}
    php artisan config:cache || echo "Config caching failed"
    php artisan route:cache || echo "Routes caching failed"
@endtask
