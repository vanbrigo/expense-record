<div align=center>

# Xpenses Api 📊

 Este es la api de un sistema de registro y control de gastos personales. Este proyecto se realizó como trabajo final del Bootcamp Full Stack Developer de [![GeeksHubs Academy](https://img.shields.io/badge/GeeksHubs_Academy-%23F40D12?style=for-the-badge&color=%23F40D12)](https://geekshubsacademy.com/)


## Tecnologias Utilizadas
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/manual/es/intro-whatis.php)[![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)[![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)[![Stack Overflow](https://img.shields.io/badge/-Stackoverflow-FE7A16?style=for-the-badge&logo=stack-overflow&logoColor=white)](https://stackoverflow.com/)[![Visual Studio Code](https://img.shields.io/badge/Visual%20Studio%20Code-0078d7.svg?style=for-the-badge&logo=visual-studio-code&logoColor=white)](https://code.visualstudio.com/)[![Git](https://img.shields.io/badge/git-%23F05033.svg?style=for-the-badge&logo=git&logoColor=white)](https://git-scm.com/)[![GitHub](https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white)](https://github.com/)[![ThunderClient](https://img.shields.io/badge/Thunder_Client-%237A1FA2?style=for-the-badge)](https://www.thunderclient.com/)
</div>

## Tabla de Contenidos
- 🧾[Diseño BBDD](#diseño-bbdd)
- ⚙️[Instalacion en local](#einstalacion-en-local)
- 🎯[Endpoints](#endpoints)
- 🛠️[Posibles Mejoras](#posibles-mejoras)
- 💻[Contacto](#contacto)
- 🪪[Creditos](#creditos)

## Diseño BBDD
![Diseño BBDD](./public/database.png)

## Instalacion en local

1. Clonar el repositorio con el comando`$ git clone [URL del repositorio]`
2. Instalar dependencias con el comando` $ composer install `
3. Conectamos nuestro repositorio con nuestra base de datos, en el archivo ".env.example" tenemos un ejemplo, copiamos el archivo y quitamos el ".example" y el archivo deberia quedar ".env", sustituimos valores con las credenciales de nuestra base de datos. 
 ```
DB_CONNECTION=mysql
DB_HOST="database host"
DB_PORT="database port"
DB_DATABASE="database name"
DB_USERNAME="username"
DB_PASSWORD="database password"
```

4. Ejecutamos las migraciones con el comando`$ php artisan migrate`
5. Ejecutamos el comando`$ php artisan db:seed` para los seeders
6. Levantamos el servidor con `$ php artisan serve`

## Endpoints
<details>
<summary> Endpoints </summary>

- REGISTER
        POST http://localhost:8000/api/register
        body:
            {
                "name":"vanessa",
                "email":"vanessa@gmail.com",
                "password": "123456",
            }

- LOGIN
        POST http://localhost:8000/api/login
        body:
            {
                "email":"vanessa@gmail.com",
                "password": "123456",
            }

-  GET PROFILE
        GET http://localhost:8000/api/profile
        
- ADD EXPENSE
        POST http://localhost:8000/api/new-expense
        body:
            {
                "amount":110,
                "category_id":2,
                "description":"renta",
                "date":"2023-12-03",
                "pay_method_id":1
            }

- ADD INCOME
        POST http://localhost:8000/api/new-income
        body:
            {
                "amount":1100,
                "category_id":10,
                "description":"salary",
                "date":"2023-12-03"
            }

- EDIT NICKNAME
        PUT http://localhost:8000/api/edit-nickname
        body:
            {
                "nickname":"vane99",
            }

- CHANGE AVATAR
        PUT http://localhost:8000/api/edit-avatar
        body:
            {
                "avatar_url":"https://img.icons8.com/external-outline-icons-mangsaabguru-/100/1A1A1A/external-african-avatar-outline-outline-icons-mangsaabguru--2.png"
            }

- GET ALL EXPENSES BY DATE
        GET http://localhost:8000/api/expenses?month={}&year={}
        
- GET ALL INCOMES BY DATE
        GET http://localhost:8000/api/incomes?month={}&year={}

- GET BALANCE BY DATE (MONTHLY)
        GET http://localhost:8000/api/balance-date?month={}&year={}
        
- DELETE EXPENSE
        DELETE http://localhost:8000/api/delete-expense/1

- DELETE INCOME
        DELETE http://localhost:8000/api/delete-income/1
        
#### Super admin endpoints

- GET ALL USERS
        GET http://localhost:8000/api/all-users

- GET ALL CATEGORIES
        GET http://localhost:8000/api/all-categories

- ACTIVATE USER
        PUT http://localhost:8000/api/user-activate/{id}

- INACTIVATE USER
        PUT http://localhost:8000/api/user-inactivate/{id}

- CHANGE USER ROLE 
        PUT http://localhost:8000/api/user-role/{id}
        body:
            {
                "role":"admin",
            }



</details>

## Contacto

[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:vanessabritogonzalez@gmail.com)
[![LinkedIn](https://img.shields.io/badge/linkedin-%230077B5.svg?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/vanessabritogonzalez/)

## Creditos
Este proyecto ha sido realizado por mi, Vanessa Brito, como trabajo final del Bootcamp Full Stack Developer de [![GeeksHubs Academy](https://img.shields.io/badge/GeeksHubs_Academy-%23F40D12?style=for-the-badge&color=%23F40D12)](https://geekshubsacademy.com/)