<?php
// views/frontend/schoolboard.php
// Renders the Basic School Board Committee directory with a premium teal/emerald theme and dark mode compatibility

$activeLang = getActiveLang();

// Board members list with structural roles and transliterations
$boardMembers = [
    [
        'name_th' => 'นายสุเทพ ไตต่อผล',
        'name_en' => 'Mr. Suthep Taitopol',
        'role_th' => 'ประธานคณะกรรมการสถานศึกษาขั้นพื้นฐาน',
        'role_en' => 'Chairman of the Basic School Board',
        'type' => 'chairman',
        'icon' => 'fa-crown',
        'gradient' => 'from-amber-500 to-yellow-500',
        'ring' => 'border-amber-400/80'
    ],
    [
        'name_th' => 'พระครูบวรธรรมภูษิต',
        'name_en' => 'Phrakru Bowonthammaphusit',
        'role_th' => 'ผู้แทนพระภิกษุสงฆ์ / ผู้แทนศาสนา',
        'role_en' => 'Clergy & Monk Representative',
        'type' => 'representative',
        'icon' => 'fa-dharmachakra',
        'gradient' => 'from-emerald-600 to-teal-500',
        'ring' => 'border-teal-400'
    ],
    [
        'name_th' => 'นางสาวรสสุคนธ์ อินชัยเขา',
        'name_en' => 'Miss Rossukhon Inchaikhao',
        'role_th' => 'กรรมการและเลขานุการ (ผู้อำนวยการโรงเรียน)',
        'role_en' => 'Secretary & Member (School Director)',
        'type' => 'secretary',
        'icon' => 'fa-signature',
        'gradient' => 'from-emerald-600 to-teal-500',
        'ring' => 'border-teal-400'
    ],
    [
        'name_th' => 'นายไฉน มั่งคล้าย',
        'name_en' => 'Mr. Chanai Mungklai',
        'role_th' => 'ผู้แทนองค์กรปกครองส่วนท้องถิ่น',
        'role_en' => 'Local Government Representative',
        'type' => 'representative',
        'icon' => 'fa-building-shield',
        'gradient' => 'from-emerald-500 to-teal-500',
        'ring' => 'border-teal-400/50'
    ],
    [
        'name_th' => 'นายเกรียงไกร ศรเพ็ชร',
        'name_en' => 'Mr. Kriangkrai Sornphet',
        'role_th' => 'ผู้แทนศิษย์เก่า',
        'role_en' => 'Alumni Representative',
        'type' => 'representative',
        'icon' => 'fa-graduation-cap',
        'gradient' => 'from-emerald-500 to-teal-500',
        'ring' => 'border-teal-400/50'
    ],
    [
        'name_th' => 'นายชัย บุญฤทธิ์',
        'name_en' => 'Mr. Chai Boonrit',
        'role_th' => 'ผู้แทนองค์กรชุมชน',
        'role_en' => 'Community Organization Representative',
        'type' => 'representative',
        'icon' => 'fa-users-line',
        'gradient' => 'from-emerald-500 to-teal-500',
        'ring' => 'border-teal-400/50'
    ],
    [
        'name_th' => 'นางสุจินดา มีรอด',
        'name_en' => 'Mrs. Suchinda Meerod',
        'role_th' => 'ผู้แทนผู้ปกครอง',
        'role_en' => 'Parent Representative',
        'type' => 'representative',
        'icon' => 'fa-people-roof',
        'gradient' => 'from-emerald-500 to-teal-500',
        'ring' => 'border-teal-400/50'
    ],
    [
        'name_th' => 'นางวรพรรณ สุวรรณชื่น',
        'name_en' => 'Mrs. Woraphan Suwannachuen',
        'role_th' => 'ผู้แทนครู',
        'role_en' => 'Teacher Representative',
        'type' => 'representative',
        'icon' => 'fa-chalkboard-user',
        'gradient' => 'from-emerald-500 to-teal-500',
        'ring' => 'border-teal-400/50'
    ],
    [
        'name_th' => 'นายบัณฑิต อุปธารปรีชา',
        'name_en' => 'Mr. Bundit Ooppathanpreecha',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ],
    [
        'name_th' => 'นายสิทธิพร เจียมจันทร์คุปต์',
        'name_en' => 'Mr. Sitthiporn Jiamjankupt',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ],
    [
        'name_th' => 'นายวิมาน จันทร์ดา',
        'name_en' => 'Mr. Wiman Chanda',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ],
    [
        'name_th' => 'นายประดิษฐ์ มีกลิ่นหอม',
        'name_en' => 'Mr. Pradit Meeklinhom',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ],
    [
        'name_th' => 'นายเจษฎา ปาณะจำนงค์',
        'name_en' => 'Mr. Jetsada Panachamnong',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ],
    [
        'name_th' => 'นายกำพล อยู่เจริญกิจ',
        'name_en' => 'Mr. Kamphol Yucharoenkit',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ],
    [
        'name_th' => 'นางขนิษฐา ชัยจิตติประเสริฐ',
        'name_en' => 'Mrs. Khanittha Chaijittiprasert',
        'role_th' => 'กรรมการผู้ทรงคุณวุฒิ',
        'role_en' => 'Qualified Expert Member',
        'type' => 'expert',
        'icon' => 'fa-user-tie',
        'gradient' => 'from-slate-500 to-slate-400',
        'ring' => 'border-slate-400/50'
    ]
];
?>

