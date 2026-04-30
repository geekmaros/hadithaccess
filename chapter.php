<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

use Geekmaros\HadithAccess\AppService\AppService;

$appService = new AppService();

$bookSlug  = $_GET['slug']    ?? '';
$chapterNo = $_GET['chapter'] ?? '';
$page      = (int) ($_GET['page'] ?? 1);

$hadithData = $appService->getHadithChapter($bookSlug, $chapterNo, $page);

$pagination = $hadithData['hadiths']         ?? [];
$hadiths    = $hadithData['hadiths']['data'] ?? [];

// Book & chapter info lives inside each hadith row
$book    = $hadiths[0]['book']    ?? [];
$chapter = $hadiths[0]['chapter'] ?? [];

// Pagination
$currentPage  = (int) ($pagination['current_page'] ?? 1);
$lastPage     = (int) ($pagination['last_page']    ?? 1);
$totalHadiths = (int) ($pagination['total']        ?? count($hadiths));
$perPage      = (int) ($pagination['per_page']     ?? 25);
$prevPage     = $currentPage > 1          ? $currentPage - 1 : null;
$nextPage     = $currentPage < $lastPage  ? $currentPage + 1 : null;

function gradeClass(string $s): string {
    $s = strtolower(trim($s));
    if (str_contains($s, 'sahih'))  return 'grade-sahih';
    if (str_contains($s, 'hasan'))  return 'grade-hasan';
    if (str_contains($s, "da'if") || str_contains($s, 'daif') || str_contains($s, 'weak')) return 'grade-daif';
    return 'grade-other';
}

