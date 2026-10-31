# PROJECT SPECIFICATION
# Car Dealership Website and Inventory Management System

## 1. Project Overview

Develop a modern, professional, responsive car dealership website with a secure owner administration dashboard.

The platform must allow customers to view dealership inventory, search for vehicles, view vehicle details, and contact the dealership.

The dealership owner must be able to manage inventory, vehicle photos, website content, inquiries, staff accounts, and business information through an administration dashboard.

The architecture must support a future Android application that communicates with the same Laravel backend using a secure REST API.

### Main Requirements

- Public customer-facing dealership website.
- Secure owner and staff login.
- Full vehicle inventory management.
- Vehicle status management.
- Customer inquiry management.
- Website content management.
- Responsive design for desktop, tablet, and mobile.
- Reporting and activity history.
- REST API for future Android applications.
- Secure deployment on GoDaddy Web Hosting (cPanel).
- Automated, independent backups and documented recovery procedures.

Initially, the system will serve a single dealership. Structure the code to be reusable for other dealerships in the future without building unnecessary multi-tenant complexity now.

---

## 2. Technology Stack

### Backend

- Programming language: PHP 8.3 or newer.
- Framework: A stable, supported Laravel version compatible with the target hosting environment.
- Database: MySQL or supported MariaDB.
- Database ORM: Laravel Eloquent.
- Database schema management: Laravel migrations.
- Request validation: Laravel Form Requests.
- Authorization: Laravel policies and middleware.
- Web authentication: Laravel session-based authentication.
- Mobile API authentication: Laravel Sanctum.
- Background tasks: Laravel scheduler and database-backed jobs where supported.
- API format: JSON REST API.

### Frontend

- HTML5.
- CSS3.
- JavaScript.
- Laravel Blade templates.
- Tailwind CSS.
- Alpine.js for interactive functionality.
- Vite for building production CSS and JavaScript assets.
- Responsive, mobile-first design.

Avoid requiring a continuously running Node.js server in production. Build frontend assets locally before deployment.

### Development Tools

- Visual Studio Code or Codex-compatible development environment.
- Git and GitHub.
- Composer.
- Node.js and npm for frontend compilation.
- Local PHP development environment.
- MySQL database.
- Postman or equivalent for API testing.
- PHPUnit or Pest for automated testing.

### Future Android Application

- Kotlin.
- Jetpack Compose.
- Retrofit.
- OkHttp.
- Laravel Sanctum for secure API authentication.
- Android Keystore-backed secure credential storage.

The Android app must communicate with the Laravel API, never connect directly to MySQL.

---

## 3. Public Website — Pages and Features

### 3.1 Homepage

Design a premium, modern automotive homepage.

Include:

- Dealership logo and business name.
- Main navigation.
- Hero banner with attractive dealership or vehicle photography.
- Prominent vehicle search functionality.
- Search by make, model, year, and price.
- Featured vehicles.
- Recently added inventory.
- Browse by vehicle category.
- About the dealership section.
- Financing information.
- Customer reviews or testimonials.
- Contact section.
- Business hours and location.
- Professional footer.

Homepage content must be editable through the administration dashboard.

### 3.2 Inventory Page

Display all publicly available vehicles in a clean grid layout.

Each vehicle card must display:

- Main vehicle photo.
- Year.
- Make.
- Model.
- Trim.
- Asking price.
- Mileage.
- Transmission.
- Stock number.
- Vehicle status if applicable.
- View Details button.

Provide filters for:

- Make.
- Model.
- Minimum and maximum price.
- Minimum and maximum year.
- Mileage.
- Body type.
- Transmission.
- Fuel type.
- Drivetrain.
- Vehicle condition.

Sorting options:

- Newest added.
- Oldest added.
- Price: low to high.
- Price: high to low.
- Year: newest to oldest.
- Mileage: low to high.

Support database-backed pagination and combined filters.

