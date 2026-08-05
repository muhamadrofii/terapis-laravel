---
name: Serene Path
colors:
  surface: '#f9f9fb'
  surface-dim: '#d9dadc'
  surface-bright: '#f9f9fb'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3f5'
  surface-container: '#eeeef0'
  surface-container-high: '#e8e8ea'
  surface-container-highest: '#e2e2e4'
  on-surface: '#1a1c1d'
  on-surface-variant: '#4a4453'
  inverse-surface: '#2f3132'
  inverse-on-surface: '#f0f0f2'
  outline: '#7b7484'
  outline-variant: '#ccc3d5'
  surface-tint: '#6f43c0'
  primary: '#4f1c9e'
  on-primary: '#ffffff'
  primary-container: '#673ab7'
  on-primary-container: '#d8c2ff'
  inverse-primary: '#d3bbff'
  secondary: '#715478'
  on-secondary: '#ffffff'
  secondary-container: '#f8d4fe'
  on-secondary-container: '#75597c'
  tertiary: '#004742'
  on-tertiary: '#ffffff'
  tertiary-container: '#00615a'
  on-tertiary-container: '#76ddd2'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ebddff'
  primary-fixed-dim: '#d3bbff'
  on-primary-fixed: '#250059'
  on-primary-fixed-variant: '#5727a6'
  secondary-fixed: '#fad7ff'
  secondary-fixed-dim: '#debbe4'
  on-secondary-fixed: '#291231'
  on-secondary-fixed-variant: '#583d5f'
  tertiary-fixed: '#8ef4e9'
  tertiary-fixed-dim: '#71d7cd'
  on-tertiary-fixed: '#00201d'
  on-tertiary-fixed-variant: '#00504a'
  background: '#f9f9fb'
  on-background: '#1a1c1d'
  surface-variant: '#e2e2e4'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
  title-md:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '500'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: 0.1px
  caption:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '400'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  unit: 4px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 40px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
---

## Brand & Style

The design system is centered on psychological safety, professional reliability, and emotional tranquility. The target audience includes individuals seeking mental health support, ranging from high-stress professionals to young adults. 

The aesthetic follows a **Modern Corporate** style with a **Minimalist** lean. It prioritizes clarity and breathability to reduce cognitive load for users who may be in a state of distress. High-quality whitespace, soft transitions, and a lack of aggressive visual stimulants ensure the interface feels like a supportive environment rather than a cold clinical tool.

## Colors

The palette utilizes **Deep Purple** as the primary anchor to convey wisdom and professional depth. **Soft Lavender** serves as the secondary color, used for large surface areas and background washes to soften the UI. **Healing Teal** acts as a gentle accent for growth-oriented actions and highlights.

- **Primary:** Use for main actions, active states, and branding elements.
- **Secondary:** Use for subtle containers, background layering, and non-critical progress indicators.
- **Tertiary (Accent):** Reserved for "healing" moments, such as successful session completions or wellness milestones.
- **Neutrals:** A range of cool grays and off-whites maintain a clean, clinical (yet warm) foundation.

## Typography

The design system employs **Inter** for all roles to leverage its exceptional legibility and neutral, trustworthy character. 

- **Headlines:** Use semi-bold weights with slight negative letter-spacing to create a grounded, authoritative presence.
- **Body Text:** Use regular weights with generous line-heights (1.5x+) to ensure long-form therapeutic content is easy to digest.
- **Labels:** Use medium weights for interactive elements like buttons and navigation items to distinguish them from static text.

## Layout & Spacing

This design system uses a **Fluid Grid** model based on an 8px spacing rhythm. 

- **Desktop:** 12-column grid with 24px gutters and 64px side margins. Max-content width is capped at 1280px to prevent excessive line lengths.
- **Tablet:** 8-column grid with 24px gutters and 32px side margins.
- **Mobile:** 4-column grid with 16px gutters and 16px margins. 

Vertical spacing should be generous. Use `xl` (40px) spacing between major sections to provide visual "breathing room," reflecting the calming nature of the service.

## Elevation & Depth

Visual hierarchy is achieved through **Tonal Layering** and **Ambient Shadows**. 

1. **Level 0 (Canvas):** The base background uses white or the neutral "Surface" tint.
2. **Level 1 (Cards/Containers):** Raised slightly with a very soft, diffused shadow (0px 4px 20px rgba(103, 58, 183, 0.08)). This uses a hint of the primary color in the shadow to maintain the purple theme.
3. **Level 2 (Overlays/Modals):** Higher elevation with a more pronounced shadow (0px 12px 32px rgba(0, 0, 0, 0.12)) and a subtle 1px border using the "Secondary" lavender color to define edges.

Avoid harsh black shadows; always tint shadows with a fraction of the primary Deep Purple to maintain a soft, cohesive look.

## Shapes

The shape language is consistently **Rounded**, avoiding sharp corners that can feel aggressive or clinical. 

- **Standard Elements:** (Inputs, Small Buttons) use a 0.5rem (8px) radius.
- **Large Elements:** (Cards, Modals) use a 1rem (16px) radius.
- **Chips/Badges:** Use a fully rounded "pill" shape to denote status or categories.

This curvature promotes a sense of friendliness and approachability throughout the patient journey.

## Components

### Buttons
- **Primary:** Solid Deep Purple background with White text. High-contrast and clear.
- **Secondary:** Soft Lavender background with Deep Purple text. Used for "Cancel" or "Back" actions.
- **Ghost:** No background, Deep Purple border and text. Used for tertiary actions.

### Input Fields
- Use a light neutral fill (#F5F5F7) and an 8px corner radius.
- The active state should feature a 2px Deep Purple border and a soft glow.
- Error states use a 1px Red border with caption text below the field.

### Cards
- Therapy session cards should include a profile image, name (Headline-sm), and a clear "Join Session" primary button. 
- Use Level 1 elevation for a tactile feel.

### Status Indicators
- **Success:** Healing Teal background with white text (for badges) or green text on light green tint.
- **Waiting/Pending:** Soft Lavender background with Deep Purple text.
- **Urgent/Error:** Solid Red for critical alerts, used sparingly.

### Additional Components
- **Mood Tracker:** Circular or "squishy" tactile buttons representing different emotional states.
- **Progress Stepper:** Thin Teal lines connecting circular nodes to show the journey through a treatment plan.