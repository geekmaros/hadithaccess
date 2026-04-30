<?php
require_once __DIR__ . '/vendor/autoload.php';

use Geekmaros\HadithAccess\AppService\AppService;

$appService = new AppService();
$books = $appService->getHadithBooks();

//print_r($books);
//exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'components/headtag.php' ?>
</head>

<body class="min-h-screen relative">

<!-- ═══════════════════════════ HERO ═══════════════════════════ -->
<?php require 'components/header.php' ?>


<!-- ═══════════════════════════ MAIN ═══════════════════════════ -->
<main class="relative z-10 max-w-6xl mx-auto px-6 py-16">

    <!-- section label -->
    <div class="gold-rule mb-12">
        <span class="font-heading text-lg tracking-wide" style="color:var(--emerald); white-space:nowrap;">
            Hadith Collections
        </span>
    </div>

    <!-- cards grid -->
    <div class="cards-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($books['books'] as $index => $book): ?>
            <article class="book-card p-6 flex flex-col gap-5">
                <!-- corner accents -->
                <span class="corner corner-tl"></span>
                <span class="corner corner-br"></span>

                <!-- card header -->
                <div class="flex items-start justify-between gap-3">
                    <div class="book-index flex-shrink-0">
                        <?= $index + 1 ?>
                    </div>
                    <h3 class="font-display text-xl leading-snug flex-1 text-right" style="color:var(--emerald); font-size:1.2rem;">
                        <?= htmlspecialchars($book['bookName']) ?>
                    </h3>
                </div>

                <!-- author -->
                <div class="flex items-center gap-2" style="color:var(--muted);">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:var(--gold); flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                    </svg>
                    <span class="text-sm font-medium" style="color:var(--ink);">
                    <?= htmlspecialchars($book['writerName']) ?>
                </span>
                </div>

                <!-- divider -->
                <hr style="border-color:rgba(201,169,110,0.2); margin:0;">

                <!-- stats -->
                <div class="flex flex-wrap gap-2 mt-auto">
                <span class="stat-pill">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"/>
                    </svg>
                    <?= number_format($book['hadiths_count']) ?> Hadiths
                </span>
                    <span class="stat-pill">
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z"/>
                    </svg>
                    <?= number_format($book['chapters_count']) ?> Chapters
                </span>
                </div>

                <!-- CTA -->
                <a href="/books.php?slug=<?= htmlspecialchars($book['bookSlug'])?>" class="mt-2 w-full text-center text-sm font-medium py-2.5 rounded-sm transition-all duration-200"
                   style="background:var(--emerald); color:var(--gold-light); letter-spacing:0.05em; border: 1px solid transparent;"
                   onmouseover="this.style.background='transparent'; this.style.color='var(--emerald)'; this.style.borderColor='var(--emerald)';"
                   onmouseout="this.style.background='var(--emerald)'; this.style.color='var(--gold-light)'; this.style.borderColor='transparent';">
                    Browse Collection →
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</main>

<!-- ═══════════════════════════ FOOTER ═══════════════════════════ -->
<?= require 'components/footer.php'?>

</body>
</html>