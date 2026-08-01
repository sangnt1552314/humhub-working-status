# Working Status

A HumHub module that lets users set a current working status (e.g. Free, Busy, Away) and shows it across the network.

## Features

- **Admin-managed status types** — create, edit, delete, color, and order status types under **Administration → Modules → Working Status → Configure**.
- **Set your status** — a **Working Status** entry in the account (avatar) menu opens a modal to pick a status and add an optional note.
- **Profile display** — a user's current status (color, name, note) is shown on their profile sidebar. Owners get a quick **Change status** action.
- **Presence tinting** — online presence dots on avatars are tinted with the user's working status color (users without a status keep the default green).

## Requirements

- HumHub `1.14+`

## Installation

1. Copy this folder to `modules-custom/working-status` in your HumHub data directory.
2. Go to **Administration → Modules**, find **Working Status**, and click **Enable**.
   The database migration runs automatically and seeds three default types (Free, Busy, Away).

## Usage

- **Set / change status:** click your avatar (top right) → **Working Status**, choose a status, optionally add a note, and save.
- **View status:** open any user's profile; the status appears in the sidebar.
- **Manage types (admin):** **Administration → Modules → Working Status → Configure**.

## Structure

| Path | Purpose |
|------|---------|
| `config.php` | Module registration and event wiring |
| `Module.php` | Main module class |
| `Events.php` | Account-menu entry, profile widget, asset registration |
| `controllers/ConfigController.php` | Admin CRUD for status types |
| `controllers/StatusController.php` | User status form + presence color endpoint |
| `models/` | `WorkingStatusType`, `WorkingStatusUser` |
| `services/WorkingStatusService.php` | Shared queries |
| `widgets/` | Profile sidebar widget, admin config menu |
| `views/` | Admin and user views |
| `assets/`, `resources/js/` | Presence-dot tinting script |
| `migrations/` | Database schema + seed data |

## Database

- `working_status_type` — admin-defined status types (name, color, sort order, soft-delete flag).
- `working_status_user` — one current status per user (type + optional note).

## License

See [LICENSE](LICENSE).
