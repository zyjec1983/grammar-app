# Grammar App

An interactive English grammar learning application with exercises organized by CEFR levels (A1-A2, B1-B2, C1-C2).

## Overview

Grammar App is a web-based application designed to help students practice and master English grammar through interactive worksheets. The app is based on the popular "Grammar in Use" book series and includes 150 topics covering all proficiency levels.

### Features

- **3 Proficiency Levels**: A1-A2 (Beginner/Elementary), B1-B2 (Intermediate), C1-C2 (Advanced)
- **150 Grammar Topics**: Covering tenses, voice, conditionals, modals, and more
- **Interactive Exercises**: Fill-in-the-blank and multiple choice questions
- **Instant Feedback**: Real-time scoring with percentage results
- **Progress Tracking**: LocalStorage-based completion tracking
- **Responsive Design**: Works on desktop, tablet, and mobile
- **Theme Support**: Light and dark mode toggle

---

## Design Pattern

### MVC (Model-View-Controller)

The application follows the **MVC (Model-View-Controller)** design pattern for several reasons:

1. **Separation of Concerns**: Each component has a single responsibility
   - **Model**: Data management and business logic
   - **View**: Presentation and user interface
   - **Controller**: Request handling and flow control

2. **Maintainability**: Code is organized and easy to maintain
   - Changes in one layer don't affect others
   - Clear file structure

3. **Scalability**: Easy to add new features
   - New controllers can be added without modifying existing code
   - Models can be extended for additional data sources

### Why MVC?

- **Simplicity**: Straightforward structure, easy to understand
- **PHP-Native**: No frameworks required, pure PHP
- **Learning Curve**: Ideal for educational projects
- **Flexibility**: Can be extended to database connectivity later

---

## Project Structure

```
grammar-app/
├── config/
│   └── app.php              # Application configuration
├── data/
│   └── worksheets/         # JSON files for each worksheet (001.json - 150.json)
├── logs/
│   └── .gitkeep            # Log files directory
├── public/
│   ├── index.php          # Application entry point
│   ├── .htaccess          # URL rewriting
│   └── assets/
│       ├── css/           # Stylesheets
│       └── js/            # JavaScript files
├── routes/
│   └── web.php           # Route definitions
└── src/
    ├── controllers/      # Request handlers
    │   ├── HomeController.php
    │   └── WorkSheetController.php
    ├── core/             # Core classes
    │   ├── Controller.php
    │   └── Router.php
    ├── models/           # Data models
    │   └── WorksheetModel.php
    └── views/            # Presentation layer
        ├── layouts/     # Shared templates (header, footer, aside)
        ├── home/        # Home page views
        └── worksheets/  # Worksheet views
```

---

## Workflow

### User Flow

```
1. Home Page (/)
   │
   ├──→ Select Level (A1-A2 / B1-B2 / C1-C2)
   │
   2. Level Page (/level?level=xxx)
   │   │
   │   ├──→ Select Topic
   │   │
   │   3. Worksheet Page (/worksheet?id=xxx)
   │       │
   │       ├──→ Answer Exercises (by Section)
   │       │
   │       ├──→ Submit → View Score (%)
   │       │
   │       └──→ (Optional) Progress saved to LocalStorage
```

### Request Flow

```
User Request
    │
    ▼
index.php (Entry Point)
    │
    ▼
Router (Routes to Controller)
    │
    ▼
Controller (Handles Logic)
    │
    ▼
Model (Fetches Data)
    │
    ▼
View (Renders HTML)
    │
    ▼
Response to User
```

---

## Routes

| Method | Route | Controller | Action |
|--------|-------|------------|--------|
| GET | `/` | HomeController | index() - 3 level cards |
| GET | `/level?level=xxx` | HomeController | level() - worksheet list |
| GET | `/worksheet?id=xxx` | WorkSheetController | show() - exercises |
| POST | `/worksheet?id=xxx` | WorkSheetController | show() - submit answers |

---

## Data Structure

### Worksheet JSON

```json
{
    "id": "001",
    "title": "Subject Pronouns and Verb 'To Be'",
    "level": "a1-a2",
    "topic": 1,
    "sections": ["A", "B", "C"],
    "section_instructions": {
        "A": "Fill in the blanks using HE, SHE, IT, WE, THEY:",
        "B": "Fill in the blanks using AM, IS, ARE:"
    },
    "questions": [
        {"section": "A", "type": "fill", "text": "cat and horse", "answer": "they"},
        {"section": "B", "type": "choice", "text": "She ___ a student.", "options": ["am", "is", "are"], "answer": "is"}
    ]
}
```

---

## Sprints

### Sprint 1: Foundation ✓
- [x] Project setup and folder structure
- [x] Core MVC classes (Router, Controller)
- [x] Configuration files
- [x] Basic routes

### Sprint 2: Frontend ✓
- [x] Layouts (header, footer, aside)
- [x] Home page with 3 level cards
- [x] Level page with topic list
- [x] Worksheet page with tabs
- [x] CSS styling and responsive design

### Sprint 3: Functionality ✓
- [x] Worksheet loading from JSON
- [x] Form submission and validation
- [x] Score calculation and display
- [x] Theme toggle (light/dark)
- [x] Progress tracking (LocalStorage)

### Sprint 4: Content (In Progress)
- [ ] Worksheet 001 - Subject Pronouns and Verb "To Be"
- [ ] Worksheet 002 - Present Simple
- [ ] ... (150 worksheets total)

### Sprint 5: Enhancements (Planned)
- [ ] User authentication
- [ ] Database integration
- [ ] Admin panel
- [ ] Analytics dashboard

---

## Installation

### Requirements

- PHP 7.4+
- Web server (Apache/Nginx)
- XAMPP or similar

### Setup

1. Clone or download the project to your web server directory:
   ```
   C:\xampp\htdocs\grammar-app\
   ```

2. Ensure the `data/worksheets/` folder is writable

3. Open in browser:
   ```
   http://localhost/grammar-app/public/
   ```

---

## Technologies Used

- **PHP 7.4+**: Server-side scripting
- **Bootstrap 5.3**: CSS framework
- **Font Awesome 6**: Icon library
- **JSON**: Data storage
- **LocalStorage**: Client-side progress

---

## Credits

- Based on "Grammar in Use" book series
- Designed for English learners worldwide
- Created with ❤️ for education

---

## License

MIT License - Feel free to use and modify for educational purposes.