function pageUrl(string $slug, string $ch, int $p): string {
    return 'chapter.php?slug=' . urlencode($slug) . '&chapter=' . urlencode($ch) . '&page=' . $p;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'components/headtag.php' ?>
    <?php require 'components/chapterstyle.php' ?>

</head>

<body>

<!-- ══════════════════ HERO ══════════════════ -->
<header class="hero">
    <span class="hero-ring" style="width:500px;height:500px;"></span>
    <span class="hero-ring" style="width:300px;height:300px;"></span>

    <nav class="breadcrumb anim d1">
        <a href="index.php">All Collections</a>
        <span style="opacity:.3;">›</span>
        <a href="book.php?slug=<?= urlencode($bookSlug) ?>"><?= htmlspecialchars($book['bookName'] ?? 'Book') ?></a>
        <span style="opacity:.3;">›</span>
        <span style="color:rgba(248,243,234,0.75);">Chapter <?= htmlspecialchars($chapter['chapterNumber'] ?? $chapterNo) ?></span>
    </nav>

    <p class="font-display anim d1" style="color:var(--gold-light);opacity:0.7;font-size:1.6rem;margin-bottom:0.5rem;position:relative;z-index:2;">﷽</p>
    <h1 class="font-display anim d2" style="font-size:clamp(1.6rem,4vw,2.6rem);color:#fff;line-height:1.2;max-width:680px;margin:0 auto;position:relative;z-index:2;">
        <?= htmlspecialchars($book['bookName'] ?? 'Hadith Book') ?>
    </h1>
    <p class="anim d3" style="margin-top:0.6rem;color:rgba(248,243,234,0.55);font-size:0.85rem;position:relative;z-index:2;">
        <?= htmlspecialchars($book['writerName'] ?? '') ?>
    </p>
</header>


<!-- ══════════════════ MAIN ══════════════════ -->
<main style="position:relative;z-index:10;max-width:780px;margin:0 auto;padding:0 1.5rem;">

    <!-- Chapter band -->
    <div class="chapter-band">
        <p class="chapter-band-label">Chapter <?= htmlspecialchars($chapter['chapterNumber'] ?? $chapterNo) ?></p>
        <?php if (!empty($chapter['chapterEnglish'])): ?>
            <p class="chapter-band-english"><?= htmlspecialchars($chapter['chapterEnglish']) ?></p>
        <?php endif; ?>
        <?php if (!empty($chapter['chapterArabic'])): ?>
            <p class="chapter-band-arabic"><?= htmlspecialchars($chapter['chapterArabic']) ?></p>
        <?php endif; ?>
        <div class="chapter-band-meta">
            <span>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                </svg>
                <?= number_format($totalHadiths) ?> hadiths total
            </span>
            <span>
                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                </svg>
                Page <?= $currentPage ?> of <?= $lastPage ?>
            </span>
        </div>
    </div>

    <!-- Section label -->
    <div class="gold-rule" style="margin-bottom:2rem;">
        <span class="font-heading" style="color:var(--emerald);font-size:1.1rem;white-space:nowrap;letter-spacing:0.04em;">Hadiths</span>
    </div>

    <!-- Hadith cards -->
    <?php if (!empty($hadiths)):
        foreach ($hadiths as $hadith):
            $hadithNum   = $hadith['hadithNumber']    ?? '';
            $arabicText  = $hadith['hadithArabic']    ?? '';
            $englishText = $hadith['hadithEnglish']   ?? '';
            $narrator    = $hadith['englishNarrator'] ?? '';
            $status      = $hadith['status']          ?? '';
            $headingEn   = trim($hadith['headingEnglish'] ?? '');
            $headingAr   = trim($hadith['headingArabic']  ?? '');
            $reference   = ($book['bookName'] ?? '') . ($hadithNum ? ', Hadith ' . $hadithNum : '');
            ?>

            <?php if ($headingEn || $headingAr): ?>
            <div class="section-heading">
                <?php if ($headingEn): ?><p class="section-heading-en"><?= htmlspecialchars($headingEn) ?></p><?php endif; ?>
                <?php if ($headingAr): ?><p class="section-heading-ar"><?= htmlspecialchars($headingAr) ?></p><?php endif; ?>
            </div>
        <?php endif; ?>

            <article class="hadith-card">
                <div class="hadith-header">
                    <div class="hadith-ref">
                        <div class="hadith-num-badge"><?= $hadithNum ?></div>
                        <div>
                            <div class="hadith-ref-label">Hadith No.</div>
                            <div class="hadith-ref-value"><?= htmlspecialchars((string)$hadithNum) ?></div>
                        </div>
                    </div>
                    <?php if ($status): ?>
                        <span class="grade-pill <?= gradeClass($status) ?>">
                <svg width="7" height="7" viewBox="0 0 8 8" fill="currentColor"><circle cx="4" cy="4" r="4"/></svg>
                <?= htmlspecialchars($status) ?>
            </span>
                    <?php endif; ?>
                </div>

                <div class="hadith-body">
                    <?php if ($arabicText): ?>
                        <div class="arabic-block">
                            <p class="arabic-text"><?= htmlspecialchars($arabicText) ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($narrator): ?>
                        <p class="narrator-line"><?= htmlspecialchars($narrator) ?></p>
                    <?php endif; ?>

                    <?php if ($englishText): ?>
                        <p class="english-body"><?= nl2br(htmlspecialchars($englishText)) ?></p>
                    <?php endif; ?>
                </div>

                <div class="hadith-footer">
                    <span class="hadith-footer-ref"><?= htmlspecialchars($reference) ?></span>
                    <button class="copy-btn"
                            onclick="copyHadith(this, <?= htmlspecialchars(json_encode($englishText)) ?>, <?= htmlspecialchars(json_encode($reference)) ?>)">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184"/>
                        </svg>
                        Copy
                    </button>
                </div>
            </article>

        <?php endforeach; else: ?>
        <div style="text-align:center;padding:4rem 1rem;color:var(--muted);">
            <p class="font-heading" style="font-size:1.4rem;color:var(--emerald);">No hadiths found</p>
            <p style="margin-top:6px;font-size:0.88rem;">This chapter has no hadith data yet.</p>
        </div>
    <?php endif; ?>

    <!-- ── Pagination ── -->
    <?php if ($lastPage > 1): ?>
        <p class="page-info">
            Showing <?= number_format((($currentPage - 1) * $perPage) + 1) ?>–<?= number_format(min($currentPage * $perPage, $totalHadiths)) ?>
            of <?= number_format($totalHadiths) ?> hadiths
        </p>
        <nav class="pagination" aria-label="Pages">

            <!-- Prev -->
            <?php if ($prevPage): ?>
                <a class="page-btn" href="<?= pageUrl($bookSlug, $chapterNo, $prevPage) ?>" aria-label="Previous">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
                </a>
            <?php else: ?>
                <span class="page-btn disabled" aria-disabled="true">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/></svg>
        </span>
            <?php endif; ?>

            <!-- Page window -->
            <?php
            $w = 2; $s = max(1, $currentPage - $w); $e = min($lastPage, $currentPage + $w);
            if ($s > 1) { echo '<a class="page-btn" href="' . pageUrl($bookSlug, $chapterNo, 1) . '">1</a>'; }
            if ($s > 2) { echo '<span class="page-ellipsis">…</span>'; }
            for ($p = $s; $p <= $e; $p++) {
                $cls = ($p === $currentPage) ? ' active' : '';
                echo '<a class="page-btn' . $cls . '" href="' . pageUrl($bookSlug, $chapterNo, $p) . '">' . $p . '</a>';
            }
            if ($e < $lastPage - 1) { echo '<span class="page-ellipsis">…</span>'; }
            if ($e < $lastPage)     { echo '<a class="page-btn" href="' . pageUrl($bookSlug, $chapterNo, $lastPage) . '">' . $lastPage . '</a>'; }
            ?>

            <!-- Next -->
            <?php if ($nextPage): ?>
                <a class="page-btn" href="<?= pageUrl($bookSlug, $chapterNo, $nextPage) ?>" aria-label="Next">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
                </a>
            <?php else: ?>
                <span class="page-btn disabled" aria-disabled="true">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/></svg>
        </span>
            <?php endif; ?>
        </nav>
    <?php endif; ?>

</main>


<!-- ═══════════════════════════ FOOTER ═══════════════════════════ -->
<?= require 'components/footer.php'?>

<script>
    function copyHadith(btn, text, ref) {
        navigator.clipboard.writeText(text + '\n\n— ' + ref).then(() => {
            btn.classList.add('copied');
            btn.innerHTML = `<svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg> Copied!`;
            setTimeout(() => {
                btn.classList.remove('copied');
                btn.innerHTML = `<svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184"/></svg> Copy`;
            }, 2000);
        });
    }
</script>

</body>
</html>