Only authorized published vehicles should appear in the public inventory.

### 3.3 Vehicle Details Page

Every vehicle must have a dedicated, shareable URL.

Display:

**Vehicle identification**
- Stock number.
- VIN.
- Year.
- Make.
- Model.
- Trim.
- New or used condition.

**Specifications**
- Mileage.
- Exterior color.
- Interior color.
- Body style.
- Transmission.
- Engine.
- Fuel type.
- Drivetrain.
- Number of doors.
- Seating capacity where applicable.

**Pricing**
- Regular price.
- Optional promotional price.
- Price visibility setting.

**Photos**
- Multiple vehicle images.
- Main cover photo.
- Thumbnail gallery.
- Full-screen viewer.

**Additional information**
- Vehicle description.
- Features and equipment.
- Condition notes.
- Accident or title disclosures when provided and verified.

**Customer actions**
- Call dealership.
- Send inquiry.
- Schedule test drive.
- Share vehicle.
- View dealership address.

The customer should not need to create an account to browse vehicles.

### 3.4 About Us

Editable dealership information:

- Company background.
- History.
- Mission.
- Services.
- Team information if desired.
- Dealership photographs.

### 3.5 Financing

Provide a page containing:

- Financing introduction.
- General financing information.
- Financing inquiry form.
- Financing contact information.

Do not collect Social Security numbers, bank account credentials, or other highly sensitive financing information in the initial system.

If financing applications are needed later, integrate a specialized compliant provider.

### 3.6 Contact Us

Display:

- Business name.
- Phone number.
- Email address.
- Full address.
- Business hours.
- Google Maps link or embedded map.
- Contact form.
- Social media links.

All dealership contact information must be editable from the dashboard.

### 3.7 Website Design Requirements

Use a premium automotive design:

- Modern typography.
- Clean, spacious layouts.
- Professional neutral color palette.
- Configurable dealership accent color.
- High-quality automotive imagery.
- Rounded vehicle cards.
- Consistent buttons and form elements.
- Clear navigation.
- Responsive layouts.
- Accessible labels and keyboard navigation.
- Loading states, empty states, validation messages, and helpful error pages.

The website should load efficiently on mobile connections.

---

## 4. Administration Dashboard

Administrative URL:

`/admin`

Only authorized users can access administrative pages.

### Dashboard Overview

Display summary cards:

- Total inventory.
- Available vehicles.
- Pending-sale vehicles.
- Sold vehicles.
- Archived vehicles.
- New customer inquiries.
- Pending test-drive requests.

Also show:

- Recently added vehicles.
- Recent inventory updates.
- Recent sales.
- Latest customer inquiries.
- Activity notifications.

Provide useful quick actions:

- Add Vehicle.
- Manage Inventory.
- View Inquiries.
- Update Website Information.

Use real database queries rather than hardcoded dashboard statistics.

---

## 5. Vehicle Inventory Management

### 5.1 Vehicle Registration

Create a dedicated vehicle registration page with organized form sections.

**Section A — Basic Information**
- Internal stock number.
- VIN.
- Year.
- Make.
- Model.
- Trim.
- Vehicle condition.

Stock number must be unique.

VIN should be validated appropriately, with exceptions for older or nonstandard vehicles when necessary.

**Section B — Technical Specifications**
- Mileage.
- Transmission.
- Engine.
- Fuel type.
- Drivetrain.
- Body style.
- Exterior color.
- Interior color.
- Doors.
- Seats.

**Section C — Pricing**
- Asking price.
- Optional discounted price.
- Optional internal purchase cost.

Internal purchase cost must never be exposed to public APIs or pages.

**Section D — Vehicle Features**

Allow selection of features such as:

- Backup camera.
- Bluetooth.
- Navigation.
- Heated seats.
- Leather interior.
- Sunroof.
- Parking sensors.
- Cruise control.
- Apple CarPlay.
- Android Auto.

