<!-- views/frontend/school_staff.php -->
<!-- Beautiful School Staff Directories organized by Department Tabs -->

<!-- Title Banner -->
<section class="relative py-12 bg-slate-100 dark:bg-slate-950 overflow-hidden border-b border-slate-200 dark:border-white/5 transition-colors duration-300">
    <div class="absolute inset-0 bg-cover bg-center opacity-5" style="background-image: url('https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=1200&auto=format&fit=crop');"></div>
    <div class="absolute top-0 right-0 w-80 h-80 bg-indigo-600/5 dark:bg-indigo-600/10 rounded-full blur-[100px]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-2 relative z-10 animate-fade-in-up">
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white"><?php echo __('info_school_staff'); ?></h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">
            <?php echo SCHOOL_NAME; ?> &bull; <?php echo SCHOOL_NAME_EN; ?>
        </p>
    </div>
</section>

<!-- Content Container -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Top Horizontal Scrollable Tabs Menu -->
    <nav class="flex overflow-x-auto gap-2 bg-white/70 dark:bg-white/5 backdrop-blur-xl border border-slate-200 dark:border-white/10 p-2.5 rounded-3xl shadow-xl w-full mb-8 scrollbar-none transition-all duration-300">
        
        <button onclick="switchTab('executive')" id="tab-btn-executive" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xs"><i class="fa-solid fa-user-tie"></i></span>
            <span>ผู้บริหารโรงเรียน</span>
        </button>

        <button onclick="switchTab('thai')" id="tab-btn-thai" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-red-500/10 text-red-600 dark:text-red-400 flex items-center justify-center text-xs"><i class="fa-solid fa-book-open"></i></span>
            <span>ภาษาไทย</span>
        </button>

        <button onclick="switchTab('math')" id="tab-btn-math" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-orange-500/10 text-orange-600 dark:text-orange-400 flex items-center justify-center text-xs"><i class="fa-solid fa-calculator"></i></span>
            <span>คณิตศาสตร์</span>
        </button>

        <button onclick="switchTab('science')" id="tab-btn-science" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center text-xs"><i class="fa-solid fa-atom"></i></span>
            <span>วิทยาศาสตร์และเทคโนโลยี</span>
        </button>

        <button onclick="switchTab('social')" id="tab-btn-social" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xs"><i class="fa-solid fa-earth-americas"></i></span>
            <span>สังคมศึกษาฯ</span>
        </button>

        <button onclick="switchTab('health')" id="tab-btn-health" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xs"><i class="fa-solid fa-volleyball"></i></span>
            <span>สุขศึกษาและพลศึกษา</span>
        </button>

        <button onclick="switchTab('arts')" id="tab-btn-arts" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xs"><i class="fa-solid fa-palette"></i></span>
            <span>ศิลปะ</span>
        </button>

        <button onclick="switchTab('career')" id="tab-btn-career" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-teal-500/10 text-teal-600 dark:text-teal-400 flex items-center justify-center text-xs"><i class="fa-solid fa-screwdriver-wrench"></i></span>
            <span>การงานอาชีพฯ</span>
        </button>

        <button onclick="switchTab('foreign')" id="tab-btn-foreign" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center text-xs"><i class="fa-solid fa-language"></i></span>
            <span>ภาษาต่างประเทศ</span>
        </button>

        <button onclick="switchTab('development')" id="tab-btn-development" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-pink-500/10 text-pink-600 dark:text-pink-400 flex items-center justify-center text-xs"><i class="fa-solid fa-users-gear"></i></span>
            <span>กิจกรรมพัฒนาผู้เรียน</span>
        </button>

        <button onclick="switchTab('support')" id="tab-btn-support" class="staff-tab-btn shrink-0 flex items-center gap-2.5 px-5 py-3 rounded-2xl text-xs font-bold transition-all duration-300">
            <span class="w-7 h-7 rounded-lg bg-slate-500/10 text-slate-600 dark:text-slate-400 flex items-center justify-center text-xs"><i class="fa-solid fa-handshake-angle"></i></span>
            <span>เจ้าหน้าที่ พนักงาน</span>
        </button>
    </nav>

    <!-- Display Content Area -->
    <article class="w-full bg-white/85 dark:bg-slate-950/40 backdrop-blur-xl border border-slate-200 dark:border-white/10 p-6 md:p-8 rounded-3xl shadow-xl min-h-[400px] transition-all duration-300">
        
        <?php foreach ($categorizedStaff as $catKey => $staffList): ?>
            <!-- Category Tab Content Pane -->
            <div id="staff-content-<?php echo $catKey; ?>" class="staff-content-pane hidden animate-fade-in-up">
                <?php if (empty($staffList)): ?>
                    <div class="flex flex-col items-center justify-center py-20 text-center text-slate-400 dark:text-slate-500">
                        <i class="fa-solid fa-folder-open text-5xl mb-4 opacity-50"></i>
                        <p class="text-sm font-semibold">ไม่พบข้อมูลบุคลากรในหมวดหมู่นี้</p>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php foreach ($staffList as $index => $staff): 
                            $name = trim($staff['Teach_name']);
                            $major = trim($staff['Teach_major'] ?? '');
                            $photo = trim($staff['Teach_photo'] ?? '');
                            $email = trim($staff['Teach_email'] ?? '');
                            $phone = trim($staff['Teach_phone'] ?? '');
                            $sex = trim($staff['Teach_sex'] ?? '');
                            $id = trim($staff['Teach_id']);
                            
                            // Determine Position (ตำแหน่ง)
                            $pos = trim($staff['Teach_Position2'] ?? '');
                            if ($pos === 'ผู้บริหาร' || empty($pos)) {
                                $pos = trim($staff['Teach_major'] ?? '');
                            }
                            
                            // Determine Academic Rank (วิทยฐานะ)
                            $rankId = isset($staff['Teach_Academic']) ? intval($staff['Teach_Academic']) : 0;
                            $academicRanks = [
                                1 => 'ชำนาญการ',
                                2 => 'ชำนาญการพิเศษ',
                                3 => 'เชี่ยวชาญ',
                                4 => 'เชี่ยวชาญพิเศษ'
                            ];
                            $rank = ($rankId > 0 && isset($academicRanks[$rankId])) ? $academicRanks[$rankId] : '';

                            // Gender checking for gradient fallback
                            $isFemale = ($sex === 'หญิง' || strpos($sex, 'ห') === 0 || strpos($name, 'นางสาว') === 0 || strpos($name, 'นาง') === 0 || strpos($name, 'น.ส.') === 0);
                            $bgGradient = $isFemale ? 'from-rose-400 to-pink-500 dark:from-rose-500/80 dark:to-pink-600/80' : 'from-blue-400 to-indigo-500 dark:from-blue-500/80 dark:to-indigo-600/80';
                            
                            // Extract initial cleanly
                            $prefixes = ['นางสาว', 'นาย', 'นาง', 'เด็กหญิง', 'เด็กชาย', 'ด.ญ.', 'ด.ช.', 'น.ส.'];
                            $cleanName = str_replace($prefixes, '', $name);
                            $initial = mb_substr(trim($cleanName), 0, 1, 'UTF-8');
                            if (empty($initial)) {
                                $initial = mb_substr($name, 0, 1, 'UTF-8');
                            }

                            $photoUrl = $photo ? 'https://std.phichai.ac.th/teacher/uploads/phototeach/' . $photo : '';
                        ?>
                            <!-- Profile Card -->
                            <div onclick="openStaffDetails(<?php echo htmlspecialchars(json_encode($staff)); ?>, '<?php echo $isFemale ? 'female' : 'male'; ?>', '<?php echo $initial; ?>')" class="cursor-pointer bg-white dark:bg-slate-950/40 border border-slate-200 dark:border-white/10 rounded-2xl p-4 flex items-center gap-4 shadow-sm hover:shadow-md hover:scale-[1.02] hover:border-indigo-500/30 transition-all duration-300 group relative">
                                <!-- Photo/Initial Avatar -->
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-tr <?php echo $bgGradient; ?> text-white flex items-center justify-center font-black text-xl shadow-inner shrink-0 overflow-hidden relative">
                                    <span class="absolute inset-0 flex items-center justify-center"><?php echo $initial; ?></span>
                                    <?php if ($photoUrl): ?>
                                        <img src="<?php echo htmlspecialchars($photoUrl); ?>" class="w-full h-full object-cover relative z-10" onerror="this.style.display='none'">
                                    <?php endif; ?>
                                </div>

                                <!-- Card Details -->
                                <div class="space-y-0.5 min-w-0">
                                    <h4 class="text-xs sm:text-sm font-bold text-slate-800 dark:text-white line-clamp-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors"><?php echo htmlspecialchars($name); ?></h4>
                                    <p class="text-[10px] text-indigo-600 dark:text-indigo-400 font-semibold leading-normal truncate"><?php echo htmlspecialchars($pos); ?></p>
                                    <?php if ($rank): ?>
                                        <p class="text-[9px] text-slate-400 dark:text-slate-500 truncate">วิทยฐานะ: <?php echo htmlspecialchars($rank); ?></p>
                                    <?php else: ?>
                                        <p class="text-[9px] text-slate-400 dark:text-slate-500">&nbsp;</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </article>
