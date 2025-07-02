# Changelog
All notable changes to the RamarySelect project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Initial changelog creation for tracking future changes
- Rules file for development guidelines and standards

### Added
- Wine management system for admin users:
  - Database table for wines with brand, name, type, cask, and image storage
  - Admin interface to add new wines with image upload functionality
  - API endpoint to fetch wines from database
  - "Add New Wine" button visible only to admin users on homepage and navigation
  - Dynamic wine cards loading from database instead of hardcoded JavaScript array
- Enhanced wine form with two-column layout and real-time image preview functionality
- Optimized form sizing to fit within viewport without scrolling
- Responsive design with proper mobile adaptations
- Disabled page scrolling on add wine form for better UX
- Reorganized layout: moved image upload field to right column with preview
- Added comprehensive Events page showcasing event organization and sourcing services
- Updated navigation to include Events page in both desktop and mobile menus
- Updated contact page map to use actual Google Maps embed for RamarySelect's real location
- Improved contact page map proportions for better visual display
- Added secondary admin header below main navigation to reduce header clutter
- Created mobile-responsive admin navigation panel for better UX
- Added wine collection upload feature for admins with PDF brochure support
- Created database schema for wine collections with image and PDF storage
- Updated collections page to dynamically load from database instead of hardcoded content
- Added "Add Collection" link to admin navigation with document icon

### Changed
- Hero section title styling: "Ramary" now displays in primary blue color, "Select" in thin font weight with space between words
- Wine cards section now loads content dynamically from database
- Updated JavaScript to fetch wines via API instead of static data

### Fixed
- Missing subscriptions table for newsletter functionality (to be implemented)

### Security
- Review default admin credentials (change required for production)

### Technical Debt
- Need to standardize CSS component organization
- Consider implementing automated deployment scripts
- Add comprehensive error handling and logging system

## [1.0.0] - Current State (Analysis Complete)

### Features Present
- ✅ User authentication system with role-based access
- ✅ Blog management system with admin interface
- ✅ Newsletter subscription functionality (frontend)
- ✅ Responsive design with mobile navigation
- ✅ Contact forms with location mapping
- ✅ Product collections showcase
- ✅ Security headers and input sanitization
- ✅ SEO-friendly URL structure via .htaccess

### Database Schema
- ✅ Users and roles management
- ✅ Blog posts with author relationships
- ❌ Subscriptions table (missing - required for newsletter)

### Architecture
- ✅ Component-based CSS architecture
- ✅ Modular PHP includes system
- ✅ Organized asset management
- ✅ Proper separation of concerns

---

## Future Sections (Template)

### [Version] - Date

#### Added
- New features or functionality

#### Changed
- Changes in existing functionality

#### Deprecated
- Soon-to-be removed features

#### Removed
- Removed features

#### Fixed
- Bug fixes

#### Security
- Security-related improvements

#### Technical
- Infrastructure, performance, or technical improvements

---

## Development Guidelines

When making changes:
1. Update this changelog with every modification
2. Follow semantic versioning for releases
3. Include clear descriptions of changes
4. Note any breaking changes prominently
5. Reference relevant issue numbers where applicable 