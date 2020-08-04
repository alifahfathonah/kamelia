# Kamelia

Web Organisai, Lia

## Config
Download ini dulu

Buka file ```database.php``` di ```application/config/database.php```  
__EDIT:__
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => 'root',
'database' => 'kamelia',
```
Disesuaikan dengan setting database di xampp mu, biasanya password kosongan  
Buka file ```config.php``` di ```application/config/config.php```  
__EDIT:__

```php
$config['base_url'] = 'http://kamelia.id'; 
```
```kamelia.id``` disesuaikan dengan ```http://localhost/ismi``` -> kalo nama foldernya ```ismi```

## Progress
* [x] Login Admin & Sub Admin
* [x] Admin add new user
* [x] Admin add kegiatan
* [x] Admin add jenis
* [x] Generate first admin
* [x] Datatable in subadmin
* [x] Edit kegiatan
* [x] List kegiatan
* [x] Admin edit admin profile
* [x] Admin edit user profile
* [x] User edit user profile
* [x] Subadmin add kegiatan
* [x] Subadmin edit kegiatan
* [x] Add user list view in admin
* [x] Add kegiatan list view in admin
* [x] Add calendar
* [x] Admin and subadmin do review and change status
* [x] Subadmin show owned kegiatan
* [x] Front end in calendar
* [x] Admin CRUD artikel
* [x] Artikel list and single
* [x] Artikel pagination
* [x] Artikel search
* [x] Landing page

## Issue
* ``` $config['use_page_numbers'] ``` dosen't work properly [SOLVED]
* Not really an issue, search uses session instead of query string, just option [SOLVED] -> uses query string

![Semangat!](https://i.pinimg.com/originals/7a/d2/81/7ad2818cd9713097dbdbfd20ff4b08dd.png)
