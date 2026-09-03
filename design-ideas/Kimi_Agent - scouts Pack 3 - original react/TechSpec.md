# Pack 3 Website - Technical Specification

## Component Inventory

### shadcn/ui Components (Built-in)
| Component | Purpose | Customization |
|-----------|---------|---------------|
| Button | CTAs, navigation actions | Custom colors, hover effects |
| Card | Activity cards, benefit cards | Custom shadows, borders |
| Sheet | Mobile navigation drawer | Slide from right |
| Dialog | Optional modals | - |
| Separator | Visual dividers | - |

### Third-Party Registry Components
| Component | Registry | Purpose |
|-----------|----------|---------|
| None required | - | Built-in components sufficient |

### Custom Components
| Component | Purpose | Props |
|-----------|---------|-------|
| Header | Fixed navigation | - |
| Hero | Landing section | - |
| QuickLinkCard | Image card with overlay | title, description, image, href, color |
| ActivityCard | Event display card | title, description, date, image |
| BenefitCard | Why Scouting item | icon, title, description |
| Footer | Site footer | - |
| ScrollReveal | Animation wrapper | children, delay, direction |

---

## Animation Implementation Table

| Animation | Library | Implementation Approach | Complexity |
|-----------|---------|------------------------|------------|
| Page load fade-in | Framer Motion | AnimatePresence + initial/animate | Low |
| Hero text stagger | Framer Motion | staggerChildren in parent | Medium |
| Emblem floating | CSS | @keyframes translateY | Low |
| Scroll reveal | Framer Motion | whileInView + viewport | Medium |
| Card hover lift | CSS/Tailwind | hover:translate-y + transition | Low |
| Image zoom on hover | CSS | hover:scale with overflow-hidden | Low |
| Arrow slide | CSS | group-hover:translate-x | Low |
| Nav underline | CSS | ::after pseudo-element animation | Low |
| Mobile menu slide | Framer Motion | AnimatePresence + x animation | Medium |
| Button pulse glow | CSS | @keyframes box-shadow | Low |
| Parallax background | Framer Motion | useScroll + useTransform | Medium |
| Staggered grid reveal | Framer Motion | staggerChildren + delayChildren | Medium |

---

## Animation Library Choices

### Primary: Framer Motion
- Best React integration
- Declarative API
- Built-in scroll detection (whileInView)
- AnimatePresence for mount/unmount
- Gesture support

### Secondary: CSS/Tailwind
- Simple hover effects
- Keyframe animations (floating, pulse)
- Performance-critical micro-interactions

---

## Project File Structure

```
app/
├── src/
│   ├── sections/
│   │   ├── Header.tsx
│   │   ├── Hero.tsx
│   │   ├── QuickLinks.tsx
│   │   ├── Welcome.tsx
│   │   ├── Activities.tsx
│   │   ├── ScoutOath.tsx
│   │   ├── WhyScouting.tsx
│   │   └── Footer.tsx
│   ├── components/
│   │   ├── ScrollReveal.tsx
│   │   ├── QuickLinkCard.tsx
│   │   ├── ActivityCard.tsx
│   │   └── BenefitCard.tsx
│   ├── hooks/
│   │   └── useScrollPosition.ts
│   ├── lib/
│   │   └── utils.ts
│   ├── App.tsx
│   ├── main.tsx
│   └── index.css
├── public/
│   └── images/
├── components/ui/    # shadcn components
├── tailwind.config.ts
└── package.json
```

---

## Dependencies

### Core (from init)
- React 18
- TypeScript
- Vite
- Tailwind CSS 3.4
- shadcn/ui components

### Animation
```bash
npm install framer-motion
```

### Icons
```bash
npm install lucide-react
```

### Fonts (Google Fonts via CDN)
- Montserrat (headings)
- Open Sans (body)
- Nunito (accents)

---

## Color Configuration (tailwind.config.ts)

```typescript
colors: {
  primary: {
    DEFAULT: '#1B5E20',
    light: '#2E7D32',
    dark: '#0D3B10',
  },
  secondary: {
    DEFAULT: '#FF6F00',
    light: '#FF8F00',
    dark: '#E65100',
  },
  background: '#FAFAF8',
  surface: '#FFFFFF',
}
```

---

## Performance Considerations

1. **Image Optimization**
   - Use WebP format where possible
   - Lazy load below-fold images
   - Proper sizing for responsive images

2. **Animation Performance**
   - Use transform and opacity only
   - Add will-change sparingly
   - Respect prefers-reduced-motion

3. **Code Splitting**
   - Sections can be lazy loaded if needed
   - Keep initial bundle under 200KB

---

## Accessibility Checklist

- [ ] Color contrast 4.5:1 minimum
- [ ] Focus visible on all interactive elements
- [ ] Keyboard navigation works
- [ ] Alt text on all images
- [ ] Semantic HTML structure
- [ ] ARIA labels where needed
- [ ] Reduced motion support
