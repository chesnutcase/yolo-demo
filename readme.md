# YOLO Tech API Demo

Three routes as defined to your specifications:

`POST /api/register`

`POST /api/login`

`GET /api/users/{{user_id}}` (by default, 1)

## Postman screenshots

![Postman 1](/img/postman_1.png)
![Postman 2](/img/postman_2.png)
![Postman 3](/img/postman_3.png)

## Important files you should look at

### `routes/web.php`

Binds routes to their respective middleware and controller actions.

### `app/Http/Controllers/UserController.php`

The main controller where the validation and issuance of tokens occur. 

### `config/auth.php`

Configures two guards, `password` (that uses a username-password combination) and `api` (that uses Passport). The `password` guard will protect the `/api/login` route while the `api` guard protects the other routes that use OAuth.

### `app/Providers/AuthServiceProvider.php`

Contains the driver (`password-login`) the `password` guard depends on. Simple checking for a user with the correct email and (hashed) password.

### `app/Http/Middleware/Authenticate.php`

The `password-auth` middleware that employs the `password` guard to perform logging in on the `/api/login` route.

> **Why create a middleware *and* guard just for the login route?**
>> In case we need to reuse the username/password combination for other routes. Modular design, right?

### `database/migrations/2019_05_22_055403_create_users_table.php`

The migration to create the `users` table.

## Other files of interest

### `database/seeds/*`

Seed files to create starting accounts/client to get you started.

### `after.sh`

Vagrant Provisioning Script if you want to set up your own vagrant VM.

## Setting up your own server to play with postman

I've made this repository "portable" with Vagrant VM provisioning. Download [Vagrant](https://www.vagrantup.com/) and simply run `vagrant up` to start a local server and create a test account. Take note of the port number that the web server binds to (it should be :8000)

> *Note:* If your VM fails to start because of networking issues, you may need to edit the IP Address in the Homestead.yaml file to one on a different subnet of your host device

A test "user" account **and** a registered OAuth password client is ready for you to play with (created using DB seeds in the provision script). Download the postman collection file from the Releases page of this Github repository.

Test account details are as follows:
- `email`: `test@test.com`
- `password`: `password`
- `client_id`: `1`
- `client_secret`: `MfiPWz5UNqB5BgxnwK0YuZ0ueI0byxBJIaObRtzy`

## Testing

You can run the `Register` and `Login` requests in the postman collection as-is without any modification. Before running the `Get Profile` request, run the `Login` request to fetch a new token, and replace it in the Authorization – Bearer Token field in postman.