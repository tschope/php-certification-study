# Bash Commands
- ddev start: Start the local development environment
- ddev stop: Stop the local environment
- ddev restart: Restart the environment
- ddev composer install: Install PHP dependencies
- ddev composer update: Update PHP dependencies
- ddev artisan migrate: Run database migrations
- ddev npm install: Install frontend dependencies
- ddev nuxt: Run the Nuxt 3 development server

# Core System
- Backend: Laravel 12 application in the project root
- Frontend: Nuxt 3 application in `frontend/`
- Local environment managed with DDEV
- Always prefix artisan and composer commands with `ddev` (never `php`)

# Important Packages
- Laravel Sanctum: Authentication
- Spatie Permissions: Role & Permission management
- Spatie Query Builder: API query handling
- Spatie PDF to Image: PDF handling
- Spatie Activitylog: Audit logs

# Frontend Code
- Framework: Nuxt 3 (Vue 3 + PrimeVue 4)
- API layer: `vue-api-query` with models in `frontend/models/`
- CRUD examples:

  ```js
  // create
  const model = new Model({ foo: 'bar' })
  await model.save()

  // read
  const model = await Model.find(1)

  // update
  const model = await Model.find(1)
  model.foo = 'bar'
  await model.save()

  // delete
  const model = await Model.find(1)
  await model.delete()
  ```

# Code Style
- Use ES modules (`import/export`), not CommonJS (`require`)
- Destructure imports when possible (eg. `import { Button } from 'primevue/button'`)
- Keep comments and documentation in **English**

# Workflow
- Run `ddev npm install` before starting the frontend for the first time
- Run `ddev artisan migrate` after backend schema changes
- Typecheck and lint before committing
- Prefer running targeted tests over full suite for speed
- Keep backend (Laravel) and frontend (Nuxt) in sync regarding API models
