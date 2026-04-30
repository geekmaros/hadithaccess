<?php
?>
<header class="hero py-24 px-6 text-center relative z-10">

    <!-- decorative rings -->
    <span class="hero-ornament" style="width:420px;height:420px;top:50%;left:50%;transform:translate(-50%,-50%)"></span>
    <span class="hero-ornament" style="width:280px;height:280px;top:50%;left:50%;transform:translate(-50%,-50%)"></span>

    <!-- Arabic bismillah / ornament -->
    <p class="font-display text-2xl text-gold-light mb-3 anim anim-1" style="color:var(--gold-light); opacity:0.8; letter-spacing:0.05em;">
        ﷽
    </p>

    <h1 class="font-display text-5xl md:text-6xl font-bold anim anim-1" style="color:#fff; letter-spacing:0.02em;">
        Hadith Access
    </h1>

    <p class="mt-4 text-base md:text-lg max-w-lg mx-auto leading-relaxed anim anim-2"
       style="color:rgba(248,243,234,0.65); font-family:'DM Sans',sans-serif; font-weight:300;">
        A curated gateway to the authentic sayings and traditions of the Prophet ﷺ —
        browse renowned collections, explore chapters, and read verified narrations.
    </p>

    <!-- decorative gold rule inside hero -->
    <div class="gold-rule max-w-xs mx-auto mt-8 anim anim-3">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 0 L8.5 5.5 L14 7 L8.5 8.5 L7 14 L5.5 8.5 L0 7 L5.5 5.5 Z" fill="currentColor"/></svg>
        <span class="text-xs tracking-[0.2em] uppercase font-medium" style="color:var(--gold); font-family:'DM Sans',sans-serif;">
            <?= count($books['books']) ?> Collections
        </span>
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 0 L8.5 5.5 L14 7 L8.5 8.5 L7 14 L5.5 8.5 L0 7 L5.5 5.5 Z" fill="currentColor"/></svg>
    </div>
</header>
