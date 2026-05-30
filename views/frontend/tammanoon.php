<?php
// views/frontend/tammanoon.php
// Renders the School Charter (ธรรมนูญโรงเรียน) page with a premium Red & Yellow theme and responsive PDF iframe embed

$activeLang = getActiveLang();
$pdfUrl = UPLOAD_URL . 'tammanoon64.pdf';
?>

<main class="flex-grow container mx-auto px-4 py-8 md:py-12 max-w-7xl">
    <!-- Page Header Section -->
    <div class="mb-10 text-center">
        <!-- Badge -->
        <div class="flex items-center justify-center space-x-3 mb-3">
            <span class="h-1.5 w-8 bg-gradient-to-r from-red-600 to-yellow-500 rounded-full"></span>
            <span class="text-xs font-bold text-red-600 dark:text-amber-400 uppercase tracking-widest">
                <?php echo ($activeLang === 'th') ? 'ข้อมูลพื้นฐานสถานศึกษา' : 'Basic School Data'; ?>
            </span>
            <span class="h-1.5 w-8 bg-gradient-to-r from-yellow-500 to-red-600 rounded-full"></span>
        </div>
        
        <!-- Main Title -->
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-tight">
            <?php echo ($activeLang === 'th') ? 'ธรรมนูญโรงเรียนพิชัย' : 'Phichai School Charter'; ?>
        </h1>
        
        <!-- Subtitle -->
        <p class="mt-3 text-slate-500 dark:text-slate-400 text-sm md:text-base max-w-2xl mx-auto leading-relaxed">
            <?php echo ($activeLang === 'th') 
                ? 'ธรรมนูญการจัดการศึกษาของโรงเรียนพิชัย กรอบการดำเนินงาน โครงสร้างการบริหาร และแนวทางปฏิบัติสู่มาตรฐานสากล' 
                : 'Educational management guidelines of Phichai School, outlining administrative structure, policies, and quality standards.'; ?>
        </p>
    </div>

    <!-- Quick Utilities & Action Bar -->
    <div class="max-w-5xl mx-auto mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/65 dark:bg-slate-800/60 backdrop-blur-md p-4 rounded-2xl border border-red-500/10 dark:border-white/5 shadow-md">
        <!-- Left: Document metadata with Red-Yellow icon badge -->
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-yellow-500 flex items-center justify-center text-white shadow-md">
                <i class="fa-solid fa-file-pdf text-lg"></i>
            </div>
            <div class="text-left">
                <p class="text-xs font-bold text-slate-800 dark:text-slate-200">tammanoon64.pdf</p>
                <p class="text-[10px] text-slate-500 dark:text-slate-400">
                    <?php echo ($activeLang === 'th') ? 'ขนาดไฟล์: 1.38 MB | ประเภท: PDF Document' : 'File size: 1.38 MB | Type: PDF Document'; ?>
                </p>
            </div>
        </div>

        <!-- Right: Action Buttons with premium animations -->
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <!-- Fullscreen / Open in new tab -->
            <a href="<?php echo htmlspecialchars($pdfUrl); ?>" target="_blank" rel="noopener" class="flex-1 sm:flex-initial inline-flex items-center justify-center px-4 py-2.5 bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white rounded-xl text-xs font-bold border border-slate-200 dark:border-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-expand mr-2 text-slate-500 dark:text-slate-400"></i>
                <?php echo ($activeLang === 'th') ? 'เปิดเต็มหน้าจอ' : 'View Fullscreen'; ?>
            </a>

            <!-- Direct Download Button -->
            <a href="<?php echo htmlspecialchars($pdfUrl); ?>" download class="flex-1 sm:flex-initial inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-red-600 to-amber-500 hover:from-red-500 hover:to-amber-400 text-white rounded-xl text-xs font-bold shadow-lg hover:shadow-red-500/20 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer">
                <i class="fa-solid fa-download mr-2"></i>
                <?php echo ($activeLang === 'th') ? 'ดาวน์โหลดเอกสาร' : 'Download Document'; ?>
            </a>
        </div>
    </div>

    <!-- PDF Viewer Workspace -->
    <div class="max-w-5xl mx-auto">
        <!-- Interactive PDF Iframe for screens supporting embedded documents -->
        <div class="relative overflow-hidden rounded-3xl bg-slate-100 dark:bg-slate-900 border-2 border-red-500/20 dark:border-amber-500/20 shadow-2xl transition-all duration-300">
            <!-- Red-Yellow Top Edge Border Accent -->
            <div class="h-1.5 w-full bg-gradient-to-r from-red-600 via-yellow-500 to-red-600"></div>

            <!-- Loading Spinner Skeleton -->
            <div class="absolute inset-0 flex flex-col items-center justify-center bg-slate-50 dark:bg-slate-900 z-0 py-20">
                <div class="w-12 h-12 border-4 border-red-200 dark:border-amber-500/10 border-t-red-600 dark:border-t-amber-500 rounded-full animate-spin"></div>
                <p class="mt-4 text-xs font-bold text-slate-400 dark:text-slate-500">
                    <?php echo ($activeLang === 'th') ? 'กำลังโหลดเอกสารธรรมนูญ...' : 'Loading charter document...'; ?>
                </p>
            </div>

            <!-- The Iframe Element -->
            <iframe 
                src="<?php echo htmlspecialchars($pdfUrl); ?>#toolbar=1&navpanes=0&scrollbar=1" 
                class="relative z-10 w-full h-[75vh] md:h-[800px] border-0" 
                title="<?php echo __('info_charter'); ?>"
                loading="lazy">
            </iframe>
        </div>

        <!-- Mobile/Incompatible Device Fallback Card -->
        <div class="mt-6 md:hidden bg-amber-500/10 border border-amber-500/20 p-5 rounded-2xl text-center space-y-4">
            <div class="w-12 h-12 rounded-full bg-amber-500/20 text-amber-600 dark:text-amber-400 flex items-center justify-center mx-auto text-xl">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="space-y-1">
                <h4 class="text-xs font-bold text-amber-700 dark:text-amber-400">
                    <?php echo ($activeLang === 'th') ? 'แนะนำสำหรับผู้ใช้มือถือ' : 'Tips for Mobile Users'; ?>
                </h4>
                <p class="text-[10px] text-slate-600 dark:text-slate-400 leading-relaxed max-w-md mx-auto">
                    <?php echo ($activeLang === 'th') 
                        ? 'หากอุปกรณ์ของท่านไม่แสดงผลแผนภาพเอกสาร PDF ด้านบนโดยตรง สามารถกดปุ่มด้านล่างเพื่อเปิดอ่านในแอปพลิเคชันหรือดาวน์โหลดลงเครื่องได้ทันที' 
                        : 'If the PDF file above does not render properly on your device, please click the button below to view it directly in full resolution.'; ?>
                </p>
            </div>
            <div>
                <a href="<?php echo htmlspecialchars($pdfUrl); ?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold rounded-lg transition-all duration-300">
                    <i class="fa-solid fa-up-right-from-square mr-1.5"></i>
                    <?php echo ($activeLang === 'th') ? 'เปิดอ่านไฟล์ PDF' : 'Open PDF File'; ?>
                </a>
            </div>
        </div>
    </div>
</main>
