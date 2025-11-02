# Symfony 6 Mini Blog — Full Course Code

Welcome to the complete code for the Symfony 6 Mini Blog course! This repository contains a fully functional blog application built from the ground up. It's designed to be a comprehensive example covering everything from database entities and forms to file uploads and modern frontend styling with Tailwind CSS.

This README provides a high-level overview of the project's features, architecture, and how to get it running on your local machine.

## Features

* **Blog Post Management:** Full CRUD (Create, Read, Update, Delete) functionality for blog posts.

* **Rich Content:** Posts include a title, content, image, author, and publication date.

* **Slugs:** SEO-friendly URLs are generated for each post (e.g., `/blogs/my-first-post`).

* **Author Relationships:** A clear one-to-many relationship links Authors to their Posts.

* **Image Uploads:** A practical example of handling file uploads with Symfony forms, storing images on the server and referencing them in the database.

* **Data Fixtures:** Sample data for authors and posts is included to populate your database instantly for testing.

* **Modern UI:** A clean, responsive, and mobile-friendly interface built with **Tailwind CSS**.

* **Asset Pipeline:** Uses **Webpack Encore** to compile and manage all frontend assets.

## Tech Stack

* **Backend:** PHP 8.2+, Symfony 6

* **Database:** Doctrine ORM (MySQL/PostgreSQL)

* **Frontend:** Twig (templating), Tailwind CSS, JavaScript

* **Tooling:** Composer, Node.js & npm, Webpack Encore, Doctrine Fixtures

## Project Overview

This application follows standard Symfony best practices:

* **Entities:** The core data is defined in two Doctrine entities: `Blog` and `Author`. The `Author` entity has a one-to-many relationship with the `Blog` entity.

* **Controller:** A single `BlogController` manages all the core application logic, including:

  * Displaying the list of all blog posts (index page).

  * Displaying a single post's details (show page).

  * Handling the form for creating a new post, including processing the image upload.

* **Forms:** The `BlogFormType` class builds the "Create New Post" form using the Symfony Form component. It defines all the fields and their basic validation.

* **Templates:** All frontend views are rendered using Twig templates, which extend a `base.html.twig` layout for a consistent navigation bar and footer.

* **Styling:** Styles are not written in plain CSS. Instead, **Tailwind CSS** utility classes are used directly in the Twig templates. All styles are compiled into a single `app.css` file via Webpack Encore, as defined in `webpack.config.js`.

## How to Run This Project

### Prerequisites

* PHP 8.2 or newer

* Composer

* Node.js 16+ and npm

* A local MySQL or PostgreSQL server

### Setup Instructions

1. **Install Dependencies:** First, install all the PHP dependencies with `composer install` and the frontend dependencies with `npm install`.

2. **Configure the Database:** Create a new, empty database in your local database server. Then, copy the `.env` file (if one doesn't exist) and edit the `DATABASE_URL` variable to point to your new database.

3. **Run Migrations:** With the database configured, run the Doctrine migrations using the Symfony console (`symfony console doctrine:migrations:migrate`) to automatically create all the necessary tables.

4. **Load Sample Data:** To see the blog in action right away, load the sample data by running the Doctrine fixtures command (`symfony console doctrine:fixtures:load`). This will populate the database with sample authors and posts.

5. **Build Frontend Assets:** Compile all the Tailwind CSS and JavaScript assets by running `npm run dev`. For continuous development, you can use `npm run watch` to automatically re-compile on any file change.

6. **Run the App:** You're all set! Start the local Symfony server with `symfony server:start`. You can now access the mini-blog in your browser, typically at **`http://127.0.0.1:8000/blogs`**.

## Troubleshooting

* **404 Errors on CSS/JS:** Your frontend assets probably aren't compiled. Run `npm run dev` and refresh the page.

* **Database Connection Errors:** Double-check your `DATABASE_URL` in the `.env` file. Ensure the username, password, and database name are all correct.

* **Image Uploads Fail:** This is often a file system permission issue. Ensure the `public/uploads` directory exists and that your web server has permission to write to it.

* **Tailwind Classes Not Applying:** If you add new classes and they don't work, your assets are likely stale. Stop and restart `npm run watch` or re-run `npm run dev`.

## Future Roadmap

This project is a great foundation. Here are some ideas for how you could expand it:

* Add **Edit** and **Delete** functionality for posts.

* Implement user **authentication** so only logged-in authors can create posts.

* Add **validation rules** and error messages to the form.

* Implement **pagination** on the blog index page.

* Add a **search** and **filtering** feature.

* Generate **slugs automatically** when a post is saved.
