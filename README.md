# PropertyMatch — AI-Powered Property Rental Platform

> Final Year Project | B.Sc. Software Engineering (Honours)
> University of Central Punjab, Lahore, Pakistan | 2024–2025
> **Author:** Sohail Ahsan · [sohailahsan015@gmail.com](mailto:sohailahsan015@gmail.com) · [github.com/sohailahsan0393](https://github.com/sohailahsan0393)

---

## Overview

PropertyMatch is a full-stack web application that enables users to search for rental properties using **natural language queries**. Instead of rigid filter forms, users describe what they are looking for in plain English. The system parses the query, matches it against a property database, and returns ranked results.

The project integrates **Laravel web application development**, **relational database design**, **automated testing**, and a **natural language processing pipeline** into a single production-structured system — demonstrating a complete software engineering lifecycle from design to tested deployment.

---

## Problem Statement

Existing rental platforms require users to manually configure search filters (price, location, bedrooms, etc.), which fails to capture nuanced natural language preferences such as:

> *"A quiet flat near a university, suitable for a student, under 400 per month"*

PropertyMatch addresses this by transforming free-text input into structured database query parameters using a text classification and query-parsing pipeline trained on a manually annotated dataset of 200+ real-world rental queries.

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 11 (PHP 8.2) |
| **Frontend** | Blade Templates, HTML5, CSS3, JavaScript |
| **Database** | MySQL |
| **NLP / ML Pipeline** | Python (text classification, query parsing) |
| **Testing** | Pest PHP (unit and feature tests) |
| **Local Dev Environment** | Laravel Herd / Laravel Sail (Docker) |
| **Dependency Management** | Composer (PHP), npm (JS) |
| **Version Control** | Git / GitHub |

---

## System Architecture

```
┌─────────────────────────────────────────────────────┐
│              User Interface (Browser)                │
│         Laravel Blade Templates + JS/CSS             │
└─────────────────────┬───────────────────────────────┘
                      │ HTTP Request
┌─────────────────────▼───────────────────────────────┐
│              Laravel Application Layer               │
│  Routes → Controllers → Services → Models (Eloquent)│
│                                                      │
│  - Query preprocessing & NLP pipeline integration   │
│  - Authentication & session management               │
│  - Result ranking & response formatting              │
└──────────┬──────────────────────┬───────────────────┘
           │                      │
┌──────────▼──────────┐  ┌────────▼───────────────────┐
│   MySQL Database    │  │    Python NLP Module        │
│  (via Eloquent ORM) │  │                             │
│                     │  │ - Text preprocessing        │
│ - Properties        │  │ - Intent classification     │
│ - Users             │  │ - Query-to-filter mapping   │
│ - Search logs       │  │ - Relevance ranking         │
│ - Migrations        │  │                             │
└─────────────────────┘  └─────────────────────────────┘
```

---

## Key Features

- **Natural language property search** — plain English input interpreted as structured filters
- **NLP classification pipeline** — trained on 200+ manually annotated query examples
- **Laravel MVC architecture** — clean separation of routing, business logic, and views
- **Eloquent ORM** — database interactions through Laravel's object-relational mapper
- **Automated test suite** — unit and feature tests written with Pest PHP
- **Authentication system** — user registration, login, and personalised search history
- **Environment-based configuration** — `.env` file for secure credential management
- **Docker-ready** — Laravel Sail configuration for containerised local development

---

## NLP Methodology

The recommendation engine processes user input in three stages:

**Stage 1 — Query Preprocessing**
Raw input is cleaned, tokenised, and normalised. Key entities are extracted: location references, price range indicators, property type keywords, and amenity descriptors.

**Stage 2 — Text Classification**
A classifier trained on 200+ manually annotated rental queries assigns intent labels to the processed input. The annotation process categorised queries by property type, location specificity, budget range, and amenity requirements.

**Stage 3 — Filter Mapping and Ranking**
Classified intents are mapped to structured MySQL query parameters via the Laravel backend. Matching properties are retrieved through Eloquent and ranked by a relevance score calculated from the degree of match between query features and property attributes.

**Evaluation**
Model performance was measured using precision, recall, and F1-score on a held-out test split. Generalisation limitations on ambiguous or compound queries were identified and documented as areas for future improvement.

---

## Project Structure

```
PropertyMatch/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Route controllers
│   │   └── Middleware/         # Auth and request middleware
│   ├── Models/                 # Eloquent models (Property, User, etc.)
│   └── Services/               # NLP pipeline integration, ranking logic
│
├── database/
│   ├── migrations/             # Laravel database migrations
│   ├── seeders/                # Database seeders
│   └── factories/              # Model factories for testing
│
├── resources/
│   └── views/                  # Blade templates (frontend)
│
├── routes/
│   └── web.php                 # Application routes
│
├── tests/
│   ├── Unit/                   # Unit tests (Pest PHP)
│   └── Feature/                # Feature/integration tests (Pest PHP)
│
├── python/
│   ├── classifier.py           # NLP text classification module
│   ├── preprocessor.py         # Query preprocessing pipeline
│   └── requirements.txt        # Python dependencies
│
├── .env.example                # Environment configuration template
├── composer.json               # PHP dependencies
├── phpunit.xml                 # Test configuration
└── README.md                   # This file
```

---

## Setup & Installation

### Prerequisites
- PHP 8.2+
- Composer
- MySQL 8.0+
- Python 3.8+
- Node.js & npm
- Laravel Herd (recommended) or Docker (via Laravel Sail)

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/sohailahsan0393/PropertyMatch-Website.git
cd PropertyMatch-Website
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install JavaScript dependencies**
```bash
npm install && npm run build
```

**4. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```
Edit `.env` with your local database credentials.

**5. Run database migrations**
```bash
php artisan migrate --seed
```

**6. Install Python dependencies**
```bash
pip install -r python/requirements.txt
```

**7. Start the development server**
```bash
php artisan serve
```
Visit `http://localhost:8000` in your browser.

### Running Tests
```bash
php artisan test
```

---

## Academic Context

Developed as the Final Year Project (FYP) for the degree of **Bachelor of Science in Software Engineering (Honours)** at the **University of Central Punjab**, Lahore, Pakistan (2021–2025). Completed across two semesters:

- **FYP-I** (Semester 7, Fall 2024) — System design, dataset annotation, NLP pipeline, Laravel architecture
- **FYP-II** (Semester 8, Spring 2025) — Full integration, test suite, evaluation, documentation

| Degree Module | Applied In Project |
|---|---|
| Software Design & Architecture | Laravel MVC, service layer, Eloquent ORM |
| Database Systems | MySQL schema, migrations, query optimisation |
| Web Engineering | Full-stack Laravel application |
| Algorithms & Data Structures | Ranking algorithm, classification pipeline |
| Software Quality Assurance | Pest PHP automated test suite |
| DevOps Fundamentals | Laravel Sail (Docker), Git workflow, .env config |

---

## Limitations & Future Work

- Classifier generalisation degrades on compound or ambiguous queries
- Training dataset (200+ queries) is relatively small; a larger annotated corpus would improve performance
- Future: transformer-based NLP model (BERT/similar); cloud deployment; expanded property database

---

## Author

**Sohail Ahsan**
B.Sc. Software Engineering (Honours) — University of Central Punjab, Lahore
IELTS Academic: 6.0
GitHub: [github.com/sohailahsan0393](https://github.com/sohailahsan0393)
Email: [sohailahsan015@gmail.com](mailto:sohailahsan015@gmail.com)

---