<main class="flex-grow container mx-auto px-4 py-8 md:py-12 max-w-7xl">
    <!-- Page Header Section -->
    <div class="mb-12 text-center">
        <div class="flex items-center justify-center space-x-3 mb-2">
            <span class="h-1 w-10 bg-emerald-500 rounded-full"></span>
            <span class="text-xs font-semibold text-emerald-500 uppercase tracking-widest">
                <?php echo ($activeLang === 'th') ? 'ทำเนียบบุคลากร' : 'Personnel Directory'; ?>
            </span>
            <span class="h-1 w-10 bg-emerald-500 rounded-full"></span>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-800 dark:text-white">
            <?php echo __('info_board'); ?>
        </h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400 text-sm md:text-base max-w-2xl mx-auto">
            <?php echo ($activeLang === 'th') 
                ? 'คณะกรรมการสถานศึกษาขั้นพื้นฐาน โรงเรียนพิชัย ขับเคลื่อนนโยบาย สนับสนุน และพัฒนาการบริหารการศึกษา' 
                : 'The Basic School Board Committee of Phichai School, driving policies and supporting educational administration.'; ?>
        </p>
    </div>

    <!-- Hierarchical Structure Diagram Grid -->
    <div class="space-y-12">
        
        <!-- Level 1: Chairman of the Board -->
        <div class="flex justify-center">
            <?php 
            $chairman = $boardMembers[0];
            $name = ($activeLang === 'th') ? $chairman['name_th'] : $chairman['name_en'];
            $role = ($activeLang === 'th') ? $chairman['role_th'] : $chairman['role_en'];
            ?>
            <div class="relative overflow-hidden bg-white dark:bg-slate-800/80 border-2 border-amber-400 rounded-3xl p-6 md:p-8 max-w-md w-full text-center shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300">
                <div class="absolute top-0 left-0 h-2 w-full bg-gradient-to-r <?php echo $chairman['gradient']; ?>"></div>
                
                <!-- Avatar Circular Badge -->
                <div class="mx-auto w-24 h-24 rounded-full bg-amber-50 dark:bg-amber-950/40 border-4 <?php echo $chairman['ring']; ?> flex items-center justify-center text-amber-600 dark:text-amber-400 shadow-inner mb-4 relative">
                    <i class="fa-solid fa-user-tie text-4xl"></i>
                    <!-- Small Crown Icon overlay -->
                    <span class="absolute -top-1 -right-1 w-8 h-8 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-400 text-white border-2 border-white dark:border-slate-800 flex items-center justify-center text-xs shadow-md">
                        <i class="fa-solid <?php echo $chairman['icon']; ?>"></i>
                    </span>
                </div>
                
                <h3 class="text-lg md:text-xl font-bold text-slate-900 dark:text-white"><?php echo htmlspecialchars($name); ?></h3>
                <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 mt-1 uppercase tracking-wide"><?php echo htmlspecialchars($role); ?></p>
            </div>
        </div>

        <!-- Connection Arrow (Teal line downward) -->
        <div class="hidden md:flex justify-center items-center h-8">
            <div class="w-0.5 h-full bg-gradient-to-b from-amber-400 to-teal-500"></div>
        </div>

        <!-- Level 2: Representatives & Secretary (2-Column Center Grid) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
            <?php 
            $subLevelMembers = [$boardMembers[1], $boardMembers[2]];
            foreach ($subLevelMembers as $member):
                $name = ($activeLang === 'th') ? $member['name_th'] : $member['name_en'];
                $role = ($activeLang === 'th') ? $member['role_th'] : $member['role_en'];
            ?>
                <div class="relative overflow-hidden bg-white dark:bg-slate-800/80 border border-teal-500/20 rounded-2xl p-6 text-center shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-300">
                    <div class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r <?php echo $member['gradient']; ?>"></div>
                    
                    <div class="mx-auto w-20 h-20 rounded-full bg-teal-50 dark:bg-teal-950/40 border-4 <?php echo $member['ring']; ?> flex items-center justify-center text-teal-600 dark:text-teal-400 shadow-inner mb-4 relative">
                        <i class="fa-solid fa-user-tie text-3xl"></i>
                        <span class="absolute -top-1 -right-1 w-7 h-7 rounded-full bg-gradient-to-tr from-teal-500 to-emerald-400 text-white border-2 border-white dark:border-slate-800 flex items-center justify-center text-xs shadow-md">
                            <i class="fa-solid <?php echo $member['icon']; ?>"></i>
                        </span>
                    </div>
                    
                    <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white"><?php echo htmlspecialchars($name); ?></h3>
                    <p class="text-xs font-semibold text-teal-600 dark:text-teal-400 mt-1"><?php echo htmlspecialchars($role); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Connection Arrow -->
        <div class="hidden md:flex justify-center items-center h-8">
            <div class="w-0.5 h-full bg-teal-500/40"></div>
        </div>

        <!-- Level 3: Representatives Grid (5 Columns / Columns wrap) -->
        <div>
            <h2 class="text-center text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6">
                <?php echo ($activeLang === 'th') ? 'ผู้แทนภาคการพัฒนาและเครือข่าย' : 'Sector Representatives'; ?>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <?php 
                $repMembers = array_slice($boardMembers, 3, 5);
                foreach ($repMembers as $member):
                    $name = ($activeLang === 'th') ? $member['name_th'] : $member['name_en'];
                    $role = ($activeLang === 'th') ? $member['role_th'] : $member['role_en'];
                ?>
                    <div class="relative overflow-hidden bg-white dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/60 rounded-2xl p-5 text-center shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-300">
                        <div class="absolute top-0 left-0 h-1.5 w-full bg-gradient-to-r <?php echo $member['gradient']; ?>"></div>
                        
                        <div class="mx-auto w-16 h-16 rounded-full bg-emerald-50 dark:bg-emerald-950/30 border-2 <?php echo $member['ring']; ?> flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-inner mb-3 relative">
                            <i class="fa-solid fa-user text-2xl"></i>
                            <span class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-400 text-white border-2 border-white dark:border-slate-800 flex items-center justify-center text-[10px] shadow-sm">
                                <i class="fa-solid <?php echo $member['icon']; ?>"></i>
                            </span>
                        </div>
                        
                        <h4 class="text-sm font-bold text-slate-850 dark:text-white line-clamp-1"><?php echo htmlspecialchars($name); ?></h4>
                        <p class="text-[10px] font-semibold text-emerald-600 dark:text-emerald-400 mt-1 line-clamp-2"><?php echo htmlspecialchars($role); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Connection Arrow -->
        <div class="hidden md:flex justify-center items-center h-8">
            <div class="w-0.5 h-full bg-slate-300 dark:bg-slate-700/60"></div>
        </div>

        <!-- Level 4: Expert Members Grid (4 Columns / 3 Columns) -->
        <div>
            <h2 class="text-center text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-6">
                <?php echo ($activeLang === 'th') ? 'คณะกรรมการผู้ทรงคุณวุฒิ' : 'Qualified Expert Committee Members'; ?>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php 
                $expertMembers = array_slice($boardMembers, 8);
                foreach ($expertMembers as $member):
                    $name = ($activeLang === 'th') ? $member['name_th'] : $member['name_en'];
                    $role = ($activeLang === 'th') ? $member['role_th'] : $member['role_en'];
                ?>
                    <div class="relative overflow-hidden bg-white dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700/50 rounded-2xl p-5 text-center shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-300">
                        <div class="absolute top-0 left-0 h-1 w-full bg-slate-400 dark:bg-slate-550"></div>
                        
                        <div class="mx-auto w-14 h-14 rounded-full bg-slate-50 dark:bg-slate-700/30 border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-500 dark:text-slate-400 shadow-inner mb-3 relative">
                            <i class="fa-solid fa-user text-xl"></i>
                        </div>
                        
                        <h4 class="text-xs font-bold text-slate-850 dark:text-white line-clamp-1"><?php echo htmlspecialchars($name); ?></h4>
                        <p class="text-[9px] font-semibold text-slate-500 dark:text-slate-400 mt-1 line-clamp-1"><?php echo htmlspecialchars($role); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>
