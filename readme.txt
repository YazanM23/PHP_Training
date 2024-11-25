
# Sport Club PHP Project

This **Sport Club PHP Project** is a web application built using plain PHP to manage the operations of a sports club. It includes features for managing players, trainers, and matches, along with user authentication.

---

## Key Features

- **Player Management**:
  - Add, update, delete, and view players.
- **Trainer Management**:
  - Add, update, delete, and view trainers.
- **Match Scheduling**:
  - Schedule and manage matches.
  - View match results and upcoming games.
- **User Authentication**:
  - Secure login and registration system.
- **Custom PHP Framework**:
  - Application built without Laravel or other frameworks.

---

## Getting Started

### Prerequisites

- **PHP** >= 7.4
- **MySQL** or any preferred database
- **Apache/Nginx** web server

---

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/YazanM23/Sport_Club_PHP
   cd Sport_Club_PHP
   ```

2. **Set up the database**:
   - Import the `sport_club.sql` file into your MySQL database.
   - Update the `config.php` file with your database credentials.

3. **Start the server**:
   - If using Apache/Nginx, place the project in the appropriate web directory (e.g., `/var/www/html`).
   - Alternatively, use PHP's built-in server:
     ```bash
     php -S localhost:8000
     ```

4. **Access the application**:
   Open your browser and navigate to `http://localhost:8000`.

---

## File Structure

- **`index.php`**: Entry point of the application.
- **`config.php`**: Contains database connection settings.
- **`includes/`**: Contains reusable components such as headers and footers.
- **`pages/`**: Contains specific pages for players, trainers, and matches.
- **`functions/`**: Includes helper functions for database operations.

---

## Customization

- Modify `config.php` to update database credentials and site settings.
- Add new pages in the `pages/` directory to expand functionality.
- Use the `functions/` directory to add new database queries or utilities.

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

## Contact

For queries or feedback, reach out:

- **Name**: Yazan Mansour
- **Email**: Yazan.mansour2003@gmail.com