</section>

<!-- INTERACTIVE STAFF DETAILS MODAL -->
<div id="staffModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity duration-300" onclick="closeStaffModal()"></div>
    
    <!-- Modal Box -->
    <div class="relative w-full max-w-sm bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10" id="staffModalBox">
        
        <!-- Header -->
        <div class="flex items-center justify-between p-5 border-b border-slate-100 dark:border-slate-800 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
            <h3 class="text-xs font-bold flex items-center gap-2">
                <i class="fas fa-id-card"></i>
                <span>โปรไฟล์และข้อมูลบุคลากร</span>
            </h3>
            <button onclick="closeStaffModal()" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/20 hover:bg-white/30 transition-all hover:scale-105 active:scale-95 cursor-pointer">
                <i class="fas fa-times text-sm"></i>
            </button>
        </div>
        
        <!-- Modal Body Content -->
        <div class="p-6 space-y-6 flex flex-col items-center text-center">
            
            <!-- Large Image Wrapper -->
            <div class="relative w-36 h-48 rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-800 shadow-md border-2 border-slate-200 dark:border-slate-700">
                <!-- Large avatar initials fallback under picture -->
                <div class="absolute inset-0 bg-gradient-to-tr flex items-center justify-center text-white font-black text-4xl shadow-inner" id="modalAvatarFallback">
                    --
                </div>
                <!-- Large staff photo -->
                <img id="modalStaffPhoto" src="" class="w-full h-full object-cover relative z-10" onerror="this.style.display='none'">
            </div>
            
            <!-- Details -->
            <div class="space-y-4 w-full text-left">
                <div class="text-center space-y-1">
                    <h4 class="text-base font-extrabold text-slate-800 dark:text-white" id="modalStaffName">--</h4>
                    <p class="text-[11px] text-indigo-600 dark:text-indigo-400 font-bold" id="modalStaffMajor">--</p>
                </div>
                
                <div class="space-y-2 bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800 rounded-2xl p-4">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">ตำแหน่ง</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200" id="modalStaffPosition">--</span>
                    </div>
                    <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>
                    
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">วิทยฐานะ</span>
                        <span class="font-bold text-slate-800 dark:text-slate-200" id="modalStaffRank">--</span>
                    </div>
                    <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>
                    
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">อีเมลติดต่อ</span>
                        <a href="" class="font-bold text-indigo-600 hover:underline truncate max-w-[200px]" id="modalStaffEmail">--</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Foot Actions -->
        <div class="p-4 bg-slate-50 dark:bg-slate-950/40 border-t border-slate-100 dark:border-slate-800 flex justify-end">
            <button onclick="closeStaffModal()" class="px-5 py-2 bg-slate-200 hover:bg-slate-300 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300 text-xs font-bold rounded-xl transition-all cursor-pointer">
                ปิดหน้าต่าง
            </button>
        </div>
    </div>