Support custom feature descriptions.

**Section E — Vehicle Condition**

- Condition description.
- Known defects.
- Accident history if verified.
- Title information.
- Additional disclosures.

**Section F — Photos**

Allow multiple image uploads.

Include:

- Image preview.
- Drag-and-drop reordering.
- Set primary image.
- Remove image.
- Automatic thumbnail creation.
- Automatic image optimization.
- Secure file validation.
- Configurable upload size and image count limits.

Only accept approved image formats. Decode and re-encode images when appropriate, remove unnecessary metadata, and generate unique server-side filenames.

**Section G — Publishing**

- Draft.
- Available.
- Pending Sale.
- Sold.
- Archived.
- Featured vehicle toggle.

Separate publication visibility from the vehicle's business status when necessary.

### 5.2 Manage Inventory Page

Create a searchable inventory table with:

- Thumbnail.
- Stock number.
- Year.
- Make.
- Model.
- VIN.
- Price.
- Mileage.
- Status.
- Date added.
- Actions.

Functions:

- Search by stock number, VIN, make, model, or year.
- Filter by status.
- Sort by table column.
- Edit vehicle.
- Duplicate vehicle as a new draft, with unique identifiers.
- Change status.
- Archive vehicle.
- Delete vehicle with authorization.
- Bulk archive.
- Bulk status operations where safe.
- Export inventory to CSV.

Use server-side pagination.

### 5.3 Vehicle Status Workflow

Supported statuses:

1. Draft — Not visible publicly.
2. Available — Listed in public inventory.
3. Pending Sale — Transaction in progress.
4. Sold — No longer available for purchase.
5. Archived — Retained privately.
6. Deleted — Soft-deleted record awaiting authorized permanent removal.

When marking a vehicle as sold:

- Save the sale date.
- Update the vehicle status.
- Remove it from available inventory.
- Disable new test-drive scheduling.
- Update dashboard statistics.
- Preserve the vehicle record.
- Preserve relevant historical inquiries.
- Log the action and performing user.

If a sale is canceled, authorized staff can return the vehicle to Available.

### 5.4 Old Vehicle Storage Management

The system must allow the owner to manage storage used by old vehicle records.

Features:

- List sold and archived vehicles.
- Filter by age and status.
- View how many photos each vehicle stores.
- Display estimated vehicle image storage.
- Allow bulk selection.
- Delete unneeded photos with explicit confirmation.
- Permanently delete eligible records only after a retention and dependency check.

Do not automatically destroy financial or legally required records.

Use soft deletion for ordinary vehicle removal.

Permanent deletion must be a separate privileged action.

When deleting photos, use Laravel storage abstractions so database references and actual files remain synchronized.

Provide a safe cleanup process for orphaned image files.

---

## 6. Customer Inquiry Management

When a visitor submits an inquiry, save:

- Inquiry ID.
- Vehicle ID when applicable.
- Customer name.
- Email.
- Phone number.
- Message.
- Inquiry type.
- Submission date.
- Status.
- Assigned staff member if applicable.

Inquiry statuses:

- New.
- Contacted.
- Follow-up.
- Closed.

Dashboard functions:

- View inquiries.
- Search and filter.
- View associated vehicle.
- Add internal notes.
- Update inquiry status.
- Assign staff.
- Record contact attempts.
- Receive new inquiry email notifications.

Use spam prevention, rate limiting, server-side validation, and suitable anti-abuse controls.

### Test-Drive Requests

Customers can submit:

- Name.
- Contact information.
- Vehicle.
- Preferred date and time.
- Notes.

The dealership can confirm, reschedule, or cancel appointments.

A requested date and time must not be treated as confirmed automatically.

---

## 7. Website Content Management

Create an administration section named **Website Management**.

The owner must be able to edit:

### General Information
- Dealership name.
- Logo.
- Phone numbers.
- Email address.
- Business address.
- Business hours.
- Social media URLs.

