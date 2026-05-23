<!-- views/frontend/about.php -->
<!-- Unified About School Views with Horizontal Top Tabs Navigation -->

<?php
$lang = getActiveLang();
$contentField = 'content_' . $lang;
?>

<!-- Title Banner -->
<section class="relative py-12 bg-slate-100 dark:bg-slate-950 overflow-hidden border-b border-slate-200 dark:border-white/5 transition-colors duration-300">
    <div class="absolute inset-0 bg-cover bg-center opacity-5" style="background-image: url('https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200&auto=format&fit=crop');"></div>
    <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-600/5 dark:bg-indigo-600/10 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 relative z-10 animate-fade-in-up">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white"><?php echo __('about_school'); ?></h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            <?php echo SCHOOL_NAME; ?> &bull; <?php echo SCHOOL_NAME_EN; ?>
        </p>
    </div>
</section>

<!-- Content Container -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- A. Top Horizontal Scrollable Tabs Menu -->
    <nav class="flex overflow-x-auto gap-2 bg-white/70 dark:bg-white/5 backdrop-blur-xl border border-slate-200 dark:border-white/10 p-2.5 rounded-3xl shadow-xl w-full mb-8 scrollbar-none transition-all duration-300">
        
        <button onclick="switchTab('history')" id="tab-btn-history" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs"><i class="fa-solid fa-clock-rotate-left"></i></span>
            <span><?php echo __('history'); ?></span>
        </button>

        <button onclick="switchTab('vision_mission')" id="tab-btn-vision_mission" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs"><i class="fa-solid fa-bullseye"></i></span>
            <span><?php echo __('vision_mission'); ?></span>
        </button>

        <button onclick="switchTab('symbol')" id="tab-btn-symbol" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 flex items-center justify-center text-xs"><i class="fa-solid fa-award"></i></span>
            <span><?php echo __('symbol'); ?></span>
        </button>

        <button onclick="switchTab('colors')" id="tab-btn-colors" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs"><i class="fa-solid fa-palette"></i></span>
            <span><?php echo __('colors'); ?></span>
        </button>

        <button onclick="switchTab('song')" id="tab-btn-song" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-pink-500/10 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs"><i class="fa-solid fa-music"></i></span>
            <span><?php echo __('song'); ?></span>
        </button>

        <button onclick="switchTab('executives')" id="tab-btn-executives" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs"><i class="fa-solid fa-user-group"></i></span>
            <span><?php echo __('executives'); ?></span>
        </button>

        <button onclick="switchTab('structure')" id="tab-btn-structure" class="about-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-orange-500/10 text-orange-600 dark:text-orange-400 flex items-center justify-center text-xs"><i class="fa-solid fa-sitemap"></i></span>
            <span><?php echo __('structure'); ?></span>
        </button>
    </nav>

    <!-- B. Full-width Display Content Area -->
    <article class="w-full bg-white/80 dark:bg-white/5 backdrop-blur-xl border border-slate-200 dark:border-white/10 p-6 md:p-8 rounded-3xl shadow-xl min-h-[400px] transition-all duration-300">
        
        <!-- Tab Content: History -->
        <div id="about-content-history" class="about-content-pane hidden animate-fade-in-up">
            <?php echo $sections['history'][$contentField] ?? ''; ?>
        </div>

        <!-- Tab Content: Vision & Mission -->
        <div id="about-content-vision_mission" class="about-content-pane hidden animate-fade-in-up">
            <?php echo $sections['vision_mission'][$contentField] ?? ''; ?>
        </div>

        <!-- Tab Content: Symbols -->
        <div id="about-content-symbol" class="about-content-pane hidden animate-fade-in-up">
            <?php 
            $symbolContent = $sections['symbol'][$contentField] ?? '';
            if (!empty(SCHOOL_LOGO)) {
                $logoHtml = '<img src="' . UPLOAD_URL . SCHOOL_LOGO . '" alt="School Logo" class="w-32 h-32 rounded-3xl object-contain shadow-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 p-2">';
                $symbolContent = preg_replace(
                    '/<div class="w-32 h-32 rounded-3xl [^"]*">.*?<\/div>/s',
                    $logoHtml,
                    $symbolContent
                );
            }
            echo $symbolContent;
            ?>
        </div>

        <!-- Tab Content: Colors -->
        <div id="about-content-colors" class="about-content-pane hidden animate-fade-in-up">
            <?php echo $sections['colors'][$contentField] ?? ''; ?>
        </div>

        <!-- Tab Content: Song -->
        <div id="about-content-song" class="about-content-pane hidden animate-fade-in-up">
            <?php echo $sections['song'][$contentField] ?? ''; ?>
        </div>

        <!-- Tab Content: Executives Directory -->
        <div id="about-content-executives" class="about-content-pane hidden animate-fade-in-up">
            <div class="space-y-6">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white border-b border-slate-200 dark:border-slate-800 pb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-sm"><i class="fa-solid fa-user-group"></i></span>
                    <span><?php echo __('executives'); ?></span>
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-20 gap-x-6 pt-20 pb-10">
                    <?php foreach ($executives as $exec): 
                        $name = ($lang === 'th') ? $exec['name_th'] : $exec['name_en'];
                        $position = ($lang === 'th') ? $exec['position_th'] : $exec['position_en'];
                    ?>
                        <div class="relative glass-card border border-amber-100/70 dark:border-white/5 p-6 pt-16 rounded-[2rem] shadow-xl hover:shadow-2xl flex flex-col items-center text-center transition-all duration-300 hover:scale-[1.03]">
                            <!-- Floating Executive Photo Frame -->
                            <div class="absolute -top-14 left-1/2 -translate-x-1/2 w-28 h-28 rounded-full bg-gradient-to-tr from-amber-300 to-amber-500 p-[3px] shadow-lg">
                                <div class="w-full h-full rounded-full bg-amber-50/70 dark:bg-slate-900 border-4 border-white dark:border-slate-950 overflow-hidden flex items-center justify-center">
                                    <?php if (!empty($exec['image_path'])): ?>
                                        <img src="<?php echo htmlspecialchars($exec['image_path']); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <i class="fa-solid fa-user text-amber-700/80 dark:text-amber-500 text-5xl translate-y-2 shrink-0"></i>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Executive Details -->
                            <div class="flex flex-col items-center w-full mt-2">
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm sm:text-base tracking-tight"><?php echo htmlspecialchars($name); ?></h4>
                                <p class="text-[11px] text-indigo-600 dark:text-indigo-400 font-semibold mt-1.5 leading-normal max-w-[200px]"><?php echo htmlspecialchars($position); ?></p>
                                
                                <?php if (!empty($exec['academic_rank'])): ?>
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-500/90 text-white border border-amber-600/30 text-[9px] font-bold mt-3 shadow-sm shadow-amber-500/10">
                                        <i class="fa-solid fa-circle-check text-[9px]"></i>
                                        <?php echo htmlspecialchars($exec['academic_rank']); ?>
                                    </span>
                                <?php endif; ?>

                                <!-- Dotted divider line -->
                                <div class="border-t border-dashed border-slate-200 dark:border-white/10 w-full my-4.5"></div>

                                <!-- Email Link -->
                                <?php if (!empty($exec['email'])): ?>
                                    <a href="mailto:<?php echo htmlspecialchars($exec['email']); ?>" class="inline-flex items-center gap-1.5 text-[10px] text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-white transition-colors font-medium">
                                        <i class="fa-solid fa-envelope text-indigo-500 dark:text-indigo-400 text-[11px]"></i>
                                        <span><?php echo htmlspecialchars($exec['email']); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Tab Content: Administrative Structure Diagram -->
        <div id="about-content-structure" class="about-content-pane hidden animate-fade-in-up">
            <?php echo $sections['structure'][$contentField] ?? ''; ?>
        </div>

    </article>
