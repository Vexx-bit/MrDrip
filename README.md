<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
</head>
<body>

  <h1>👕 MrDrip: E-Commerce Clothing Store</h1>
  <p><strong>MrDrip</strong> is a PHP-based e-commerce platform designed for selling clothing items online. It features user authentication, product browsing, cart management, order processing, and payment integration via M-PESA for Kenyan users. The system includes both customer-facing and admin interfaces for a seamless shopping experience.</p>

  <h2>🎯 Features</h2>
  <ul>
    <li>User registration and login</li>
    <li>Browse and filter products by category</li>
    <li>Add items to cart and proceed to checkout</li>
    <li>Order history and status tracking</li>
    <li>Admin dashboard for managing products and orders</li>
    <li>Payment integration with M-PESA</li>
    <li>Responsive design for mobile and desktop</li>
  </ul>

  <h2>📁 Project Structure</h2>
  <pre>
MrDrip/
├── admin/               --> Admin panel files
├── Daraja/              --> M-PESA API integration
├── functions/           --> Helper functions
├── includes/            --> Common PHP includes
├── assets/              --> Images and other assets
├── index.php            --> Homepage
├── login.php            --> User login page
├── logout.php           --> User logout script
├── cart.php             --> Shopping cart page
├── checkout.php         --> Checkout page
├── confirm_payment.php  --> Payment confirmation page
├── order_history.php    --> User order history page
├── contact.php          --> Contact page
├── faqs.html            --> Frequently Asked Questions page
└── LICENSE              --> Project license
  </pre>

  <h2>⚙️ Installation</h2>
  <ol>
    <li>Clone the repository:
      <pre><code>git clone https://github.com/Vexx-bit/MrDrip.git</code></pre>
    </li>
    <li>Set up a MySQL database and import the provided SQL file:
      <ul>
        <li>Create a new database (e.g., <code>mrdrip</code>)</li>
        <li>Import the SQL script located in the <code>database/</code> directory</li>
      </ul>
    </li>
    <li>Configure the database connection:
      <ul>
        <li>Open the relevant configuration file in the <code>includes/</code> directory</li>
        <li>Update the database credentials accordingly</li>
      </ul>
    </li>
    <li>Set up M-PESA payment integration:
      <ul>
        <li>Follow the instructions in the <code>Daraja/</code> directory to configure M-PESA API credentials</li>
        <li>Ensure you have access to Safaricom's M-PESA Daraja API</li>
      </ul>
    </li>
    <li>Run the application:
      <ul>
        <li>Place the project folder in your web server's root directory (e.g., <code>htdocs</code> for XAMPP)</li>
        <li>Start your web server and navigate to <code>http://localhost/MrDrip/</code></li>
      </ul>
    </li>
  </ol>

  <h2>🔐 Administrator Access</h2>
  <ul>
    <li>Access the admin panel via <code>admin/</code></li>
    <li>Login using the administrator credentials set in the database</li>
  </ul>

  <h2>📄 License</h2>
  <p>This project is licensed under the terms of the <a href="https://github.com/Vexx-bit/MrDrip/blob/main/LICENSE">MIT License</a>.</p>

  <p>Developed with ❤️ by Samuel Kang'ethe (<a href="https://github.com/Vexx-bit">Vexx-bit</a>)</p>

</body>
</html>