### Homepage
- Hero banner.
- Welcome heading.
- Welcome description.
- Homepage images.
- Featured vehicles.
- Promotional messages.

### About Us
- Business history.
- About Us description.
- Company photographs.

### Other
- Financing page content.
- Contact page details.
- SEO page titles.
- SEO descriptions.
- Footer information.

All modifications must be validated and authorized.

Do not allow arbitrary PHP, executable JavaScript, or unrestricted HTML injection through the content editor.

---

## 8. User Accounts and Permissions

### User Roles

**Owner / Super Administrator**
- Full authorized management access.
- Manage staff accounts.
- Manage all vehicles.
- Manage website content.
- Access reports.
- Manage system settings.

**Inventory Manager**
- Add vehicles.
- Edit vehicles.
- Upload photos.
- Change permitted vehicle statuses.
- View inventory.

**Sales Staff**
- View inventory.
- View and manage customer inquiries.
- Manage test-drive requests.
- Update permitted sales statuses.

Use Laravel policies for authorization.

Do not rely only on hiding frontend buttons to enforce permissions.

### Authentication Requirements

- Private administration login.
- No public staff registration.
- Owner-controlled staff account creation.
- Secure password hashing.
- Login rate limiting.
- Secure session cookies.
- Session regeneration after authentication.
- Logout and session invalidation.
- Password reset using secure, expiring tokens.
- Two-factor authentication for privileged users.
- Account deactivation.
- Login activity logging.
- Ability to revoke user access.

Use secure authentication components supported by the selected Laravel release.

---

## 9. Database Design

Use MySQL with Laravel migrations and appropriate indexes, unique constraints, and foreign keys.

Initial tables:

| Table | Purpose |
|---|---|
| users | Owner and staff accounts |
| roles / permissions | Role-based access |
| vehicles | Vehicle identification, specifications, pricing, status |
| vehicle_images | Vehicle photos, storage paths, ordering, primary image |
| vehicle_features | Available vehicle feature definitions |
| vehicle_feature | Vehicle-to-feature relationships |
| inquiries | Customer messages |
| inquiry_notes | Internal follow-up notes |
| test_drive_requests | Appointment requests |
| website_settings | Dealership configuration |
| website_content | Editable page content |
| activity_logs | Administrative actions |
| vehicle_status_history | Status changes, dates, performing users |
| personal_access_tokens | Mobile API authentication |

Include standard created_at and updated_at fields.

Use deleted_at for appropriate soft-deletable records.

Use database transactions when modifying multiple related records.

Create indexes for frequently used searches and filters.

Store vehicle images as files, not binary blobs inside MySQL.

Store only the file paths and metadata in the database.

Store pricing using decimal database types rather than floating-point values.

Use unique identifiers for publicly accessible records where appropriate.

---

## 10. REST API Architecture

Design the Laravel application so its inventory business logic can be reused by both the web dashboard and a future Android application.

Version API routes under:

`/api/v1/`

Example routes:

**Public endpoints**

- `GET /api/v1/vehicles`
- `GET /api/v1/vehicles/{id}`

Public endpoints must return only approved, published vehicle information.

**Authenticated administrative endpoints**

- `POST /api/v1/auth/login`
- `POST /api/v1/auth/logout`
- `GET /api/v1/me`
- `GET /api/v1/admin/vehicles`
- `POST /api/v1/admin/vehicles`
- `GET /api/v1/admin/vehicles/{id}`
- `PATCH /api/v1/admin/vehicles/{id}`
- `PATCH /api/v1/admin/vehicles/{id}/status`
- `POST /api/v1/admin/vehicles/{id}/images`
- `DELETE /api/v1/admin/vehicles/{id}/images/{imageId}`
- `GET /api/v1/admin/inquiries`
- `PATCH /api/v1/admin/inquiries/{id}`

