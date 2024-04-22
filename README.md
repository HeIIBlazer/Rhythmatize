<p align="center"><a href="" target="_blank"><img src="https://github.com/HeIIBlazer/Rhythmatize/blob/main/public/images/logo.png?raw=true"width="400" alt="Rhythmatize Logo"></a></p>
<hr>
<p align="center">Rhythmize is a music-centric website that serves as a hub for music enthusiasts and fans. It offers a comprehensive database of artists and their music, complete with links to various music streaming services. Visitors can access song lyrics, detailed artist information, and explore the rich world of music, all in one convenient platform.</p>
<hr>
<h1 align="center">HOW TO RUN PROJECT:</h1>

## Prerequisites

To run this project, you must have the following installed on your system:

- composer
  - [Download Composer](https://getcomposer.org/download/)
- xampp
  - [Download Xampp](https://www.apachefriends.org/download.html)

<hr>

## Steps

1. Download the zip file.
2. Extract the zip file.
3. Copy env.example file, paste it in the same place as env.example and rename it to .env.
4. Open xampp and start Apache and MySQL.
5. Open phpMyAdmin and create a database named `rhythmatize`.
6. Import the `rhythmatize.sql` file into the database.
7. Open the terminal and navigate to the project folder.
8. Run the following command to install the dependencies:
   ```bash
   composer i
   ```
9. Then run key generate command:
   ```bash
    php artisan key:generate
    ```
10. Run the following command to start the server:
    ```bash
    php artisan serve
    ```
11. Open the browser and go to `http://localhost:8000/`.
12. You can now view the website.
<hr>

## Admin & User Credentials

- Admin:
  - Email: admin@test.ee
  - Password: Admin123!

- User:
  - Email: user@test.com
  - Password: User123!

<hr>