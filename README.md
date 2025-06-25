# 🏢 Laravel Property Management API

A RESTful API built with Laravel 10+ to manage properties, units, landlords, and tenants. It supports authentication, role-based access, and CRUD operations with secure API token handling via Laravel Sanctum.

---

## 🚀 Features

- **User roles**: Admin, Landlord, Tenant
- **Authentication**: Laravel Sanctum API tokens
- **CRUD operations**:
  - Landlords
  - Buildings
  - Units
  - Tenants
- **Relationships**:
  - Landlords own buildings
  - Buildings have units
  - Tenants are assigned to units
- **Validation** via FormRequest classes
- **Authorization** via Policies
- **Seeder** for test data
- **Clean RESTful routes**

---

## 🛠️ Tech Stack

- Laravel 10+
- PHP 8.1+
- MySQL / MariaDB
- Sanctum (API authentication)

---

## 📦 Installation

```bash
git clone https://github.com/your-username/property-management-api.git
cd property-management-api

composer install
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with database credentials.

---

## 🧑‍💻 Run the App

```bash
php artisan migrate:fresh --seed
php artisan serve
```

App will be available at: `http://localhost:8000`

---

## 🔐 Authentication

- **Register**: `POST /api/register`
- **Login**: `POST /api/login`
- **Logout**: `POST /api/logout`
- **Get User**: `GET /api/me`

Authentication via **Bearer Token** returned on login/registration.

---

## 📚 API Endpoints

| Resource      | Route                              | Method  |
|---------------|-------------------------------------|---------|
| Auth          | /api/register, /api/login, /me     | POST, GET |
| Buildings     | /api/buildings                     | CRUD    |
| Units         | /api/buildings/{building}/units    | CRUD    |
| Tenants       | /api/tenants                       | CRUD    |
| Landlords     | /api/landlords                     | CRUD    |

All except `/register` and `/login` are protected via `auth:sanctum`.

---

## 🧪 Seeded Test Users

| Role    | Email                | Password  |
|---------|----------------------|-----------|
| Admin   | admin@example.com    | password  |
| Landlord | landlord@example.com | password  |
| Tenant  | tenant@example.com   | password  |

---

## 📂 Project Structure

```
app/
├── Http/
│   ├── Controllers/Api/
│   ├── Requests/       ← FormRequest validation
│   └── Middleware/
├── Models/
├── Policies/
database/
├── seeders/
├── migrations/
routes/
└── api.php             ← API routes
```

---

## 🔐 Policies

- Landlords can manage only their buildings and units
- Admins have full access
- Tenants access their own profiles only

---

## ✅ To Do

- [ ] Add file/image uploads (e.g., documents, building photos)
- [ ] Add rent payment tracking
- [ ] Implement notifications (rent reminders)
- [ ] API docs with Swagger/OpenAPI
- [ ] Advanced search/filter support

---

## 🧑‍💼 License

MIT — free to use, modify, and distribute.

---

## 🤝 Contributions

Pull requests welcome. Please fork, branch, and submit PRs.

---

## 📬 Contact

Made with ❤️ for Laravel developers.