Protect administrative endpoints with authentication, authorization, and rate limiting.

Use:

- JSON responses.
- Consistent error formats.
- Input validation.
- Pagination.
- API versioning.
- Appropriate HTTP status codes.
- HTTPS-only communication.
- Token expiration and revocation.
- Sanitized API output.

Use Laravel Sanctum for mobile token authentication.

Avoid implementing duplicate business logic in web controllers and API controllers. Centralize shared business operations in appropriate services or action classes.

---

## 11. Security Requirements

Security must be part of the initial implementation.

### Application Security

- Use prepared queries through Eloquent/query builder.
- Validate all user input.
- Escape untrusted output.
- Protect web forms against CSRF.
- Prevent stored and reflected XSS.
- Check authorization for every administrative action.
- Protect against insecure direct object references.
- Limit upload types and sizes.
- Prevent uploaded files from executing as scripts.
- Apply login and API rate limits.
- Protect against mass assignment.
- Avoid exposing unnecessary vehicle or user fields through APIs.
- Log important administrative actions.

### Server Security

- Use HTTPS with valid SSL certificates.
- Redirect HTTP traffic to HTTPS.
- Enable secure cookies.
- Disable debug mode in production.
- Store secrets in protected environment configuration.
- Keep secrets outside version control.
- Restrict database access.
- Use strong separate database credentials.
- Keep Laravel and dependencies updated.
- Disable directory listing.
- Protect server logs and backup files.
- Do not expose Laravel's application root publicly.
- Point the public web root to Laravel's public directory.

### Production Configuration

Use:

`APP_ENV=production`

`APP_DEBUG=false`

Set a unique production application encryption key.

Never commit the real production `.env` file or application secrets to GitHub.

---

## 12. Backup and Disaster Recovery

Backups must protect:

- Production MySQL database.
- Uploaded vehicle images.
- Website content.
- Application configuration required for recovery.
- Laravel encryption key and necessary secrets, stored separately and securely.

### Backup Strategy

**Layer 1 — GoDaddy Hosting Backup**

Use GoDaddy's available hosting backup service for quick recovery.

Confirm the actual retention period and restoration options under the purchased plan.

**Layer 2 — Independent Cloud Backup**

Create encrypted backups stored outside the GoDaddy hosting account.

Suggested schedule:

- MySQL database backup every 6 hours.
- Daily uploaded image backup.
- Daily retained snapshot for 30 days.
- Weekly snapshot retained for 8 weeks.
- Monthly snapshot retained for 6 months.

Storage must be private and encrypted.

Backups should use credentials and permissions independent from the website application.

Prefer immutable or deletion-protected backup storage where available.

**Layer 3 — Source Code Protection**

Use a private GitHub repository.

Commit all approved application changes.

Do not commit:

- Passwords.
- API tokens.
- Production `.env`.
- Private customer data.
- Production database exports.

### Backup Monitoring

Provide an internal backup status view showing:

- Most recent confirmed successful backup.
- Last backup failure.
- Backup type.
- Approximate size.
- Next planned backup.

Do not display a successful backup status unless a real backup process confirms completion.

Avoid storing backup credentials in a location accessible to ordinary dashboard users.

### Disaster Recovery Procedure

1. Contain the security incident.
2. Secure hosting and administrative accounts.
3. Preserve relevant evidence and logs.
4. Identify how the breach occurred.
5. Select a verified clean backup.
6. Rebuild the application from trusted source code.
7. Restore clean database and image files.
8. Rotate passwords, tokens, and compromised secrets.
9. Test inventory and administration functionality.
10. Reopen the website after security verification.
11. Evaluate any required customer or regulatory notifications.

Test the complete backup restoration procedure regularly in an isolated environment.

Do not assume that restoring a backup removes the original vulnerability.

---

## 13. GoDaddy cPanel Deployment Plan

The project will first be developed and tested locally.

