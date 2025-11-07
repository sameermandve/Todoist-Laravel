# Todoist - Laravel Task Manager

**Todoist** is a strong and complete task management app built with the Laravel framework. It offers secure user authentication and full CRUD operations, helping users manage their daily tasks effectively.

## ✨ Features

*   **Laravel-Powered Backend:** Built on the latest version of Laravel for performance and security.
    
*   **Secure Authentication:** Complete user registration, login, and logout functionality using Laravel.
    
*   **Full Task CRUD:**
    
    *   **C**reate new tasks with a title and description.
        
    *   **R**ead/View a list of all your current tasks.
        
    *   **U**pdate task (e.g. mark as complete).
        
    *   **D**elete tasks permanently.
        
*   **Private Task Lists:** Tasks are associated with the logged-in user, ensuring privacy and data segregation.
    
*   **Responsive Design:** (Assuming the frontend is responsive) A clean and intuitive user interface that works well on desktop and mobile devices.
    

## ✨ Tech Stack

*   **Laravel:** [laravel.com](https://laravel.com/)

*   **Tailwind:** [tailwindcss.com](https://tailwindcss.com/)

*   **Flowbite:** [flowbite.com](https://flowbite.com/)

*   **Lucide Icons:** [mallardduck/blade-lucide-icons](https://github.com/mallardduck/blade-lucide-icons)

## ⚙️ Installation & Setup

To get a copy of Todoist running locally, follow these steps.

### Prerequisites

You will need the following software installed on your machine:

*   PHP (version 8.1 or higher recommended)
    
*   Composer
    
*   Node.js & npm (for frontend asset compilation)
    
*   Database (MySQL, PostgreSQL, or SQLite)
    

### Steps

1.  **Clone the Repository:**
    
        git clone [https://github.com/sameermandve/Todoist-Laravel.git](https://github.com/sameermandve/Todoist-Laravel.git)
        cd Todoist-Laravel
        
    
2.  **Install PHP Dependencies:**
    
        composer install
        
    
3.  **Setup Environment File:** Duplicate the example environment file and generate a unique application key.
    
        cp .env.example .env
        php artisan key:generate
        
    
4.  **Configure Database:** Edit the `.env` file and set your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.).
    
5.  **Run Migrations:** This command will create the necessary `users` and `tasks` tables in your database.
    
        php artisan migrate
        
    
6.  **Install Frontend Dependencies & Compile Assets:**
    
        npm install
        npm run dev
        # or npm run build for production assets
        
    
7.  **Start the Local Server:**
    
        php artisan serve
        
    
    The application will now be running at `http://127.0.0.1:8000`.
    

## 🚀 Usage

1.  **Register:** Navigate to the login/register page and create a new account.
    
2.  **Login:** Use your credentials to access your private task dashboard.
    
3.  **Manage Tasks:**
    
    *   Use the input form on the dashboard to quickly create new tasks.
        
    *   Click the "Complete" or "Delete" button to update the task status or remove it.
        

## 🤝 Contributing

Contributions are welcome! Feel free to submit pull requests or open issues if you find bugs or have suggestions for new features.

## 📄 License

Todoist is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT "null").