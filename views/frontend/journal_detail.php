<?php
/**
 * Journal Detail View - รายละเอียดวารสารโรงเรียน
 * Premium design with image gallery, sharing, and related articles
 */

// Helper functions
function journal_detail_thai_date($dateStr) {
    if (empty($dateStr)) return '-';
    $months = ['', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
               'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
    $time = strtotime($dateStr);
    if ($time === false) return '-';
    $day = date('j', $time);
    $month = $months[(int)date('n', $time)];
    $year = date('Y', $time) + 543;
    return "{$day} {$month} {$year}";
}

function journal_detail_short_date($dateStr) {
    if (empty($dateStr)) return '-';
    $months = ['', 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    $time = strtotime($dateStr);
    if ($time === false) return '-';
    return date('j', $time) . ' ' . $months[(int)date('n', $time)] . ' ' . (date('Y', $time) + 543);
}

$date = journal_detail_thai_date($journal['news_date'] ?? $journal['created_at'] ?? null);
$views = (int)($journal['view_count'] ?? 0) + 1; // +1 for current view
$teacherName = $journal['teacher_name'] ?? '-';
$images = $journal['full_image_urls'] ?? [];
?>

<!-- Hero Section -->
<section class="relative overflow-hidden py-12 md:py-16 bg-gradient-to-br from-amber-600 via-orange-500 to-red-500">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-yellow-300/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-5xl mx-auto px-4 relative z-10">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex flex-wrap items-center gap-1.5 md:gap-2 text-xs md:text-sm text-white/70">
                <li><a href="<?php echo BASE_URL; ?>" class="hover:text-white transition-colors flex items-center gap-1"><i class="fas fa-home"></i> <span class="hidden sm:inline">หน้าหลัก</span></a></li>
                <li><i class="fas fa-chevron-right text-[10px] md:text-xs"></i></li>
                <li><a href="<?php echo BASE_URL; ?>journal" class="hover:text-white transition-colors"><?php echo __('school_journal'); ?></a></li>
                <li><i class="fas fa-chevron-right text-[10px] md:text-xs"></i></li>
                <li class="text-white font-medium truncate max-w-[200px] md:max-w-xs"><?php echo htmlspecialchars($journal['title'] ?? ''); ?></li>
            </ol>
        </nav>

        <div class="flex flex-col lg:flex-row items-start lg:items-center gap-4 md:gap-6">
            <div class="flex-shrink-0 hidden md:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-white/20 rounded-full blur-xl animate-pulse"></div>
                    <div class="relative w-20 h-20 md:w-24 md:h-24 flex items-center justify-center bg-white/20 backdrop-blur rounded-full">
                        <span class="text-4xl md:text-5xl">📰</span>
                    </div>
                </div>
            </div>
            <div class="text-white flex-1">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/20 backdrop-blur-sm text-xs md:text-sm font-medium mb-3">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    วารสารโรงเรียน
                </div>
                <h1 class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-bold leading-tight break-words">
                    <?php echo htmlspecialchars($journal['title'] ?? 'ไม่มีชื่อ'); ?>
                </h1>
            </div>
        </div>
    </div>
</section>

<!-- Meta Stats Cards -->
<section class="max-w-5xl mx-auto px-4 -mt-6 relative z-20 mb-6">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4">
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl p-3 md:p-4 border border-white/50 dark:border-slate-700/50 shadow-lg border-l-4 border-l-indigo-500 hover:shadow-xl transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl text-lg md:text-xl group-hover:scale-110 transition-transform">
                    <i class="fas fa-user"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400">โดย</p>
                    <p class="text-sm md:text-base font-bold text-gray-900 dark:text-white truncate"><?php echo htmlspecialchars($teacherName); ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl p-3 md:p-4 border border-white/50 dark:border-slate-700/50 shadow-lg border-l-4 border-l-amber-500 hover:shadow-xl transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-xl text-lg md:text-xl group-hover:scale-110 transition-transform">
                    <i class="far fa-calendar-alt"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400">วันที่</p>
                    <p class="text-sm md:text-base font-bold text-gray-900 dark:text-white"><?php echo $date; ?></p>
                </div>
            </div>
        </div>
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl p-3 md:p-4 border border-white/50 dark:border-slate-700/50 shadow-lg border-l-4 border-l-purple-500 hover:shadow-xl transition-all group">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-xl text-lg md:text-xl group-hover:scale-110 transition-transform">
                    <i class="far fa-eye"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs text-gray-500 dark:text-gray-400">อ่านแล้ว</p>
                    <p class="text-sm md:text-base font-bold text-purple-600"><?php echo number_format($views); ?> ครั้ง</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Article -->
<section class="max-w-5xl mx-auto px-4 mb-8">
    <article class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-white/50 dark:border-slate-700/50 shadow-lg overflow-hidden">
        <!-- Hero Image -->
        <?php if (!empty($images)): ?>
        <div class="relative aspect-[16/9] md:aspect-[21/9] bg-gray-100 dark:bg-slate-700 overflow-hidden cursor-pointer group" onclick="openJournalGallery(0)">
            <img src="<?php echo htmlspecialchars($images[0]); ?>" 
                 alt="<?php echo htmlspecialchars($journal['title'] ?? ''); ?>"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.style.display='none'">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            <?php if (count($images) > 1): ?>
            <div class="absolute top-3 right-3 md:top-4 md:right-4 px-2.5 py-1 md:px-3 md:py-1.5 bg-black/50 backdrop-blur text-white text-xs md:text-sm rounded-full flex items-center gap-1.5 md:gap-2">
                <i class="fas fa-images"></i> <?php echo count($images); ?> รูป
            </div>
            <?php endif; ?>
            <div class="absolute bottom-3 left-3 md:bottom-4 md:left-4 px-3 py-1.5 bg-white/90 dark:bg-slate-800/90 backdrop-blur text-gray-700 dark:text-gray-300 text-xs md:text-sm rounded-full flex items-center gap-1.5">
                <i class="fas fa-expand"></i> คลิกเพื่อดูภาพขยาย
            </div>
        </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="p-5 md:p-8 lg:p-10">
            <div class="prose prose-sm md:prose-base lg:prose-lg max-w-none dark:prose-invert leading-relaxed text-gray-700 dark:text-gray-300">
                <?php echo nl2br(htmlspecialchars($journal['detail'] ?? '')); ?>
            </div>
        </div>

        <!-- Image Gallery -->
        <?php if (count($images) > 1): ?>
        <div class="p-5 md:p-8 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-base md:text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <span class="text-lg md:text-xl">📷</span> รูปภาพทั้งหมด (<?php echo count($images); ?> รูป)
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 md:gap-4">
                <?php foreach ($images as $idx => $img): ?>
                <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 dark:bg-slate-700 cursor-pointer group active:scale-[0.98] transition-transform" onclick="openJournalGallery(<?php echo $idx; ?>)">
                    <img src="<?php echo htmlspecialchars($img); ?>" 
                         alt="รูปที่ <?php echo $idx + 1; ?>"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                         onerror="this.parentElement.style.display='none'">
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Share Actions -->
        <div class="p-5 md:p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-slate-900/30">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
                <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 font-medium">แชร์ข่าวนี้</p>
                <div class="flex items-center gap-2 md:gap-3">
                    <button onclick="journalShareFacebook()" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center bg-[#1877F2] text-white rounded-full hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 transition-all" title="แชร์ Facebook">
                        <i class="fab fa-facebook-f text-sm md:text-base"></i>
                    </button>
                    <button onclick="journalShareLine()" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center bg-[#06C755] text-white rounded-full hover:shadow-lg hover:shadow-green-500/30 active:scale-95 transition-all" title="แชร์ Line">
                        <i class="fab fa-line text-sm md:text-base"></i>
                    </button>
                    <button onclick="journalShareX()" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center bg-black text-white rounded-full hover:shadow-lg hover:shadow-black/30 active:scale-95 transition-all" title="แชร์ X (Twitter)">
                        <i class="fab fa-x-twitter text-sm md:text-base"></i>
                    </button>
                    <button onclick="journalCopyLink()" class="w-9 h-9 md:w-10 md:h-10 flex items-center justify-center bg-gray-600 text-white rounded-full hover:shadow-lg hover:shadow-gray-500/30 active:scale-95 transition-all" title="คัดลอกลิงก์">
                        <i class="fas fa-link text-sm md:text-base"></i>
                    </button>
                </div>
            </div>
        </div>
    </article>
</section>

<!-- Related Journals -->
<?php if (!empty($relatedJournals)): ?>
<section class="max-w-5xl mx-auto px-4 mb-12">
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-2xl border border-white/50 dark:border-slate-700/50 shadow-lg overflow-hidden">
        <div class="p-5 md:p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <span class="text-xl">📚</span> วารสารอื่น ๆ
            </h3>
        </div>
        <div class="p-5 md:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php 
                $relColors = ['from-cyan-500 to-blue-500', 'from-purple-500 to-pink-500', 'from-emerald-500 to-teal-500', 'from-amber-500 to-orange-500'];
                foreach ($relatedJournals as $ri => $rj): 
                    $rImg = null;
                    if (!empty($rj['images'])) {
                        $rDecoded = json_decode($rj['images'], true);
                        if (is_array($rDecoded) && !empty($rDecoded)) {
                            $rawImg = $rDecoded[0];
                            if (strpos($rawImg, 'http') === 0) {
                                $rImg = $rawImg;
                            } else {
                                $rFileName = str_replace(['uploads/newsletter/', 'uploads/newsletters/'], '', $rawImg);
                                $rFileName = ltrim($rFileName, '/');
                                $rImg = rtrim(GENERAL_ASSETS_URL, '/') . '/uploads/newsletter/' . $rFileName;
                            }
                        }
                    }
                    $rDate = journal_detail_short_date($rj['news_date'] ?? $rj['created_at'] ?? null);
                    $rViews = (int)($rj['view_count'] ?? 0);
                    $rColor = $relColors[$ri % count($relColors)];
                ?>
                <a href="<?php echo BASE_URL; ?>journal/detail?id=<?php echo $rj['id']; ?>" 
                   class="group bg-white dark:bg-slate-700 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1 border border-gray-100 dark:border-slate-600">
                    <div class="aspect-[4/3] bg-gray-100 dark:bg-slate-600 overflow-hidden relative">
                        <?php if ($rImg): ?>
                            <img src="<?php echo htmlspecialchars($rImg); ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gradient-to-br <?php echo $rColor; ?>\'><span class=\'text-4xl\'>📰</span></div>'">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br <?php echo $rColor; ?>">
                                <span class="text-4xl">📰</span>
                            </div>
                        <?php endif; ?>
                        <div class="absolute top-2 right-2 px-2 py-0.5 bg-black/50 backdrop-blur text-white text-[10px] rounded-full flex items-center gap-1">
                            <i class="far fa-eye"></i> <?php echo number_format($rViews); ?>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="font-bold text-gray-900 dark:text-white text-sm line-clamp-2 min-h-[2.5rem] mb-1.5"><?php echo htmlspecialchars($rj['title'] ?? ''); ?></h4>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                <i class="far fa-calendar-alt"></i> <?php echo $rDate; ?>
                            </span>
                            <span class="text-amber-600 dark:text-amber-400 font-medium">อ่าน →</span>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Back Button -->
<section class="max-w-5xl mx-auto px-4 mb-12 text-center">
    <a href="<?php echo BASE_URL; ?>journal" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl font-medium hover:from-amber-600 hover:to-orange-600 active:scale-[0.98] transition-all shadow-lg hover:shadow-xl text-sm md:text-base">
        <i class="fas fa-arrow-left"></i> กลับไปหน้าวารสารทั้งหมด
    </a>
</section>

<!-- Gallery Modal -->
<?php if (!empty($images)): ?>
<div id="journalGalleryModal" class="fixed inset-0 bg-black/95 z-[9999] hidden items-center justify-center p-2 md:p-4" style="display:none;">
    <button onclick="closeJournalGallery()" class="absolute top-2 right-2 md:top-4 md:right-4 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center text-white/80 hover:text-white text-2xl md:text-3xl z-10 bg-white/10 rounded-full hover:bg-white/20 transition-colors">
        <i class="fas fa-times"></i>
    </button>
    
    <?php if (count($images) > 1): ?>
    <button onclick="prevJournalImage()" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-white/20 hover:bg-white/30 text-white rounded-full transition-colors active:scale-95">
        <i class="fas fa-chevron-left text-lg md:text-xl"></i>
    </button>
    <button onclick="nextJournalImage()" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-white/20 hover:bg-white/30 text-white rounded-full transition-colors active:scale-95">
        <i class="fas fa-chevron-right text-lg md:text-xl"></i>
    </button>
    <?php endif; ?>
    
    <div class="max-w-5xl max-h-[90vh] w-full px-12 md:px-16 flex flex-col items-center justify-center">
        <img id="journalGalleryImage" src="" alt="" class="max-w-full max-h-[80vh] md:max-h-[85vh] mx-auto rounded-lg shadow-2xl">
        <p id="journalGalleryCaption" class="text-center text-white/80 mt-3 md:mt-4 text-sm md:text-base"></p>
    </div>
</div>
<?php endif; ?>

<script>
<?php if (!empty($images)): ?>
// Gallery
const journalImages = <?php echo json_encode($images); ?>;
let journalCurrentIdx = 0;

function openJournalGallery(index) {
    journalCurrentIdx = index;
    updateJournalGalleryImage();
    const modal = document.getElementById('journalGalleryModal');
    modal.style.display = 'flex';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeJournalGallery() {
    const modal = document.getElementById('journalGalleryModal');
    modal.style.display = 'none';
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

function updateJournalGalleryImage() {
    if (journalImages.length === 0) return;
    document.getElementById('journalGalleryImage').src = journalImages[journalCurrentIdx];
    document.getElementById('journalGalleryCaption').textContent = `รูปที่ ${journalCurrentIdx + 1} / ${journalImages.length}`;
}

function prevJournalImage() {
    journalCurrentIdx = (journalCurrentIdx - 1 + journalImages.length) % journalImages.length;
    updateJournalGalleryImage();
}

function nextJournalImage() {
    journalCurrentIdx = (journalCurrentIdx + 1) % journalImages.length;
    updateJournalGalleryImage();
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('journalGalleryModal');
    if (modal && modal.style.display !== 'none') {
        if (e.key === 'Escape') closeJournalGallery();
        if (e.key === 'ArrowLeft') prevJournalImage();
        if (e.key === 'ArrowRight') nextJournalImage();
    }
});

// Swipe gesture
const jGallery = document.getElementById('journalGalleryModal');
if (jGallery) {
    let jTouchStart = 0;
    jGallery.addEventListener('touchstart', e => { jTouchStart = e.changedTouches[0].screenX; }, { passive: true });
    jGallery.addEventListener('touchend', e => {
        const diff = jTouchStart - e.changedTouches[0].screenX;
        if (Math.abs(diff) > 50) {
            diff > 0 ? nextJournalImage() : prevJournalImage();
        }
    }, { passive: true });
}
<?php endif; ?>

// Share functions
function journalShareFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank', 'width=600,height=400');
}

function journalShareLine() {
    window.open(`https://social-plugins.line.me/lineit/share?url=${encodeURIComponent(window.location.href)}`, '_blank', 'width=600,height=400');
}

function journalShareX() {
    const text = <?php echo json_encode($journal['title'] ?? ''); ?>;
    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(window.location.href)}`, '_blank', 'width=600,height=400');
}

function journalCopyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        // Simple toast notification
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 z-[99999] px-4 py-3 bg-green-600 text-white rounded-xl shadow-xl flex items-center gap-2 text-sm font-medium animate-fade-in';
        toast.innerHTML = '<i class="fas fa-check-circle"></i> คัดลอกลิงก์เรียบร้อยแล้ว';
        document.body.appendChild(toast);
        setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.3s'; setTimeout(() => toast.remove(), 300); }, 2000);
    });
}
</script>
