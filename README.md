# MeetAp Qr Scan Back End

Meet App Qr Scan back end digunakan sebagai back end untuk materi mentoring meet Ap Qr Scan

# Cara menginstall

Clone project ini dari github

```
git clone https://github.com/MeetAp-Mobile-Developer/BE-Course1-Qrscan.git
```

Masuk ke directory Project

```
cd BE-Course1-Qrscan
```

copy file .env.example dan ubah nama file menjadi .env

buat database di localhost menggunakan database MariaDB dengan Nama database 'course_1_qrcode'

install dependency yang dibuatuhkan

```
composer install
```

Migrasi databse

```
php artisan migrate
```

Feed database

```
php artisan db:seed
```

Jalankan local server

```
php artisan serve
```

buka url
[localhost:8000](localhost:8000)

untuk melakukan registrasi participant buka url
[localhost:8000/participant/register](localhost:8000/participant/register)

## Contoh Request dan response

> login. POST. [localhost:8000/api/login](localhost:8000/api/login).

> Request

```
{
    "username": "",
    "password": ""
}
```

> Response

```
{
    "msg": "ok",
    "id": ,
    "nama": "",
    "token": ""
}
```

> logout. POST. [localhost:8000/api/logout](localhost:8000/api/logout).

```
{
    "message": "Logout berhasil"
}
```

> List scan. GET. [localhost:8000/api/list_scan](localhost:8000/api/list_scan).

> Response

```
[
    {
        "id_scan": 1,
        "title": "Simposium",
        "created_at": null,
        "updated_at": null
    },
    {
        "id_scan": 2,
        "title": "Workshop 1",
        "created_at": null,
        "updated_at": null
    }
]
```

> scan. POST. [localhost:8000/api/scan](localhost:8000/api/scan).

> Request

```
{
    "id_scan": "",
    "qr_content": ""
}
```

> Response

```
{
    "status": "success",
    "message": "Simposium - meetap-1726303343 Success"
}
```

> Report. POST. [localhost:8000/api/report](localhost:8000/api/report).

> Request

```

```

> Response

```

```