</section>

<!-- Interactive tab control JS script -->
<script>
    function switchTab(tabId) {
        // Hide all content panes
        document.querySelectorAll('.about-content-pane').forEach(pane => {
            pane.classList.add('hidden');
        });

        // Remove active styling classes from all tab buttons
        document.querySelectorAll('.about-tab-btn').forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-500/10');
            btn.classList.add('text-slate-600', 'dark:text-slate-300', 'hover:bg-slate-200/50', 'dark:hover:bg-white/5');
            
            // Reset inner icons background color
            const iconSpan = btn.querySelector('span');
            if (iconSpan) {
                iconSpan.className = iconSpan.className.replace('bg-indigo-700 text-white', 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400');
            }
        });

        // Show selected content pane
        const targetPane = document.getElementById(`about-content-${tabId}`);
        if (targetPane) {
            targetPane.classList.remove('hidden');
        }

        // Highlight active tab button
        const activeBtn = document.getElementById(`tab-btn-${tabId}`);
        if (activeBtn) {
            activeBtn.classList.remove('text-slate-600', 'dark:text-slate-300', 'hover:bg-slate-200/50', 'dark:hover:bg-white/5');
            activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-500/10');
            
            // Set inner icon highlight
            const iconSpan = activeBtn.querySelector('span');
            if (iconSpan) {
                iconSpan.className = iconSpan.className.replace('bg-indigo-500/10 text-indigo-600 dark:text-indigo-400', 'bg-indigo-700 text-white');
            }
            
            // Auto scroll horizontal container to keep active tab in viewport on small screens
            activeBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }

        // Sync URL query state dynamically without full reload
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + tabId;
        window.history.pushState({path: newUrl}, '', newUrl);
    }

    // Initialize initial tab on document render
    document.addEventListener('DOMContentLoaded', () => {
        // Read active tab parameter from PHP backend selection
        const initialTab = '<?php echo $activeTab; ?>';
        switchTab(initialTab);
    });
</script>
