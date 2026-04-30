<style>
    :root {
        --emerald:        #1b4d3e;
        --emerald-light:  #2a6b55;
        --emerald-dim:    rgba(27,77,62,0.05);
        --gold:           #c9a96e;
        --gold-light:     #e2c98a;
        --parchment:      #f8f3ea;
        --parchment-dark: #f0e9d8;
        --ink:            #1c1917;
        --muted:          #78716c;
        --border:         rgba(201,169,110,0.22);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        background-color: var(--parchment);
        color: var(--ink);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
    }
    body::before {
        content: ''; position: fixed; inset: 0; z-index: 0; opacity: 0.04;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80'%3E%3Cpath d='M40 0 L80 20 L80 60 L40 80 L0 60 L0 20 Z' fill='none' stroke='%231b4d3e' stroke-width='1'/%3E%3Cpath d='M40 10 L70 25 L70 55 L40 70 L10 55 L10 25 Z' fill='none' stroke='%231b4d3e' stroke-width='0.5'/%3E%3C/svg%3E");
        pointer-events: none;
    }
    .font-display { font-family: 'Amiri', serif; }
    .font-heading { font-family: 'Cormorant Garamond', serif; }

    /* ── Hero ── */
    .hero {
        background: linear-gradient(160deg, var(--emerald) 0%, #0f2d23 100%);
        position: relative; overflow: hidden;
        padding: 4rem 1.5rem 6rem; text-align: center;
    }
    .hero::after {
        content: ''; position: absolute; bottom: -1px; left: 0; right: 0; height: 60px;
        background: var(--parchment); clip-path: ellipse(55% 100% at 50% 100%);
    }
    .hero-ring {
        position: absolute; border-radius: 50%;
        border: 1px solid rgba(201,169,110,0.12);
        top: 50%; left: 50%; transform: translate(-50%,-50%);
        pointer-events: none;
    }

    /* ── Breadcrumb ── */
    .breadcrumb {
        display: flex; align-items: center; gap: 8px;
        justify-content: center; flex-wrap: wrap;
        font-size: 0.78rem; color: rgba(248,243,234,0.45);
        margin-bottom: 1.6rem; position: relative; z-index: 2;
    }
    .breadcrumb a { color: rgba(248,243,234,0.55); text-decoration: none; transition: color 0.2s; }
    .breadcrumb a:hover { color: var(--gold-light); }

    /* ── Gold rule ── */
    .gold-rule { display: flex; align-items: center; gap: 12px; color: var(--gold); }
    .gold-rule::before, .gold-rule::after {
        content: ''; flex: 1; height: 1px;
        background: linear-gradient(to right, transparent, var(--gold), transparent);
    }

    /* ── Chapter info band ── */
    .chapter-band {
        position: relative; z-index: 20;
        margin-top: -38px; max-width: 780px;
        margin-left: auto; margin-right: auto; margin-bottom: 3rem;
        background: #fff; border: 1px solid var(--border); border-radius: 4px;
        padding: 1.4rem 1.8rem;
        box-shadow: 0 8px 32px rgba(27,77,62,0.10); text-align: center;
    }
    .chapter-band::before {
        content: ''; position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background: linear-gradient(to bottom, var(--gold), var(--emerald));
        border-radius: 4px 0 0 4px;
    }
    .chapter-band-label   { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.14em; color: var(--muted); margin-bottom: 4px; }
    .chapter-band-english { font-family: 'Cormorant Garamond', serif; font-size: 1.3rem; color: var(--emerald); font-weight: 500; }
    .chapter-band-arabic  { font-family: 'Amiri', serif; font-size: 1.25rem; color: var(--ink); direction: rtl; margin-top: 4px; opacity: 0.75; }
    .chapter-band-meta {
        margin-top: 10px; display: flex; align-items: center;
        justify-content: center; gap: 16px; font-size: 0.75rem; color: var(--muted);
    }
    .chapter-band-meta span { display: flex; align-items: center; gap: 5px; }
    .chapter-band-meta svg  { color: var(--gold); }

    /* ── Section heading (headingEnglish dividers) ── */
    .section-heading {
        margin: 2.5rem 0 1.2rem; padding: 1rem 1.4rem;
        background: linear-gradient(135deg, var(--emerald), var(--emerald-light));
        border-radius: 3px; position: relative; overflow: hidden;
    }
    .section-heading::after {
        content: '❖'; position: absolute; right: 1.2rem; top: 50%; transform: translateY(-50%);
        color: var(--gold); opacity: 0.35; font-size: 1.1rem;
    }
    .section-heading-en { font-family: 'Cormorant Garamond', serif; font-size: 1.05rem; font-weight: 500; color: var(--gold-light); line-height: 1.35; }
    .section-heading-ar { font-family: 'Amiri', serif; font-size: 1rem; color: rgba(255,255,255,0.55); direction: rtl; margin-top: 4px; }

    /* ── Hadith card ── */
    .hadith-card {
        background: #fff; border: 1px solid var(--border); border-radius: 4px;
        margin-bottom: 1.5rem; overflow: hidden;
        box-shadow: 0 2px 10px rgba(27,77,62,0.05);
        animation: fadeUp 0.45s ease both;
        transition: box-shadow 0.3s;
    }
    .hadith-card:hover { box-shadow: 0 6px 28px rgba(27,77,62,0.10); }

    .hadith-header {
        background: var(--emerald-dim); border-bottom: 1px solid var(--border);
        padding: 0.7rem 1.4rem; display: flex; align-items: center;
        justify-content: space-between; gap: 1rem; flex-wrap: wrap;
    }
    .hadith-ref { display: flex; align-items: center; gap: 10px; }
    .hadith-num-badge {
        background: var(--emerald); color: var(--gold-light);
        font-family: 'Cormorant Garamond', serif; font-size: 0.9rem; font-weight: 600;
        width: 34px; height: 34px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .hadith-ref-label { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--muted); line-height: 1; }
    .hadith-ref-value { font-family: 'Cormorant Garamond', serif; font-size: 0.9rem; color: var(--emerald); font-weight: 500; }

    .grade-pill {
        display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px;
        border-radius: 999px; font-size: 0.7rem; font-weight: 500; letter-spacing: 0.05em;
    }
    .grade-sahih { background:#dcfce7; color:#15803d; border:1px solid #86efac; }
    .grade-hasan { background:#fef9c3; color:#854d0e; border:1px solid #fde047; }
    .grade-daif  { background:#fee2e2; color:#b91c1c; border:1px solid #fca5a5; }
    .grade-other { background:var(--parchment); color:var(--muted); border:1px solid var(--border); }

    .hadith-body { padding: 1.5rem 1.6rem 0; }

    .arabic-block {
        background: var(--parchment-dark); border: 1px solid var(--border);
        border-radius: 3px; padding: 1.2rem 1.6rem; margin-bottom: 1.2rem;
        text-align: right; direction: rtl; position: relative;
    }
    .arabic-block::before {
        content: '"'; position: absolute; top: -2px; right: 10px;
        font-family: 'Amiri', serif; font-size: 3.5rem;
        color: var(--gold); opacity: 0.18; line-height: 1; pointer-events: none;
    }
    .arabic-text { font-family: 'Amiri', serif; font-size: 1.45rem; line-height: 2.1; color: var(--ink); }

    .narrator-line {
        font-size: 0.84rem; font-style: italic; color: var(--muted);
        margin-bottom: 0.8rem; padding-left: 10px;
        border-left: 2px solid var(--gold);
    }
    .english-body { font-size: 0.975rem; line-height: 1.9; color: var(--ink); }

    .hadith-footer {
        padding: 0.85rem 1.6rem; margin-top: 1.2rem; border-top: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;
    }
    .hadith-footer-ref { font-size: 0.7rem; color: var(--muted); letter-spacing: 0.04em; }
    .copy-btn {
        display: inline-flex; align-items: center; gap: 6px; font-size: 0.75rem;
        color: var(--emerald); background: none; border: 1px solid var(--border);
        border-radius: 2px; padding: 4px 12px; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: background 0.2s, border-color 0.2s;
    }
    .copy-btn:hover  { background: var(--emerald-dim); border-color: var(--gold); }
    .copy-btn.copied { color: #15803d; border-color: #86efac; background: #dcfce7; }

    /* ── Pagination ── */
    .page-info { font-size: 0.78rem; color: var(--muted); text-align: center; margin-bottom: 0.75rem; }
    .pagination {
        display: flex; align-items: center; justify-content: center;
        gap: 5px; flex-wrap: wrap; margin: 0.5rem 0 4rem;
    }
    .page-btn {
        min-width: 38px; height: 38px; padding: 0 10px;
        display: inline-flex; align-items: center; justify-content: center;
        border: 1px solid var(--border); border-radius: 2px; font-size: 0.82rem;
        color: var(--emerald); background: #fff; text-decoration: none;
        transition: all 0.2s; font-family: 'DM Sans', sans-serif;
    }
    .page-btn:hover   { background: var(--emerald-dim); border-color: var(--gold); }
    .page-btn.active  { background: var(--emerald); color: var(--gold-light); border-color: var(--emerald); font-weight: 600; }
    .page-btn.disabled { opacity: 0.35; pointer-events: none; }
    .page-ellipsis    { font-size: 0.82rem; color: var(--muted); padding: 0 4px; display: flex; align-items: center; }

    /* ── Animations ── */
    @keyframes fadeUp { from { opacity:0; transform:translateY(18px); } to { opacity:1; transform:translateY(0); } }
    .anim { animation: fadeUp 0.5s ease both; }
    .d1 { animation-delay: 0.05s; }
    .d2 { animation-delay: 0.12s; }
    .d3 { animation-delay: 0.20s; }
    <?php foreach ($hadiths as $i => $_): ?>
    .hadith-card:nth-child(<?= $i + 1 ?>) { animation-delay: <?= round(0.06 + $i * 0.05, 2) ?>s; }
    <?php endforeach; ?>
</style>