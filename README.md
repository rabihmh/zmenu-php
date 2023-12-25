# ZMENU

# Restaurant Multi-Tenant Laravel Web Application

Welcome to the README file for our Laravel-based multi-tenant restaurant web application! This application allows
restaurant owners to register, create their restaurant's domain, manage categories, food items, tables, customer orders,
and bills. Additionally, customers can access the restaurant's services through QR codes.

## Table of Contents

1. [Introduction](#introduction)
2. [Features](#features)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Usage](#usage)
6. [Contributing](#contributing)

## Introduction

Our Laravel web application provides a powerful and scalable solution for restaurant management. It supports
multi-database multi-tenancy, enabling each restaurant owner to have their own isolated database and domain. Restaurant
owners can register on the website, create their restaurant's domain, and manage their restaurant's details and
services.

## Features

- **Multi-Tenancy**: Each restaurant owner gets their own isolated database and domain for managing their restaurant.
- **User Registration**: Restaurant owners can register on the website to create and manage their restaurant.
- **Restaurant Management**: Owners can add categories, food items, and manage their restaurant details.
- **Table Management**: Owners can add and manage tables in their restaurant, each associated with a QR code.
- **Customer Interaction**: Customers can scan the QR code on a table to access the restaurant's menu and services.
- **Ordering System**: Customers can place orders through the QR code interface.
- **Notifications**: Admin receives notifications when customers use a table's QR code and place orders.
- **Kitchen Notifications**: When an order is placed, the kitchen is notified to prepare the food.
- **Billing**: Customers can view their bills through the application.

## Installation

Follow these steps to set up the project:

1. Clone the repository: `git clone https://github.com/rabihmh/zmenu.git`
2. Navigate to the project directory: `cd zmenu`
3. Install composer dependencies: `composer install`
4. Create a `.env` file: `cp .env.example .env`
5. Generate an application key: `php artisan key:generate`
6. Configure your database settings in the `.env` file.
7. Migrate the database: `php artisan migrate`
8. Run the development server: `php artisan serve`

## Configuration

In the `.env` file, you'll need to set up the database connections for multi-tenancy, notification settings, and other
environment-specific configurations.

## Usage

1. Register as a restaurant owner on the website.
2. After registration, you will be provided with a domain for your restaurant.
3. Log in to your restaurant's admin panel using your credentials.
4. Manage your restaurant details, add categories, food items, and tables.
5. Each table will have a unique QR code associated with it.
6. Customers can scan the QR code to access the restaurant's services, view the menu, and place orders.
7. Admin receives notifications when customers use QR codes and place orders.
8. The kitchen receives notifications to prepare food when an order is placed.
9. Customers can also view their bills through the application.

## Contributing

We welcome contributions to enhance our restaurant web application. If you have any suggestions, bug fixes, or new
features to propose, please feel free to submit a pull request.
