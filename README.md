![frame_firefox_mac_dark (1)](https://user-images.githubusercontent.com/80502833/187230764-e1bb2b44-c221-4529-ba73-a2261e636372.png)

<h1 align="center">EV Two-Wheeler Reseller Website Project</h1>  

This is a project for an EV two-wheeler reseller website. It is a project for the College Mini Project.

## Table of Contents

- [Table of Contents](#table-of-contents)
- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database](#database)
- [Table](#table)
- [EV Listing Page](#ev-listing-page)
- [User Story](#user-story)
- [Admin Page](#admin-page)
- [License](#license)
- [Authors](#authors)
- [Show your support](#show-your-support)

## Introduction

- This is an EV two-wheeler reseller website project.
- The purpose of this project is to create an online platform for reselling EV two-wheelers.
- The website will have a login page, an EV listing page, a reservation (purchase interest) page, and a return/cancel request page.
- The login page will have a username and password input field.
- The EV listing page will have a search bar and an EV listing table.
- The reservation page will have a purchase interest/reservation table.

## Requirements

- XAMPP is required to run the project.
- The project will be hosted on a localhost server.

## Installation

- Install XAMPP.
- Open XAMPP and click on the Start button.
- Clone the project to the root of the XAMPP server.
- Open the project in XAMPP.
- Import SQL file from the database folder to the XAMPP server.
- Open Browser and navigate to [localhost:8080](http://localhost:8080).
- Hurray! The project is now running.

## Database

- The database is stored in a folder called `database`.
- The database is named `evproject.sql`.
- The database is stored in the root of the XAMPP server.
- The database is imported to the XAMPP server.
- Database used is MySQL.
- Database Connection page is named [connection.php](/connection.php).

## Table

- The table is named as `vehicle`.
- The table has the following columns:
    - vehicle_id: INTEGER PRIMARY KEY AUTO_INCREMENT
    - vehicle_make: VARCHAR(255)
    - vehicle_model: VARCHAR(255)
    - vehicle_year: INTEGER
    - vehicle_color: VARCHAR(255)
    - vehicle_price: INTEGER
    - vehicle_available: BOOLEAN
    - vehicle_image: VARCHAR(255)
    - vehicle_description: VARCHAR(255)

## EV Listing Page

- The EV listing page will have a search bar and a listing table.
- The search bar will have a search button.
- The search button will search for the vehicle based on the search bar input.
- Only available EVs will be shown on the listing page.

## User Story

- As a user, I want to be able to search for an EV two-wheeler.
- As a user, I want to be able to see the EVs that are available.
- As a user, I want to be able to show interest in purchasing an EV.
- As a user, I want to be able to cancel my purchase request.
- As a user, I want to see the EVs I’ve shown interest in.
- As a user, I want to provide feedback on the platform.
- As a user, I should be able to make payment for the EV.

## Admin Page

- The admin page will have a listing table of EVs.
- It has a button to add a new EV.
- The button will open a new page where the admin can add a new vehicle.
- The admin can add a new EV by filling in the form.
- The admin can also delete an EV by clicking the delete button.
- Admin can view user purchase interest by clicking the view button.
- Admin can view user cancel requests by clicking the view button.
- Admin can approve or reject a purchase interest request.
- Admin can confirm the sale of an EV.
- Admin can delete a reservation by clicking the delete button.
- Admin can view feedback by clicking the view button.

## License

[MIT](https://choosealicense.com/licenses/mit/) © [Darji Neel](https://github.com/Neel-Darji30)  
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Authors 

- [Darji Neel G](https://github.com/Neel-Darji30)
- [Panchal Sachin H](https://github.com/sachinpanchal1170)

## Show your support

Give a ⭐️ if this project helped you!
