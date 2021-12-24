<h1>Laravue</h1>
<ol>
<li>composer create-project laravel/laravel project-name</li>
<li>create models diagram</li>
<li>create repository on github</li>
<li>git init</li>
<li>git add .</li>
<li>git commit -m "Init"</li>
<li>git remote add origin https://github.com/dev4rweb/laravue.git</li>
<li>git push -u origin master</li>
<li>in .env create field DB_TABLE_PREFIX=lara_</li>
<li>config/database.php change field 'prefix' => env('DB_PREFIX', 'abc')</li>
<li>php artisan config:clear</li>
<li>php artisan make:model Desk -mf</li>
<li>php artisan make:model DeskList -mf</li>
<li>php artisan make:model Card -mf</li>
<li>php artisan make:model Task -mf</li>
<li>fill migration fields</li>
<li>php artisan migrate</li>
<li>create faker data</li>
<li>create seeders</li>
<li>php artisan migrate:refresh --seed</li>
<li>php artisan make:controller Api/DeskController -r --api</li>
<li>php artisan make:resource DeskResource</li>
<li>create relations</li>
<li>php artisan make:request DeskRequest</li>
<li>php artisan make:controller SpaController</li>
<li>https://github.com/laravel/ui</li>
<li>composer require laravel/ui</li>
<li>php artisan ui vue --auth</li>
<li>run npm install</li>
<li>npm update vue-loader</li>
<li>npm ci && npm run dev</li>
<li>npm i vue-router</li>
</ol>
