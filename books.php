<?php
require_once __DIR__ . '/vendor/autoload.php';

use Geekmaros\HadithAccess\AppService\AppService;

$appService = new AppService();

$bookSlug = $_GET['slug'] ?? '';
$bookData = $appService->getHadithBook($bookSlug);


$book     = $bookData['book']     ?? [];
$chapters = $bookData['chapters'] ?? [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'components/headtag.php' ?>
    <?php require 'components/bookstyle.php' ?>

</head>

<body>

<!-- ═══════════════ HERO ═══════════════ -->
<header class="hero">
    <span class="hero-ring" style="width:500px;height:500px;"></span>
    <span class="hero-ring" style="width:320px;height:320px;"></span>

    <!-- back link -->
    <div class="anim d1" style="margin-bottom:1.8rem; position:relative; z-index:2;">
        <a href="index.php" class="back-link">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
            </svg>
            All Collections
        </a>
    </div>

    <!-- bismillah -->
    <p class="font-display anim d1" style="color:var(--gold-light);opacity:0.7;font-size:1.6rem;margin-bottom:0.5rem;position:relative;z-index:2;">﷽</p>

    <!-- book title -->
    <h1 class="font-display anim d2"
        style="text-transform: capitalize  ;font-size:clamp(2rem,5vw,3.2rem);color:#fff;line-height:1.15;max-width:700px;margin:0 auto;position:relative;z-index:2;">
        <?= htmlspecialchars($bookSlug ?? 'Hadith Book') ?>
    </h1>

    <!-- author -->
    <p class="anim d3" style="margin-top:0.8rem;color:rgba(248,243,234,0.6);font-size:0.9rem;letter-spacing:0.04em;position:relative;z-index:2;">
        <?= htmlspecialchars($book['writerName'] ?? '') ?>
    </p>
</header>


<!-- ═══════════════ MAIN ═══════════════ -->
<main class="relative z-10 max-w-4xl mx-auto px-6">

    <!-- ── Meta band (overlaps hero) ── -->
    <div class="meta-band">
        <div class="meta-stat">
            <span class="meta-stat-value"><?= number_format($book['chapters_count'] ?? count($chapters)) ?></span>
            <span class="meta-stat-label">Chapters</span>
        </div>
        <div class="meta-divider" style="display:none" id="divider-search"></div>
        <!-- Search -->
        <div class="search-wrap" style="flex:1;min-width:200px;max-width:320px;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/>
            </svg>
            <input
                id="chapter-search"
                class="search-input"
                type="text"
                placeholder="Search chapters…"
                oninput="filterChapters(this.value)"
                autocomplete="off"
            >
        </div>
    </div>

    <!-- ── Section heading ── -->
    <div class="gold-rule mb-8">
        <span class="font-heading" style="color:var(--emerald);font-size:1.1rem;white-space:nowrap;letter-spacing:0.04em;">
            Chapters
        </span>
    </div>

    <!-- ── Chapter list ── -->
    <?php if (!empty($chapters)): ?>
        <ul class="chapter-list" id="chapter-list">
            <?php foreach ($chapters as $chapter): ?>
                <li>
                    <a class="chapter-item"
                       href="chapter.php?slug=<?= urlencode($bookSlug) ?>&chapter=<?= urlencode($chapter['chapterNumber'] ?? '') ?>">

                        <!-- number column -->
                        <div class="chapter-num">
                            <span class="chapter-num-label">No.</span>
                            <span class="chapter-num-value"><?= htmlspecialchars($chapter['chapterNumber']  ?? '—') ?></span>
                        </div>

                        <!-- body -->
                        <div class="chapter-body">
                    <span class="chapter-title">
                        <?= htmlspecialchars($chapter['chapterEnglish'] ?? 'Untitled Chapter') ?> |
                        <?= htmlspecialchars($chapter['chapterArabic'] ?? 'Untitled Chapter') ?>
                    </span>
                            <div class="chapter-meta">
                                <?php if (!empty($chapter['hadiths_count'])): ?>
                                    <span class="hadith-badge"><?= number_format($chapter['hadiths_count']) ?> hadiths</span>
                                <?php endif; ?>
                                <svg class="chapter-arrow" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- no results message -->
        <div class="no-results" id="no-results">
            <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 0.75rem;color:var(--gold);opacity:0.6">
                <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="m21 21-4.35-4.35"/>
            </svg>
            <p class="font-heading" style="font-size:1.2rem;color:var(--emerald);">No chapters found</p>
            <p style="font-size:0.85rem;margin-top:4px;">Try a different search term</p>
        </div>

    <?php else: ?>
        <div style="text-align:center;padding:4rem 1rem;color:var(--muted);">
            <p class="font-heading" style="font-size:1.4rem;color:var(--emerald);">No chapters available</p>
            <p style="margin-top:0.5rem;font-size:0.88rem;">This book has no chapter data yet.</p>
        </div>
    <?php endif; ?>

    <div style="height:4rem;"></div>
</main>


<!-- ═══════════════════════════ FOOTER ═══════════════════════════ -->
<?= require 'components/footer.php'?>



<script>
    function filterChapters(query) {
        const items  = document.querySelectorAll('#chapter-list li');
        const noRes  = document.getElementById('no-results');
        const q      = query.trim().toLowerCase();
        let visible  = 0;

        items.forEach(li => {
            const title = li.querySelector('.chapter-title').textContent.toLowerCase();
            const num   = li.querySelector('.chapter-num-value').textContent.toLowerCase();
            const match = !q || title.includes(q) || num.includes(q);
            li.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        noRes.classList.toggle('visible', visible === 0 && q.length > 0);
    }
</script>

</body>
</html>