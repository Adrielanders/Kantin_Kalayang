Satu Kalayang Backend
Cara Install API laravel 11.x
composer create-project laravel/laravel example-app
ganti env.
buat database sesuai dengan keinginan di mysql atau database lainnya
jika nama folder pada laravel masih app dapat di rename menjadi App
membuat model dengan cmd php artisan make:model example-model
membuat controller dengan cmd php artisan make:controller example-controller
jika API laravel pada routes sudah tersedia maka dapat langsung memanggil controller yang terlah di buat namun jika belum ada dapat menulis cmd php artisan install:api
