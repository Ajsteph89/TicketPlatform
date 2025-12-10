# Ticket Market

Ticket Market is a full-stack PHP ticket marketplace application where users can browse events, purchase tickets through a cart-based checkout system, and where event organizers can manage events and ticket inventory.  
This project was built as part of a technical interview assignment and demonstrates real-world MVC architecture, authentication, cart functionality, and dynamic UI updates.

---

## Features

### User Roles
- **Event Goer**
  - Browse events and tickets
  - Add tickets to cart
  - Update/remove items from cart
  - Checkout via modal
  - View purchased tickets

- **Event Organizer**
  - Create, edit, and delete events
  - Create and manage tickets per event
  - Control ticket inventory
  - View all their events in one dashboard

---

### Cart & Checkout
- Quantity-based add and remove
- Live cart updates inside a modal
- Clear cart functionality
- Mock checkout form with confirmation screen
- Inventory updates on successful checkout
- “Sold Out” enforcement when ticket quantity reaches zero

---

### UI & UX
- Clean CSS styling with reusable components
- Modal-based cart and checkout
- Responsive layout
- Styled admin dashboards
- Professional form components
- Hero landing page

---

## Tech Stack

- **Backend:** PHP (Custom MVC)
- **Database:** MySQL
- **Frontend:** HTML, CSS, Vanilla JavaScript (AJAX)
- **Authentication:** Custom session-based auth
- **Environment:** Local development via PHP + MySQL

---

## Project Structure
```
/config
    db.php
    routes.php
/controllers
    /Cart
        CartController.php
        CheckoutController.php
    /Goer
        EventController.php
        TicketController.php
    /Organizer
        EventAdminController.php
        OrganizerController.php
        TicketAdminController.php
    AuthController.php
    HomeController.php
/core
    Controller.php
    Router.php
/database
    schema.sql
/models ← placeholders for potential future refactor
    Event.php
    Ticket.php
    User.php
/partials
    navbar.php
/public
    /css
        app.css
    /js
        cart-modal.js
        password.js
    index.php
/views
    /auth
        login.php
        register.php
    /cart
        index.php
    /checkout
        index.php
        success.php
    /events
        index.php
        show.php
    /goer
        mytickets.php
    /home
        index.php
    /layout
        main.php
    /organizer
        /events
            create.php
            edit.php
            index.php
        /tickets
            create.php
            edit.php
            index.php
```
---

## Setup Instructions

1. Clone the repository  
2. Create a local MySQL database  
3. Configure environment variables using `.env`  
4. Import database schema  
5. Start your local PHP server  
6. Visit `http://localhost:8000`  

---

## Database Setup

1. Create the database:
   ```sql
   CREATE DATABASE ticketing_app;
   ```

2. Import the schema:
   ```bash
   mysql -u root -p ticketing_app < database/schema.sql
   ```

---

## Environment Variables

1. Copy the example file:
   ```bash
   cp .env.example .env
   ```

2. Update the values in `.env` with your local database credentials.

---

## Authentication

- Login and registration system
- Role-based routing for:
    - Event organizers
    - Ticket buyers
- Session-based login handling

---

## Key Challenges Solved

- Custom MVC routing and controllers
- Cart logic with session persistence
- Quantity-based inventory management
- Modal-based checkout without page reload
- Dynamic UI updates with AJAX
- Shared CSS component system for forms and cards

---

## Future Enhancements

- Payment processor integration (Stripe, etc.)
- Event expiration & ticket sale windows
- Order history & email confirmations
- Dark mode toggle
- Advanced analytics dashboard for organizers

---

## Author

Built by **Adam Stephens**  
Software Developer  
PHP | Laravel | Python | Django | JavaScript  

---

## License

This project is for educational and demonstration purposes only.
