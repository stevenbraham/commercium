# About
For a school assigment we had to create a PHP project that demonstrates our abbility to utilize a MySQL connection and session management. I taken this a step further and created a framework that is a mix between Laravel and Yii. The application itself is an application that simulats a strock trading firm. I have developed a 3 tier RBAC system:

* regular users can only see statistics
* buyers can buy stocks
* admins can create user accounts

A user can be in multiple groups. I don't use a layered model where each layer inherits the permissions of the other layers. This is for security reasons.

I have tried to use several design patterns in my application:
* Facade: my setup class has a static `boot` function. This is acts as a facade for loading all framework files, connection to the database and preparing a singleton "Core" object.
* Factory: The setup class creates a Core object and sets all important data. Also all models have a create functions.
* Repository: all database access is seperated. All the controllers communnicate with the datbase with uniformed repository classes. The repository retrieves the data from the database and infuses models objects with the data. The controller doesn't know where the data comes from.

Because it's a requirement from School, I have included one public page. The "about" page gives stats about how much trades have been done using this application.

I have also developed my own routing system based on Yii. All controller classes have to end with controller and all methods should start with action. This prevents people from executing random classes. For example /users/new gets mapped to

```php
<?php
class UsersController extends Controller{
    public function actionNew(){
        ...
    }
}
```

For the most part my application follows the structure of any standard php MVC app. Most design choices are documented as PHPDoc or comments. If you have questions, send me a message on [Twitter](https://twitter.com/steven_braham).