</div>

<script>
    function switchTab(tabId) {
        // Hide all content panes
        document.querySelectorAll('.staff-content-pane').forEach(pane => {
            pane.classList.add('hidden');
        });

        // Reset styling for all tab buttons
        document.querySelectorAll('.staff-tab-btn').forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-500/10');
            btn.classList.add('text-slate-600', 'dark:text-slate-300', 'hover:bg-slate-200/50', 'dark:hover:bg-white/5');
            
            const iconSpan = btn.querySelector('span');
            if (iconSpan) {
                // Determine category-specific colors
                let origColorClass = 'text-slate-600 dark:text-slate-400';
                if (btn.id.includes('executive')) origColorClass = 'text-amber-600 dark:text-amber-400';
                else if (btn.id.includes('thai')) origColorClass = 'text-red-600 dark:text-red-400';
                else if (btn.id.includes('math')) origColorClass = 'text-orange-600 dark:text-orange-400';
                else if (btn.id.includes('science')) origColorClass = 'text-blue-600 dark:text-blue-400';
                else if (btn.id.includes('social')) origColorClass = 'text-emerald-600 dark:text-emerald-400';
                else if (btn.id.includes('health')) origColorClass = 'text-rose-600 dark:text-rose-400';
                else if (btn.id.includes('arts')) origColorClass = 'text-purple-600 dark:text-purple-400';
                else if (btn.id.includes('career')) origColorClass = 'text-teal-600 dark:text-teal-400';
                else if (btn.id.includes('foreign')) origColorClass = 'text-indigo-600 dark:text-indigo-400';
                else if (btn.id.includes('development')) origColorClass = 'text-pink-600 dark:text-pink-400';
                
                iconSpan.className = `w-7 h-7 rounded-lg bg-indigo-500/10 ${origColorClass} flex items-center justify-center text-xs`;
            }
        });

        // Show active content pane
        const activePane = document.getElementById(`staff-content-${tabId}`);
        if (activePane) {
            activePane.classList.remove('hidden');
        }

        // Highlight active tab button
        const activeBtn = document.getElementById(`tab-btn-${tabId}`);
        if (activeBtn) {
            activeBtn.classList.remove('text-slate-600', 'dark:text-slate-300', 'hover:bg-slate-200/50', 'dark:hover:bg-white/5');
            activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-500/10');
            
            const iconSpan = activeBtn.querySelector('span');
            if (iconSpan) {
                iconSpan.className = 'w-7 h-7 rounded-lg bg-indigo-700 text-white flex items-center justify-center text-xs';
            }
            
            activeBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }

        // Sync URL query state dynamically
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab=' + tabId;
        window.history.pushState({path: newUrl}, '', newUrl);
    }

    function openStaffDetails(staff, gender, initial) {
        const modal = document.getElementById('staffModal');
        const box = document.getElementById('staffModalBox');

        // Determine position (ตำแหน่ง)
        let pos = (staff.Teach_Position2 || '').trim();
        if (pos === 'ผู้บริหาร' || !pos) {
            pos = (staff.Teach_major || '').trim();
        }

        // Determine academic rank (วิทยฐานะ)
        const rankId = parseInt(staff.Teach_Academic) || 0;
        const academicRanks = {
            1: 'ชำนาญการ',
            2: 'ชำนาญการพิเศษ',
            3: 'เชี่ยวชาญ',
            4: 'เชี่ยวชาญพิเศษ'
        };
        const rank = (rankId > 0 && academicRanks[rankId]) ? academicRanks[rankId] : 'ไม่มีวิทยฐานะ';

        // Populate fields
        document.getElementById('modalStaffName').textContent = staff.Teach_name;
        document.getElementById('modalStaffMajor').textContent = staff.Teach_major || '-';
        document.getElementById('modalStaffPosition').textContent = pos;
        document.getElementById('modalStaffRank').textContent = rank;
        
        const emailEl = document.getElementById('modalStaffEmail');
        if (staff.Teach_email) {
            emailEl.textContent = staff.Teach_email;
            emailEl.href = `mailto:${staff.Teach_email}`;
            emailEl.classList.remove('font-bold', 'text-slate-800', 'dark:text-slate-200');
            emailEl.classList.add('font-bold', 'text-indigo-600', 'hover:underline');
        } else {
            emailEl.textContent = '-';
            emailEl.removeAttribute('href');
            emailEl.className = 'font-bold text-slate-800 dark:text-slate-200';
        }

        // Avatar fallback gradient
        const bgGradient = (gender === 'female') ? 'from-rose-400 to-pink-500' : 'from-blue-400 to-indigo-500';
        const fallback = document.getElementById('modalAvatarFallback');
        fallback.className = `absolute inset-0 bg-gradient-to-tr ${bgGradient} flex items-center justify-center text-white font-black text-4xl shadow-inner`;
        fallback.textContent = initial;

        // Image binding
        const photoEl = document.getElementById('modalStaffPhoto');
        photoEl.style.display = 'block';
        photoEl.src = staff.Teach_photo ? `https://std.phichai.ac.th/teacher/uploads/phototeach/${staff.Teach_photo}` : '';

        // Show with animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            box.classList.remove('scale-95', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeStaffModal() {
        const modal = document.getElementById('staffModal');
        const box = document.getElementById('staffModalBox');

        box.classList.remove('scale-100', 'opacity-100');
        box.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Find tab from URL query, fallback to 'executive'
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get('tab') || 'executive';
        switchTab(tabParam);
    });
</script>
