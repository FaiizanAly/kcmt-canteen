# KCMT Canteen - Food Ordering & Management

This project is designed to streamline the process of ordering food at the KCMT canteen, reducing the time students spend in queues. With this system, students can place their orders online, and the canteen staff can manage these orders through an admin panel.

## Features

- **Student Interface:**
  - Create an account and log in.
  - Browse the menu and place orders for food, snacks, and drinks.
  - View order history.

- **Admin Interface:**
  - Manage student accounts.
  - Update the menu with new items, prices, and availability.
  - View and manage incoming orders.

- **Technologies Used:**
  - **Frontend:** HTML, CSS, JavaScript, Bootstrap
  - **Backend:** PHP
  - **Database:** MySQL
  - **Animations:** AOS (Animate On Scroll) library

## Getting Started

### Prerequisites

- A web server (e.g., Apache)
- PHP installed
- MySQL database

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/FaiizanAly/kcmt-canteen.git
    ```

2. Navigate to the project directory:
    ```bash
    cd kcmt-canteen
    ```

3. Import the database:
    - Create a new database in MySQL.
    - Import the `kcmt-canteen.sql` file into your database.

4. Configure the database connection:
    - Open `config.php` and update the database connection details:
      ```php
      <?php
      $host = 'your_host';
      $user = 'your_username';
      $pass = 'your_password';
      $db = 'your_database';
      ?>
      ```

5. Start your web server and navigate to the project directory in your browser.

## Usage

1. **Student:**
   - Register for an account and log in.
   - Browse the menu and place an order.
   - View the status of your orders in the order history section.

2. **Admin:**
   - Log in to the admin panel.
   - Manage student accounts and view order history.
   - Update menu items as needed.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes. Ensure your code adheres to the project's coding standards and include appropriate tests.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Special thanks to the KCMT community for their support and feedback.
- Inspired by the need to improve the canteen experience for students and staff.

## Contact

For any questions or suggestions, please contact:

- Name: Faizan Aly
- Email: itsfaizanali5@gmail.com

---

Thank you for using the KCMT Canteen - Food Ordering & Management System!
