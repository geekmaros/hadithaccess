<style>
    :root {
        --emerald:       #1b4d3e;
        --emerald-light: #2a6b55;
        --emerald-dim:   rgba(27,77,62,0.06);
        --gold:          #c9a96e;
        --gold-light:    #e2c98a;
        --parchment:     #f8f3ea;
        --ink:           #1c1917;
        --muted:         #78716c;
        --border:        rgba(201,169,110,0.22);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        background-color: var(--parchment);
        color: var(--ink);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
    }

    /* tiled geometric background */
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
        padding: 5rem 1.5rem 7rem;
        text-align: center;
    }
    .hero::after {
        content: '';
        position: absolute;
        bottom: -1px; left: 0; right: 0;
        height: 60px;
        background: var(--parchment);
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .hero-ring {
        position: absolute;
        border-radius: 50%;
        border: 1px solid rgba(201,169,110,0.15);
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    /* ── Back link ── */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.78rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: rgba(248,243,234,0.55);
        text-decoration: none;
        transition: color 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .back-link:hover { color: var(--gold-light); }

    /* ── Gold rule ── */
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

    /* ── Book meta banner (overlaps hero bottom) ── */
    .meta-band {
        position: relative;
        z-index: 20;
        margin-top: -40px;
        max-width: 860px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 3rem;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 4px;
        padding: 1.5rem 2rem;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 1.2rem;
        box-shadow: 0 8px 32px rgba(27,77,62,0.10);
    }
    .meta-band::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 4px; height: 100%;
        background: linear-gradient(to bottom, var(--gold), var(--emerald));
        border-radius: 4px 0 0 4px;
    }
    .meta-stat {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 2px;
    }
    .meta-stat-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 600;
        color: var(--emerald);
        line-height: 1;
    }
    .meta-stat-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: var(--muted);
    }
    .meta-divider {
        width: 1px;
        height: 40px;
        background: var(--border);
    }

    /* ── Search bar ── */
    .search-wrap {
        position: relative;
        max-width: 400px;
    }
    .search-wrap svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        pointer-events: none;
    }
    .search-input {
        width: 100%;
        padding: 0.6rem 1rem 0.6rem 2.6rem;
        border: 1px solid var(--border);
        border-radius: 2px;
        background: var(--parchment);
        font-family: 'DM Sans', sans-serif;
        font-size: 0.88rem;
        color: var(--ink);
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .search-input::placeholder { color: var(--muted); }
    .search-input:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 3px rgba(201,169,110,0.12);
    }

    /* ── Chapter list ── */
    .chapter-list { list-style: none; }

    .chapter-item {
        display: flex;
        align-items: stretch;
        gap: 0;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 10px;
        text-decoration: none;
        color: inherit;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s;
        animation: fadeUp 0.45s ease both;
    }
    .chapter-item:hover {
        transform: translateX(4px);
        box-shadow: -4px 0 0 var(--gold), 4px 4px 20px rgba(27,77,62,0.09);
        border-color: rgba(201,169,110,0.5);
    }

    .chapter-num {
        flex-shrink: 0;
        width: 58px;
        background: var(--emerald-dim);
        border-right: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1px;
        padding: 1rem 0.5rem;
    }
    .chapter-num-label {
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--muted);
    }
    .chapter-num-value {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--emerald);
        line-height: 1;
    }

    .chapter-body {
        flex: 1;
        padding: 0.9rem 1.2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
    }

    .chapter-title {
        font-family: 'Amiri', serif;
        font-size: 1.05rem;
        color: var(--ink);
        line-height: 1.35;
    }

    .chapter-meta {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .hadith-badge {
        background: var(--parchment);
        border: 1px solid var(--border);
        border-radius: 999px;
        padding: 3px 10px;
        font-size: 0.72rem;
        font-weight: 500;
        color: var(--emerald);
        white-space: nowrap;
    }
    .chapter-arrow {
        color: var(--gold);
        opacity: 0;
        transform: translateX(-4px);
        transition: opacity 0.2s, transform 0.2s;
    }
    .chapter-item:hover .chapter-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    /* ── No results ── */
    .no-results {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--muted);
        display: none;
    }
    .no-results.visible { display: block; }

    /* ── Animations ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim { animation: fadeUp 0.5s ease both; }
    .d1 { animation-delay: 0.05s; }
    .d2 { animation-delay: 0.12s; }
    .d3 { animation-delay: 0.20s; }

    /* stagger chapter rows */
    <?php foreach ($chapters as $i => $ch): ?>
    .chapter-list li:nth-child(<?= $i + 1 ?>) { animation-delay: <?= round(0.05 + $i * 0.04, 2) ?>s; }
    <?php endforeach; ?>

    /* ── Footer ── */
    footer { position: relative; z-index: 10; }
</style>