Production hosting will use GoDaddy Web Hosting (cPanel), subject to confirming Laravel compatibility.

### Hosting Prerequisites

Before purchasing or deploying, verify:

- Compatible PHP version.
- Compatible MySQL or MariaDB version.
- Required Laravel PHP extensions.
- SSH availability.
- Composer support or an equivalent safe dependency deployment procedure.
- Ability to run Laravel Artisan commands.
- Cron job support.
- SSL certificate availability.
- Writable storage and cache directories.
- Correct document-root configuration.
- Adequate storage and resource limits.

If the selected GoDaddy plan cannot securely expose only Laravel's public directory or support the required runtime, do not use an insecure workaround. Choose a compatible hosting plan.

### Local Development

1. Install PHP, Composer, Node.js, and MySQL.
2. Create Laravel project.
3. Configure local `.env`.
4. Create the database.
5. Implement migrations and models.
6. Build public website.
7. Build owner dashboard.
8. Build REST API.
9. Add authentication and permissions.
10. Add automated tests.
11. Test file uploads.
12. Test backup and restore procedures.
13. Commit source code to private GitHub.

### Production Deployment

1. Purchase domain and suitable GoDaddy cPanel hosting.
2. Configure DNS.
3. Enable HTTPS.
4. Create production MySQL database and database user.
5. Deploy Laravel application files outside the public web directory.
6. Configure the domain to serve Laravel's public directory.
7. Install production PHP dependencies.
8. Build frontend assets locally and upload compiled assets.
9. Configure protected production environment variables.
10. Generate a unique application key once for the production installation and preserve it securely.
11. Set file and directory permissions.
12. Run production migrations.
13. Configure storage for public vehicle images.
14. Configure Laravel scheduler with supported cron jobs.
15. Configure transactional email.
16. Configure independent backups.
17. Perform security tests.
18. Confirm the website and admin dashboard work.
19. Test production backups and a sample restore.
20. Launch the website.

For subsequent deployments, preserve the existing production APP_KEY and database credentials unless deliberately rotating them.

Never overwrite the live inventory database with local development data during normal code deployments.

Use staging and database backups before risky migrations.

---

## 14. Performance and Search Engine Optimization

### Performance

- Optimize uploaded vehicle photographs.
- Generate appropriately sized thumbnails.
- Use lazy loading.
- Paginate inventory results.
- Add database indexes.
- Cache appropriate public website settings.
- Minimize unnecessary JavaScript.
- Compile and minify production assets.
- Avoid expensive unbounded queries.

### SEO

- Dedicated vehicle detail URLs.
- Configurable page titles and descriptions.
- Open Graph metadata.
- XML sitemap.
- robots.txt.
- Canonical URLs.
- Structured data where appropriate.
- Descriptive vehicle image alt text.
- Helpful 404 pages.
- Search engine handling for sold and archived vehicles.

Ensure all public inventory content can be indexed appropriately.

---

## 15. Future Android Management App

The Android app will be implemented after the website and API are stable.

The app will be intended for authorized dealership owners and staff.

### Mobile Features

- Secure login.
- Inventory dashboard.
- Browse vehicles.
- Add vehicles.
- Take photos using the phone camera.
- Upload multiple photos.
- Edit specifications and prices.
- Mark vehicles as Available, Pending, or Sold.
- Archive vehicles.
- View customer inquiries.
- Contact customers.
- View reports.
- Update permitted dealership information.

The app and website must use the same production database through Laravel.

Changes made through the mobile app should appear on the website after normal data refresh.

No independent synchronization database is necessary for the initial online-only version.

Add offline caching or synchronization only if it becomes a later requirement.

---

## 16. Reporting

Provide an administrative reporting section.

Initial reports:

- Total inventory.
- Available inventory.
- Sold vehicle count.
- Pending vehicles.
- Vehicle additions by date.
- Sold vehicles by date range.
- Customer inquiries by date range.
- Inventory age.
- Storage used by vehicle images.

