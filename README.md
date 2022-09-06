## Subscription tracker

A simple subscription tracker written in Laravel. It does not track financial transactions in any way, and is nothing more than a pretty, glorified list intended to give a quick overview of the active subscriptions you may have.

## Requirements

* [Laravel 9](https://laravel.com/docs/9.x/installation) and all of its requirements


## Installation
- clone repo
- composer install
- npm install
- npm run dev
- php artisan serve/your way of serving
- php artisan migrate --seed
- Seeding will make an admin account with the following details: you should change them immediately after logging in

## TODO RN:
- Implement password forgot, and password reset features
- Disable user registration
- Remove email verification routes
- Implement error/message component on appropriate pages (user update page for password, subscription creation/update)

## Roadmap:

- [ ] Pagination
- [ ] Ability to view cancelled subscriptions + show an alert on there that its cancelled and can be re-activated
- [ ] Categories/tags
- [ ] Filtering (categories, billing cycle)
- [ ] Improved color picker component with support for hex codes