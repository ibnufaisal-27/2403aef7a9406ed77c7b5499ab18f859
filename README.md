## About Application

Aplikasi ini dibuat dengan menggunakan Framework Laravel, yang digunakan untuk mengirimkan email. Beberapa requirement yang ada di applikasi ini :
- Menggunakan authentikasi untuk mengkases API send email.Must be authenticated or authorized to use the API.
- Menggunakan queue / worker untuk mengirimkan email.
- Mengguakan CRUD user untuk manajemen user.

## How to use
- Clone repo https://github.com/ibnufaisal-27/2403aef7a9406ed77c7b5499ab18f859.git
- Copy environment dari ```.env.example``` dengan menggunakan perintah ```cp .env.example .env```
- Sesuaikan beberapa configan untuk koneksi database.
  ```
  DB_CONNECTION=pgsql
  DB_HOST=db
  DB_PORT=5432
  DB_DATABASE=ibnu-app
  DB_USERNAME=
  DB_PASSWORD=
  ```
  Note : pada bagian ```db_host``` isikan dengan nama container yang ada pada file ```docker-compose.yml```
- Tambahkan key dan value ```QUEUE_CONNECTION=database``` pada file ```.env``` untuk koneksi queue
- Jalankan container database , dengan menggunakan perintah ```docker compose up -d db```
- Build applikasi ke dalam docker dengan menggunakan perintah ```docker compose build```
- Jalankan aplikasi dengan menggunakan perintah ```docker compose up```
- Jalankan migrasi table dengan menggunakan perintah ```docker exec -d [nama container] php artisan migrate``` .
  Contoh : ```docker exec -d ibnuapp php artisan migrate```
- Inisiasi oauth client dengan menjalankan perintah ```docker exec -d [nama container] php artisan passport:client --personal``` 
  Contoh : ```docker exec -d ibnuapp php artisan passport:client --personal```
- Jalankan worker dengan perintah ```docker exec -d [nama container] php artisan queue:work```
  Contoh : ```docker exec -d ibnuapp php artisan queue:work```


## Penggunaan Aplikasi
sebelum menggunakan applikasi, harus terdaftar sebagai user dan login untuk mendapatkan token dari oauth , agar bisa menggunakan API send email.

### 1. Register User
URL : [base_url]/api/register
Method : POST
Body Payload :
```
{
 "email" : "mibnufaisal2@gmail.com",
 "name" : "Ibnu",
 "password" : "bismillah"
}
```
<img src="https://i.ibb.co/z518Nnc/Screenshot-from-2023-12-26-07-56-45.png" alt="register-user">

### 2. Login User
URL : [base_url]/api/user/login
Method : POST
Body Payload :
```
{
 "email" : "mibnufaisal2@gmail.com",
 "password" : "bismillah"
}
```
<img src="https://i.ibb.co/gJLkg5d/Screenshot-from-2023-12-26-08-19-12.png" alt="login-user">

### 3. API Send Email
URL : [base_url]/api/send-email
Method : POST
Authorization : Bearer Token
Body Payload :
```
{
    "email": "mibnufaisal@mailinator.com",
    "subject": "Hallo",
    "body": "Hallo !"
}
```
Header:
<img src="https://i.ibb.co/4KVqHyT/Screenshot-from-2023-12-26-08-23-11.png" alt="header-send-email">

Success Send Email:
<img src="https://i.ibb.co/pfNVYxS/Screenshot-from-2023-12-26-08-26-38.png" alt="send-email">
<img src="https://i.ibb.co/ftsYH9f/Screenshot-from-2023-12-26-09-41-32.png" alt="send-email-success">

## Error Handling
### 1. Send Email Without Auth
Send email without auth, will get 401 Unauthorization respond
<img src="https://i.ibb.co/jvtMVDd/Screenshot-from-2023-12-26-08-38-50.png" alt="send-email">