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
* [ ] Subadmin add kegiatan
* [ ] Add user list view in admin
* [ ] Add kegiatan list view in admin
* [x] Add calendar
* [ ] Admin and subadmin do review

## Issue
* NAMA JENIS DI INDEX KEGIATAN BELUM TAMPIL DAN SEARCH DATATABLES BELUM JALAN
* ORDER DI LIST KEGIATAN MENYESUAIKAN DATATABLES

![Semangat!](https://i.pinimg.com/originals/7a/d2/81/7ad2818cd9713097dbdbfd20ff4b08dd.png)
