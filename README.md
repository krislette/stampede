<a id="readme-top"></a>

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/yourusername/stampede">
    <img src="public/favicon.ico" alt="Logo" width="80" height="80">
  </a>

  <h1 align="center">STAMPede</h1>
  <p align="center">
    A Public Digital Whiteboard for Sharing Thoughts
    <br />
    <a href="#demo">View Demo</a>
    ·
    <a href="https://github.com/yourusername/stampede/issues">Report Bug</a>
    ·
    <a href="https://github.com/yourusername/stampede/pulls">Request Feature</a>
  </p>
</div>

<!-- ABOUT THE PROJECT -->
## About The Project

> STAMPede is a modern web application built with Laravel, Vite, and Tailwind CSS.
> My personal goal for this mini project for DOST is to create a public whiteboard
> where people can send their thoughts to other people. Everyone is free to input anything.
> Of course, there's the challenge of profanity, bad inputs, and all, and I aim to
> solve them on future versions of the application. Right now, I am most proud of its current state.

<!-- TABLE OF CONTENTS -->
### Table Of Contents
<ol>
  <li>
    <a href="#about-the-project">About The Project</a>
    <ul>
      <li><a href="#table-of-contents">Table Of Contents</a></li>
      <li><a href="#features">Features</a></li>
      <li><a href="#technologies-used">Technologies Used</a></li>
    </ul>
  </li>
  <li>
    <a href="#web-snapshots">Web Snapshots</a>
  </li>
  <li>
    <a href="#folder-structure">Folder Structure</a>
  </li>
  <li>
    <a href="#installation">Installation</a>
    <ul>
      <li><a href="#prerequisites">Prerequisites</a></li>
      <li><a href="#cloning-the-repository">Cloning the Repository</a></li>
      <li><a href="#environment-setup">Environment Setup</a></li>
      <li><a href="#database-setup">Database Setup</a></li>
    </ul>
  </li>
  <li>
    <a href="#run">Run</a>
  </li>
  <li>
    <a href="#license">License</a>
  </li>
</ol> 

### Features
- **Public Whiteboard**: Anonymous thought sharing platform
- **Real-time Posting**: Instant message display for community interaction
- **Modern Frontend**: Fast and smooth interactions
- **Laravel MVC Architecture**: Clean, maintainable code structure
- **Blade Templating**: Dynamic and reusable UI components
- **User-friendly Interface**: Simple and intuitive design for easy participation
- **Community-driven**: Open platform for diverse thoughts and perspectives

*Future enhancements will include content moderation and filtering systems.*

### Technologies Used
STAMPede uses a number of technologies to work properly:
- [Laravel](https://laravel.com/) - PHP Framework
- [Vite](https://vitejs.dev/) - Build Tool
- [Tailwind CSS](https://tailwindcss.com/) - CSS Framework
- [Blade](https://laravel.com/docs/blade) - Templating Engine
- [PostgreSQL](https://www.postgresql.org/) - Database via Supabase
- [Composer](https://getcomposer.org/) - PHP Dependency Manager
- [Node.js](https://nodejs.org/) - JavaScript Runtime

<!-- WEB SNAPSHOTS -->
## Web Snapshots

### Home Page
<img width="1365" height="716" alt="image" src="https://github.com/user-attachments/assets/28db8de1-b1b7-4a00-9f63-7118c58aaefa" />

### Home: Lazy Loading
<img width="1365" height="717" alt="image" src="https://github.com/user-attachments/assets/f99e4a85-b416-46ad-9601-baceb8e77987" />

### Home: Bottom
<img width="1365" height="716" alt="image" src="https://github.com/user-attachments/assets/b6d5dba1-4457-4dc2-b8b7-2516849a2f5e" />

### Home: Stamp Created
<img width="1365" height="717" alt="image" src="https://github.com/user-attachments/assets/510b85e2-711d-4681-82e4-2a1fdc6cf612" />

### Home: Stamp Updated
<img width="1365" height="718" alt="image" src="https://github.com/user-attachments/assets/392ea3c8-cd6a-4208-a905-ea9cef4faecc" />

### Home: Stamp Delete
<img width="1365" height="719" alt="image" src="https://github.com/user-attachments/assets/06261153-81fb-4455-8d57-d2316772fc37" />
<img width="1365" height="717" alt="image" src="https://github.com/user-attachments/assets/3928b2f7-dc83-4218-9212-2972a7a61e2e" />

### Create Page
<img width="1365" height="717" alt="image" src="https://github.com/user-attachments/assets/89ac724a-9741-4001-b080-6895d16e5849" />
<img width="1365" height="717" alt="image" src="https://github.com/user-attachments/assets/bbe4adf8-ac53-4dd4-9636-b6f16155ee7a" />

### Update Page
<img width="1365" height="717" alt="image" src="https://github.com/user-attachments/assets/e44432c9-da82-4633-8300-db0f63bb5175" />
<img width="1365" height="715" alt="image" src="https://github.com/user-attachments/assets/7ddbfafd-d7e1-4791-9e30-6bc3350192fd" />

<!-- FOLDER STRUCTURE -->
## Folder Structure

    app/
    ├── Http/
    │   ├── Controllers/          # Application controllers
    │   └── Middleware/           # Custom middleware
    ├── Models/                   # Eloquent models
    └── Providers/                # Service providers
    
    resources/
    ├── css/                      # Tailwind CSS files
    ├── js/                       # JavaScript files
    └── views/                    # Blade templates
    
    public/
    ├── images/                   # Static images
    └── build/                    # Compiled assets (generated by Vite)
    
    routes/
    └── web.php                   # Web routes
    
    database/
    ├── migrations/               # Database migrations
    └── seeders/                  # Database seeders

<!-- INSTALLATION -->
## Installation

### Prerequisites
- **PHP** (version 8.1 or higher)
- **Composer** - PHP dependency manager
- **Node.js** (version 16 or higher)
- **npm** or **yarn** - Package manager
- **PostgreSQL (via Supabase)**

### Cloning the Repository

1. Fork this repository.

2. Clone the repository:
   ```bash
   git clone https://github.com/YOUR_USERNAME/stampede.git
   cd stampede
   ```

### Environment Setup

1. Install PHP dependencies:
   ```bash
   composer install
   ```

2. Install JavaScript dependencies:
   ```bash
   npm install
   ```

3. Copy the environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Configure your `.env` file with your database credentials:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=db.postgrehostfromsupabase.supabase.co # I used supabase that's why host looks like this
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

### Database Setup

1. Your PostgreSQL database is already created on Supabase. Make sure your connection details in .env are correct.

2. Run migrations:
   ```bash
   php artisan migrate
   ```

3. (Optional) Run seeders if you have sample data (I didn't create one on mine pls I don't have time):
   ```bash
   php artisan db:seed
   ```

<!-- RUN -->
## Run

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```

2. In a new terminal, start the Vite development server:
   ```bash
   npm run dev
   ```

3. Visit `http://localhost:8000` in your browser.

### Building for Production

I can't even build for prod myself... I'm so disappointed

<!-- Add more contributors as needed -->

## License
Distributed under the [MIT](https://choosealicense.com/licenses/mit/) License. See [LICENSE](LICENSE) for more information.

<p align="right">[<a href="#readme-top">Back to top</a>]</p>
