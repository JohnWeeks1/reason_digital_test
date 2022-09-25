## Setup

1. Clone project to computer. 

2. Copy .env.example to just .env and add your database details. 
NOTE: At the bottom of the .env file are the weather api keys, so you don't have to create them.

3. Create a database with the same name as you chose in your .env. Then migrate the tables.

```
php artisan migrate
```

4. Serve the site with this command:

```
php artisan serve
```

![Screenshot 2022-09-25 at 13 03 41](https://user-images.githubusercontent.com/17055567/192130614-8eda4268-6e41-462f-802a-0c89e4dbc3ef.png)