Support filtering by:

- Today.
- This week.
- This month.
- Custom date range.

Allow CSV export where appropriate.

Do not expose internal purchase costs or sensitive customer information to unauthorized roles.

---

## 17. Testing Requirements

Create automated tests for:

- Authentication.
- Unauthorized admin access.
- Role permissions.
- Vehicle registration.
- Vehicle editing.
- Input validation.
- VIN and stock-number uniqueness.
- Vehicle status changes.
- Public inventory visibility.
- Image upload restrictions.
- Inquiry submission.
- API token authorization.
- Soft deletion.
- Database relationships.
- Backup job failure handling where applicable.

Also test manually on desktop, tablet, and mobile.

Check all forms, filters, sorting, pagination, image galleries, and responsive layouts.

---

## 18. Development Phases

### Phase 1 — Project Foundation

- Laravel installation.
- MySQL database setup.
- Git repository.
- Base layout.
- Authentication.
- Roles and permissions.
- Database migrations.

### Phase 2 — Public Website

- Homepage.
- Inventory page.
- Vehicle detail page.
- About Us.
- Financing information.
- Contact page.
- Responsive design.

### Phase 3 — Owner Dashboard

- Dashboard statistics.
- Vehicle registration.
- Vehicle editing.
- Photo management.
- Inventory filtering.
- Status management.
- Archive/delete workflow.

### Phase 4 — Business Management

- Customer inquiries.
- Test-drive requests.
- Website content management.
- Dealership business settings.
- Reporting.
- Activity logs.

### Phase 5 — Security and API

- Sanctum authentication.
- REST API.
- Secure endpoint permissions.
- Upload hardening.
- Authentication testing.
- Automated application tests.

### Phase 6 — Deployment and Protection

- GoDaddy cPanel deployment.
- SSL.
- Production database.
- Cron configuration.
- Email notifications.
- Backups.
- Recovery testing.
- Production security checks.

### Phase 7 — Future Android App

- Android application project.
- Kotlin and Jetpack Compose interface.
- API integration.
- Owner login.
- Inventory management.
- Vehicle photo uploads.
- Test and release.

---

## 19. Development Instructions for Codex

Implement this project incrementally.

Follow these rules:

1. Use the specified Laravel, PHP, MySQL, Blade, Tailwind CSS, and Alpine.js stack.
2. Maintain compatibility with conventional GoDaddy Linux cPanel hosting.
3. Do not use unnecessary microservices or runtime dependencies.
4. Organize application code into reusable, maintainable components.
5. Use Laravel migrations instead of manually modifying database schemas.
6. Use meaningful model relationships and authorization policies.
7. Do not hardcode dealership information into the public frontend.
8. Keep website settings editable through the admin dashboard.
9. Build mobile-ready business logic with REST API support.
10. Implement real functionality, not static-only dashboard demonstrations.
11. Make all screens responsive and visually consistent.
12. Use database transactions and error handling when appropriate.
13. Implement secure authentication and authorization from the beginning.
14. Preserve data integrity during updates and deletion.
15. Keep production secrets outside version control.
16. Provide setup instructions and an example `.env.example`.
17. Provide database seeders with fictional demo vehicles.
18. Provide automated tests for critical features.
19. Provide GoDaddy cPanel deployment documentation.
20. Provide backup and recovery instructions.

### Initial Codex Task

Start by examining the development environment and creating the Laravel project foundation.

Then:

- Define the directory structure.
- Configure MySQL.
- Create initial database migrations.
- Implement owner authentication.
- Create the base website layout.
- Create the dashboard layout.
- Implement the vehicle model and inventory workflow.
- Add realistic fictional demonstration data.
- Run automated tests.

Complete and verify each phase before proceeding to the next.

Use professional, production-oriented code that can be maintained and deployed to GoDaddy cPanel.

**End of specification.**