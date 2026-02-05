# Finance Tracker - Portfolio Documentation

A modern, high-performance personal finance management application built with the **TALL stack** (Tailwind, Alpine.js, Laravel, Livewire). Designed with a premium dark-mode-first aesthetic and smooth, reactive user interactions.

## 🚀 Key Features

### 📊 Interactive Dashboard
- **Asset vs. Debt Tracking:** Real-time calculation of net worth based on account balances.
- **Recent Activity:** Quick view of the latest 5 transactions across all accounts.
- **Dynamic Data Visualization:** High-impact UI using custom Tailwind components and glassmorphism.

### 💳 Comprehensive Account Management
- **Multi-Account Support:** Manage checking, savings, credit cards, and cash.
- **Auto-Balance Calculation:** Balances are automatically updated when transactions are logged.
- **Safe Deletion:** Integrated confirmation modals to prevent accidental data loss.

### 🏷️ Smart Categorization
- **Iconified Categories:** Uses emojis and distinct color-coding for visual scanning.
- **Income vs. Expense Tracking:** Logical separation of cash flows.
- **Safe Cleanup:** Warning transitions for uncategorizing transactions upon category deletion.

### 📝 Advanced Transaction Ledger
- **Live Search:** Instant filtering by description, account, or category name.
- **Multi-Column Sorting:** Sort by Date, Category, Account, or Amount with visual indicators.
- **Custom Pagination:** Efficient handling of large datasets with modern navigation links.
- **Real-time Feedback:** Uses a custom Toast notification system for all CRUD actions.

## 🛠️ Technical Stack

- **Framework:** [Laravel 12](https://laravel.com)
- **Frontend Logic:** [Livewire](https://livewire.laravel.com)
- **Reactivity:** [Alpine.js](https://alpinejs.dev)
- **Styling:** [Tailwind CSS](https://tailwindcss.com) (Custom color palettes & glassmorphism)
- **Database:** MySQL / PostgreSQL / SQLite
- **Asset Bundling:** Vite

## 🏗️ Architecture Highlights

### Reactive UX Pattern
The application leverages Livewire's `WithPagination` and `wire:model.live` to provide a "Single Page App" (SPA) feel without the complexity of a heavy JavaScript framework. Search results and sorting update the DOM instantly via AJAX.

### Modern Component Library
- **Custom Toast System:** A self-contained Alpine.js component listening for global browser events to show non-blocking notifications.
- **Reusable Modals:** An `@entangle`-powered confirmation modal that bridges backend state with frontend transitions.
- **Consistent Design System:** Defined primary/secondary tokens in `tailwind.config.js` for a unified brand identity.

## 💻 Installation & Setup

1. **Clone the repository**
2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```
3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Database Setup:**
   ```bash
   # Configure your DB in .env then run:
   php artisan migrate
   ```
5. **Compile Assets:**
   ```bash
   npm run build
   ```
6. **Serve the app:**
   ```bash
   php artisan serve
   ```

## Credits

- **UI Template:** [Astrolus](https://www.tailawesome.com/resources/astrolus) by TailAwesome (MIT License).
- **Icons:** [Heroicons](https://heroicons.com/) and [Lucide](https://lucide.dev/).
- **Fonts:** [Urbanist](https://fonts.google.com/specimen/Urbanist) via Google Fonts.

---

*This project was developed as a showcase of modern full-stack PHP development, focusing on clean code, responsive design, and efficient database modeling.*
