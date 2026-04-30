<?php

?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hadith-Access</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Cormorant+Garamond:wght@300;400;500;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --emerald:   #1b4d3e;
            --emerald-light: #2a6b55;
            --gold:      #c9a96e;
            --gold-light: #e2c98a;
            --parchment: #f8f3ea;
            --ink:       #1c1917;
            --muted:     #6b7280;
        }

        body {
            background-color: var(--parchment);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
        }

        /* Geometric SVG tile background */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            opacity: 0.04;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80'%3E%3Cpath d='M40 0 L80 20 L80 60 L40 80 L0 60 L0 20 Z' fill='none' stroke='%231b4d3e' stroke-width='1'/%3E%3Cpath d='M40 10 L70 25 L70 55 L40 70 L10 55 L10 25 Z' fill='none' stroke='%231b4d3e' stroke-width='0.5'/%3E%3Cpath d='M40 20 L60 30 L60 50 L40 60 L20 50 L20 30 Z' fill='none' stroke='%231b4d3e' stroke-width='0.5'/%3E%3C/svg%3E");
            pointer-events: none;
        }

        .font-display  { font-family: 'Amiri', serif; }
        .font-heading  { font-family: 'Cormorant Garamond', serif; }

        /* ── Hero ── */
        .hero {
            background: linear-gradient(160deg, var(--emerald) 0%, #0f2d23 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0; right: 0;
            height: 60px;
            background: var(--parchment);
            clip-path: ellipse(55% 100% at 50% 100%);
        }
        .hero-ornament {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(201,169,110,0.2);
            pointer-events: none;
        }

        /* ── Gold divider ── */
        .gold-rule {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--gold);
        }
        .gold-rule::before,
        .gold-rule::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
        }

        /* ── Cards ── */
        .book-card {
            background: #fff;
            border: 1px solid rgba(201,169,110,0.25);
            border-radius: 2px;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .book-card::before {
            content: '';
            position: absolute;
            top: 6px; left: 6px;
            right: -6px; bottom: -6px;
            border: 1px solid rgba(201,169,110,0.15);
            border-radius: 2px;
            pointer-events: none;
            transition: transform 0.3s ease;
        }
        .book-card:hover {
            transform: translate(-2px, -2px);
            box-shadow: 8px 8px 24px rgba(27,77,62,0.12);
        }
        .book-card:hover::before {
            transform: translate(3px, 3px);
        }
        .book-card .corner {
            position: absolute;
            width: 18px; height: 18px;
        }
        .book-card .corner-tl { top: -1px;  left: -1px;  border-top: 2px solid var(--gold); border-left: 2px solid var(--gold); }
        .book-card .corner-br { bottom: -1px; right: -1px; border-bottom: 2px solid var(--gold); border-right: 2px solid var(--gold); }

        .stat-pill {
            background: var(--parchment);
            border: 1px solid rgba(201,169,110,0.3);
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--emerald);
            padding: 4px 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .stat-pill svg { color: var(--gold); }

        /* badge on top of card */
        .book-index {
            background: var(--emerald);
            color: var(--gold-light);
            font-family: 'Amiri', serif;
            font-size: 0.9rem;
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── Animate in ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fadeUp 0.6s ease both; }
        .anim-1 { animation-delay: 0.05s; }
        .anim-2 { animation-delay: 0.12s; }
        .anim-3 { animation-delay: 0.20s; }

        .cards-grid > * { animation: fadeUp 0.5s ease both; }
        .cards-grid > *:nth-child(1)  { animation-delay: 0.10s; }
        .cards-grid > *:nth-child(2)  { animation-delay: 0.17s; }
        .cards-grid > *:nth-child(3)  { animation-delay: 0.24s; }
        .cards-grid > *:nth-child(4)  { animation-delay: 0.31s; }
        .cards-grid > *:nth-child(5)  { animation-delay: 0.38s; }
        .cards-grid > *:nth-child(6)  { animation-delay: 0.45s; }
        .cards-grid > *:nth-child(7)  { animation-delay: 0.52s; }
        .cards-grid > *:nth-child(8)  { animation-delay: 0.59s; }
        .cards-grid > *:nth-child(9)  { animation-delay: 0.66s; }
    </style>

