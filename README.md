### Seeds: Kickoff distribution for SMEs


[![Latest Stable Version](https://poser.pugx.org/sprintive/seeds/v/stable)](https://packagist.org/packages/sprintive/seeds) [![Total Downloads](https://poser.pugx.org/sprintive/seeds/downloads)](https://packagist.org/packages/sprintive/seeds) [![Latest Unstable Version](https://poser.pugx.org/sprintive/seeds/v/unstable)](https://packagist.org/packages/sprintive/seeds) [![License](https://poser.pugx.org/sprintive/seeds/license)](https://packagist.org/packages/sprintive/seeds) [![composer.lock](https://poser.pugx.org/sprintive/seeds/composerlock)](https://packagist.org/packages/sprintive/seeds)

[![Seeds](https://www.drupal.org/files/sseds%20drupal%20starter%20kit.png)](https://www.drupal.org/project/seeds)

Light distribution to kick off all projects regardless scale, you can use it to speed up your projects.


## Pre-packaged Feature Modules

Seeds includes a curated set of modules organized into functional bundles to enhance site building, administration, performance, and content experience:

- **Seeds Dashboard**: A control panel to help site administrators manage key features easily.  
- **Seeds Security**: Installs and configures essential security modules.  
- **Seeds SEO**: Adds modules and settings to optimize your site's visibility in search engines.  
- **Seeds Performance**: Integrates performance-related modules to boost speed and caching.  
- **Seeds Media**: Improves media management and the file uploading experience.  
- **Seeds Editor**: Pre-configured CKEditor setups tailored for various content needs.  
- **Seeds Administration**: Installs tools for smoother site building and backend management.  
- **Seeds Helper**: Adds handy tools and developer utilities to streamline your workflow.  
- **Seeds Layout**: Enhances the Layout Builder with extended features and flexibility.  
- **Seeds Widgets**: Provides ready-made content blocks for a richer content authoring experience.  
- **Seeds Pollination**: Enriches the Drupal core with extended user and editorial capabilities.
- **Seeds UI**: Provides a modern, responsive, and customizable Drupal theme based on best practices. Seeds UI includes a flexible grid system, RFS-based typography, utility mixins, and a robust component library to accelerate front-end development and ensure a consistent user experience.

# Seeds UI Developer Guide

## Migration from Seeds Coat

**Important**: Seeds UI is replacing Seeds Coat in the Seeds distribution. 

- **Seeds UI** is now the default theme in Seeds distro
- **Seeds Coat** has been removed from the distribution
- **If you want to continue using Seeds Coat**, you must download it separately

## External Library Integration

Seeds UI automatically loads default styles from an external library:

```json
"dependencies": {
  "seeds_ui": "git+ssh://git@github.com:sprintive/seeds_ui#1.x"
}
```

This external package provides:
- **Default styling system** - Base styles and components
- **Grid system** - Bootstrap-compatible layout system  
- **Responsive mixins** - Breakpoint and utility mixins
- **Typography system** - RFS responsive font sizing

When you run `npm install`, this external library is automatically installed in `node_modules/seeds_ui/` and provides the foundation styles that your subtheme extends.

## Creating a Subtheme

### Quick Setup with Automated Script

```bash
cd /path/to/drupal/themes/contrib/seeds_ui
bash scripts/create_subtheme.sh
```

**Follow prompts for**:
- Machine name: `my_custom_theme`
- Display name: `My Custom Theme` 
- Destination: `/path/to/drupal/themes/custom`

**Script handles**:
- ✅ File copying and renaming
- ✅ Configuration updates
- ✅ npm install and build
- ✅ Drush theme enable

### Subtheme File Structure

After creation, your subtheme will have:

```
my_custom_theme/
├── scss/
│   ├── style.scss          # Main SASS entry
│   ├── _base.scss          # Variables and mixins
│   ├── _variables.scss     # Custom variables
│   ├── _mixin.scss         # Available mixins
│   ├── _elements.scss      # Element styling
│   ├── _blocks.scss        # Block styling
│   ├── _layout.scss        # Layout styling
│   └── _overrides.scss     # Override base theme
├── css/
│   └── style.css           # Compiled CSS
├── js/
│   └── custom.js           # Custom JavaScript
└── config/                 # Theme configurations
```

---

## Styling with SASS

### SASS File Organization

Seeds UI imports default styles from the external library:

```scss
// Main SASS entry point imports external library
@import "../node_modules/seeds_ui/scss/style.scss";
```

In your subtheme, organize SASS files as follows:

```scss
// scss/style.scss - Main entry point
@use "base" as *;      // Variables and mixins
@use "elements";       // HTML elements  
@use "blocks";         // Drupal blocks
@use "layout";         // Layout styling
@use "overrides";      // Base theme overrides
```

### Variables Configuration

Define custom variables in `scss/_variables.scss`:

```scss
// Color palette
$primary-color: #4f4f4d;
$secondary-color: #007bff;
$white: #fff;
$black: #000;

// Typography
$font-family-base: 'Helvetica Neue', sans-serif;
$font-size-base: 1rem;
$line-height-base: 1.5;

// Spacing
$spacer: 1rem;
$border-radius: 0.375rem;

// Breakpoints
$grid-breakpoint-xs: 0;
$grid-breakpoint-sm: 576px;
$grid-breakpoint-md: 768px;
$grid-breakpoint-lg: 992px;
$grid-breakpoint-xl: 1200px;
```

### Build Commands

```bash
# Development with watching
npm run watch

# Production build
npm run css

# Individual steps
npm run css-compile     # SASS → CSS
npm run css-prefix      # Add vendor prefixes  
npm run css-rtl         # Generate RTL versions
npm run css-minify      # Minify for production
```

---

## Enabling RTL Styling

RTL (Right-to-Left) support is automatically handled by Seeds UI's build system.

### Automatic RTL Generation

When you run `npm run css`, the system:

1. **Compiles your SASS** to standard CSS
2. **Processes with RTLCss** to flip directional properties
3. **Generates RTL versions** with `.rtl.css` suffix
4. **Creates minified versions** for production

### RTL Output Files

```
dist/css/
├── style.css           # LTR development
├── style.min.css       # LTR production
├── style.rtl.css       # RTL development  
├── style.rtl.min.css   # RTL production
```

### RTL-Specific Styling

For manual RTL adjustments, use direction-specific properties:

```scss
.my-component {
  margin-left: 1rem;     // Auto-flipped to margin-right in RTL
  
  // Manual RTL override
  [dir="rtl"] & {
    margin-left: 0;
    margin-right: 2rem;  // Custom RTL spacing
  }
}
```

### Testing RTL

1. **Enable RTL language** in Drupal (Arabic, Hebrew)
2. **RTL stylesheets auto-load** based on language direction
3. **Test components** in both LTR and RTL modes
4. **Adjust as needed** using direction-specific selectors

---

## Available SASS Mixins

### Subtheme Mixins (`scss/_mixin.scss`)

- **`@include image-shadow()`** - Adds shadow overlay to images
- **`@include equal-height()`** - Creates equal height flex containers
- **`@include inline-form($gutter, $break)`** - Inline form layouts
- **`@include form($gutter, $min-width)`** - Multi-column forms
- **`@include fontawesome($content, $pseudo)`** - FontAwesome icons
- **`@include responsive-image-blazy($lg, $md, $sm)`** - Aspect ratio for responsive images
- **`%center`** - Absolute center positioning
- **`%absolute-full`** - Full absolute positioning
- **`%blazy-image`** - Blazy image setup

### Core Mixins (`node_modules/seeds_ui/scss/mixins/`)

#### Responsive Breakpoints
- **`@include media-breakpoint-min($breakpoint)`** - Min-width media queries
- **`@include media-breakpoint-max($breakpoint)`** - Max-width media queries  
- **`@include media-breakpoint-between($lower, $upper)`** - Between breakpoints
- **`@include media-breakpoint-only($breakpoint)`** - Single breakpoint only

Available breakpoints: `xs` (0px), `sm` (576px), `md` (768px), `lg` (992px), `xl` (1200px), `xxl` (1400px)

#### Grid System
- **`@include make-row($gutter)`** - Custom grid rows
- **`@include make-col($size)`** - Custom grid columns
- **`@include make-col-auto()`** - Auto-width columns
- **`@include make-col-offset($size)`** - Column offsets
- **`@include row-cols($count)`** - Equal-width children

#### Layout & Styling
- **`@include make-container($gutter)`** - Custom containers
- **`@include border-radius($radius)`** - Border radius
- **`@include border-top-radius($radius)`** - Top border radius
- **`@include border-bottom-radius($radius)`** - Bottom border radius
- **`@include img-fluid()`** - Responsive images (max-width: 100%)
- **`@include reset-text()`** - Reset text styling

---

## Responsive Font Sizes (RFS)

Seeds UI uses **RFS (Responsive Font Size)** for fluid typography that scales with viewport size.

### RFS Mixins

- **`@include font-size($size)`** - Responsive font sizing that scales down on smaller screens
- **`@include rfs($value, $property: font-size)`** - Advanced RFS with custom property

### Configuration Variables

- **`$rfs-minimum-font-size`** - Minimum font size (default: 1rem)
- **`$rfs-factor`** - Scaling factor (default: 10)
- **`$rfs-breakpoint`** - Breakpoint for scaling (default: 1200px)
- **`$rfs-two-dimensional`** - Enable height-based scaling (default: false) 

## Disable bootstrap container in certian content types
Go to `/admin/structure/types`, Click edit on a content type. You will be met with various settings. At the bottom, you will see `Container settings`, Navigate there and enable `Fluid container` to disable the bootstrap container.

## Override blazy loader
Go to `/admin/config/seeds_media`. You will see blazy settings.  Check the `Override blazy loader?` then set the background image and color to something you like, hit save and flush the cache, you should see the loader takes a different appearence.
## Set default medias
We also provide a neat feature, you can set some default medias to not allow accidental edits by the client. Simply, go edit any media, you will see at the bottom a checkbox, `Default media`, check it and save, now only users with `Bypass Default Media Access` permission can edit the media.
---


#### Sponsored and developed by:

[![Sprintive](https://www.drupal.org/files/styles/grid-3/public/drupal_4.png?itok=FXajfgGW)](http://sprintive.com)

Sprintive is a web solution provider which transform ideas into realities, where humans are the center of everything, and Drupal is the heart of our actions, it has built and delivered Drupal projects focusing on a deep understanding of business goals and objective to help companies innovate and grow.
