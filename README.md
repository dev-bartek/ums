# User Management System Coding Task

## Installation
- clone the repo to your local environment.
- configure the `.env` file to match your environment settings i.e. database
- run `composer install` - to install php project dependencies
- set app key by running: `php artisan key:generate`
- run `npm install` - to install js project dependencies
- run `npm run dev` - to start included vite asset bundler
- run migrations: `php artisan migrate`
- run provided seeder `php artisan db:seed` that will seed users
- run the included tests to ensure all is set as it should `php artisan test`

## Notes

In the development of user management system i took following into consideration.

### Data Layer
- <i><b>HasOne</b></i> `Address` relation on `User` model
- <i><b>BelongsTo</b></i> `User` relation on `Address` model
- <i><b>UserFactory</b></i> - to help with seeding data and future testing
- <i><b>AddressFactory</b></i> - to help with seeding data and future testing
- <i><b>DatabaseSeeder</b></i> - capable to quickly seed sample users

### Controlling Layer
- <i><b>UserForm</b></i> - Livewire Form Object responsible for:
<br> • <i>collecting and validating user form data</i>
<br> • <i>persisting user form data to database</i>
<br> • <i>updating user form data in database</i>


- <i><b>ListUsers</b></i> - full page Livewire component responsible for:
<br> • <i>preparing paginated list of users</i>
<br> • <i>handling delete user action</i>


- <i><b>CreateUser</b></i> - child Livewire component responsible for:
<br> • <i>creating user record with help of UserForm object</i>
<br> • <i>resetting UserForm object</i>


- <i><b>EditUser</b></i> - child Livewire component responsible for:
  <br> • <i>editing user record with help of UserForm object</i>
  <br> • <i>resetting UserForm object</i>

### View Layer

- <i><b>Blade Components</b></i> - group of reusable blade components created to enable future expansion and ease of customization.


- <i><b>Livewire component view blade files</b></i>
```
// list-users.blade.php - which contains:
-> button to access create user modal
-> main table to list users
-> pagination links towards bottom of the page
```
```
// user-form.blade.php - which contains:
-> main modal structure
-> main User Form with edit and delete control button.
-> control buttons for the modal
```
