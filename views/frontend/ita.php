<!-- views/frontend/ita.php -->
<!-- Public ITA Online Table -->

<!-- Hero Headers -->
<section class="relative py-16 bg-slate-100 dark:bg-slate-950 overflow-hidden transition-colors duration-300">
    <div class="absolute inset-0 bg-cover bg-center opacity-5 transition-opacity" style="background-image: url('https://images.unsplash.com/photo-1450133064473-71024230f91b?q=80&w=1200&auto=format&fit=crop');"></div>
    <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-600/5 dark:bg-indigo-600/10 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10 animate-fade-in-up">
        <span class="px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-600 dark:text-indigo-300 text-xs font-bold uppercase tracking-wider font-english">
            <?php echo __('ita_showcase'); ?>
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white"><?php echo __('ita_showcase'); ?></h1>
        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm max-w-xl mx-auto leading-relaxed">
            <?php echo __('ita_showcase_desc'); ?>
        </p>
    </div>
</section>

<!-- Main Table Container -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Progress & Search Section -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center mb-8 bg-white/80 dark:bg-white/5 border border-slate-900/5 dark:border-white/10 p-6 rounded-3xl backdrop-blur-xl transition-all duration-300">
        <!-- Progress Bar (Left) -->
        <div class="lg:col-span-8 flex flex-col sm:flex-row items-center gap-6 w-full">
            <div class="text-center sm:text-left shrink-0">
                <span class="text-slate-400 dark:text-slate-500 text-[10px] uppercase font-bold tracking-wider font-english">Overall Progress</span>
                <h2 class="text-2xl font-bold text-slate-950 dark:text-white"><?php echo $progressPercent; ?>% <span class="text-xs text-slate-500 dark:text-slate-400 font-normal">ความโปร่งใส</span></h2>
            </div>
            <div class="w-full space-y-1">
                <div class="w-full bg-slate-200 dark:bg-slate-900/60 rounded-full h-3.5 border border-slate-300 dark:border-white/5 overflow-hidden">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-full rounded-full transition-all duration-1000" style="width: <?php echo $progressPercent; ?>%"></div>
                </div>
                <div class="flex justify-between text-[10px] text-slate-600 dark:text-slate-400">
                    <span><?php echo __('published_stats', $itaMetrics['completed'], $itaMetrics['total']); ?></span>
                    <span><?php echo __('ita_showcase'); ?></span>
                </div>
            </div>
        </div>

        <!-- Search Input Filter (Right) -->
        <div class="lg:col-span-4 w-full">
            <label for="ita-search" class="sr-only"><?php echo __('search_placeholder'); ?></label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 dark:text-slate-500 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input id="ita-search" type="text" class="w-full bg-white dark:bg-slate-950/60 border border-slate-300 dark:border-white/10 rounded-2xl pl-10 pr-4 py-3 text-xs text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all duration-300" placeholder="<?php echo __('search_placeholder'); ?>">
            </div>
        </div>
    </div>

    <!-- ITA Indicators List -->
    <div class="bg-white/80 dark:bg-white/5 backdrop-blur-xl border border-slate-900/5 dark:border-white/10 rounded-3xl overflow-hidden shadow-2xl transition-all duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="ita-table">
                <thead>
                    <tr class="bg-slate-200/50 dark:bg-slate-950/60 border-b border-slate-900/5 dark:border-white/10 text-[11px] font-bold text-slate-700 dark:text-slate-300 tracking-wider">
                        <th class="py-5 px-6 text-center w-24"><?php echo __('oit_code'); ?></th>
                        <th class="py-5 px-6"><?php echo __('oit_title'); ?></th>
                        <th class="py-5 px-6 text-center w-64"><?php echo __('oit_download'); ?></th>
                        <th class="py-5 px-6 text-center w-36"><?php echo __('oit_updated'); ?></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-white/5 text-xs text-slate-700 dark:text-slate-300">
                    <?php if (empty($itaItems)): ?>
                        <tr>
                            <td colspan="4" class="text-center py-16">
                                <i class="fa-regular fa-folder-open text-3xl text-slate-500 mb-3"></i>
                                <p class="text-slate-500 dark:text-slate-400"><?php echo __('waiting_update'); ?></p>
                            </td>
                        </tr>
                    <?php else: 
                        foreach ($itaItems as $item): 
                    ?>
                        <tr class="ita-row hover:bg-slate-200/30 dark:hover:bg-white/5 transition-colors duration-200">
                            <!-- Code -->
                            <td class="py-4 px-6 text-center font-english font-bold text-indigo-600 dark:text-indigo-400">
                                <span class="bg-indigo-500/10 px-3 py-1.5 rounded-lg border border-indigo-500/20">
                                    <?php echo htmlspecialchars($item['code']); ?>
                                </span>
                            </td>
                            
                            <!-- Name -->
                            <td class="py-4 px-6 font-bold leading-relaxed text-slate-900 dark:text-white">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </td>
                            
                            <!-- Links / Files -->
                            <td class="py-4 px-6 text-center">
                                <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                                    <?php if (!empty($item['file_path'])): ?>
                                        <a href="<?php echo htmlspecialchars($item['file_path']); ?>" target="_blank" rel="noopener" class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 bg-red-600/10 hover:bg-red-600/20 text-red-600 dark:text-red-400 border border-red-500/20 rounded-xl text-[11px] font-bold transition-all duration-200">
                                            <i class="fa-regular fa-file-pdf text-sm mr-1.5"></i> <?php echo __('download_pdf'); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($item['link_url'])): ?>
                                        <a href="<?php echo htmlspecialchars($item['link_url']); ?>" target="_blank" rel="noopener" class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 bg-indigo-600/10 hover:bg-indigo-600/20 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-xl text-[11px] font-bold transition-all duration-200">
                                            <i class="fa-solid fa-link text-sm mr-1.5"></i> <?php echo __('view_link'); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (empty($item['file_path']) && empty($item['link_url'])): ?>
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-400 dark:text-slate-500 text-[10px] font-semibold border border-slate-300 dark:border-white/5">
                                            <i class="fa-solid fa-hourglass-half mr-1.5"></i> <?php echo __('waiting_update'); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            
                            <!-- Updated At -->
                            <td class="py-4 px-6 text-center text-slate-500 dark:text-slate-400 font-english text-[11px]">
                                <?php echo date('d/m/Y H:i', strtotime($item['updated_at'])); ?>
                            </td>
                        </tr>
                    <?php 
                        endforeach; 
                    endif; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Client Side Search Filter Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('ita-search');
        const tableRows = document.querySelectorAll('.ita-row');

        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();

            tableRows.forEach(row => {
                const codeText = row.children[0].innerText.toLowerCase();
                const nameText = row.children[1].innerText.toLowerCase();

                if (codeText.includes(query) || nameText.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
