php artisan vendor:publish

change table in vendor directory:
vendor/laravel/framework/src/Illuminate/Notifications/DatabaseNotification.php
protected $table = 'member_notifications';
