<?php
// views/frontend/info.php
// Renders the School Information Dashboard with teal/emerald theme, real-time DB data, and localization support

$activeLang = getActiveLang();

// General Stats variables with fallback values
$foundedDate = ($activeLang === 'th') 
    ? ($generalStats['founded_date_th']['stat_value'] ?? '1 มิถุนายน พ.ศ. 2482') 
    : ($generalStats['founded_date_en']['stat_value'] ?? 'June 1, 1939');

$educationLevels = ($activeLang === 'th') 
    ? ($generalStats['education_levels_th']['stat_value'] ?? 'มัธยมศึกษาปีที่ 1 - 6') 
    : ($generalStats['education_levels_en']['stat_value'] ?? 'Mathayom 1 - 6');

$address = ($activeLang === 'th') 
    ? ($generalStats['address_th']['stat_value'] ?? '123 ถ.วิทยาศาสตร์พัฒนา ต.ในเมือง อ.เมือง จ.ตาก 63000') 
    : ($generalStats['address_en']['stat_value'] ?? '123 Witthayasartpattana Rd., Nai Mueang, Mueang, Tak 63000');

$phone = $generalStats['phone']['stat_value'] ?? '055-123456';
$email = $generalStats['email']['stat_value'] ?? 'info@phichai.ac.th';

$coordinator = ($activeLang === 'th') 
    ? ($generalStats['coordinator_th']['stat_value'] ?? 'นายสมชาย ใจดี (ผู้ประสานงานหลัก)') 
    : ($generalStats['coordinator_en']['stat_value'] ?? 'Mr. Somchai Jaidee (Primary Coordinator)');

// Compute student totals
$totalStudents = 0;
$totalSpecial = 0;
$totalRegular = 0;
foreach ($studentStats as $gradeStat) {
    $totalStudents += $gradeStat['total'];
    $totalSpecial += $gradeStat['special'];
    $totalRegular += $gradeStat['regular'];
}

// Compute teacher totals
$totalTeachers = $teacherStats['total'] ?? 0;
?>

<main class="flex-grow container mx-auto px-4 py-8 md:py-12 max-w-7xl">
    <!-- Page Header -->
    <div class="mb-10 text-center md:text-left">
        <div class="flex items-center justify-center md:justify-start space-x-3 mb-2">
            <span class="h-1 w-10 bg-emerald-500 rounded-full"></span>
            <span class="text-xs font-semibold text-emerald-500 uppercase tracking-widest">
                <?php echo ($activeLang === 'th') ? 'ระบบข้อมูลสารสนเทศ' : 'Information System'; ?>
            </span>
        </div>
        <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-800 dark:text-white">
            <?php echo __('info_dashboard_title'); ?>
        </h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400 text-sm md:text-base max-w-2xl">
            <?php echo ($activeLang === 'th') 
                ? 'รายงานสถิติจำนวนบุคลากรครูและนักเรียนโรงเรียนพิชัย แบบเรียลไทม์เชื่อมตรงจากฐานข้อมูลหลัก' 
                : 'Real-time school personnel and student enrollment statistics queried directly from active databases.'; ?>
        </p>
    </div>

    <!-- Section 1: General Info Cards (Grid 3 Columns) -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <!-- Founded Date Card -->
        <div class="group relative overflow-hidden bg-white dark:bg-slate-800/80 backdrop-blur border border-slate-100 dark:border-slate-700/60 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-teal-400 to-emerald-500"></div>
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        <?php echo __('founded_date'); ?>
                    </h3>
                    <p class="mt-1 text-base md:text-lg font-bold text-slate-800 dark:text-slate-200">
                        <?php echo htmlspecialchars($foundedDate); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Levels Offered Card -->
        <div class="group relative overflow-hidden bg-white dark:bg-slate-800/80 backdrop-blur border border-slate-100 dark:border-slate-700/60 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-teal-400 to-emerald-500"></div>
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        <?php echo __('education_levels'); ?>
                    </h3>
                    <p class="mt-1 text-base md:text-lg font-bold text-slate-800 dark:text-slate-200">
                        <?php echo htmlspecialchars($educationLevels); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Address Card -->
        <div class="group relative overflow-hidden bg-white dark:bg-slate-800/80 backdrop-blur border border-slate-100 dark:border-slate-700/60 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="absolute top-0 left-0 h-1 w-full bg-gradient-to-r from-teal-400 to-emerald-500"></div>
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        <?php echo __('location_address'); ?>
                    </h3>
                    <p class="mt-1 text-sm md:text-base font-medium text-slate-800 dark:text-slate-200 line-clamp-2">
                        <?php echo htmlspecialchars($address); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Educational Personnel & Teacher Statistics (Two-Column Layout) -->
    <section class="mb-12">
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/60 rounded-3xl p-6 md:p-8 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-100 dark:border-slate-700/60 pb-6 mb-8">
                <div>
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white flex items-center">
                        <span class="inline-block w-2.5 h-6 bg-emerald-500 rounded-full mr-3"></span>
                        <?php echo __('teacher_stats_title'); ?>
                    </h2>
                    <p class="text-xs md:text-sm text-slate-400 dark:text-slate-500 mt-1">
                        <?php echo ($activeLang === 'th') 
                            ? 'สถิติจำนวนบุคลากรครูและวิทยฐานะอ้างอิงจากฐานข้อมูลบุคลากรปัจจุบัน' 
                            : 'Education officers and personnel count grouped by their academic ranks.'; ?>
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex items-baseline space-x-2">
                    <span class="text-3xl md:text-4xl font-black text-emerald-600 dark:text-emerald-400">
                        <?php echo number_format($totalTeachers); ?>
                    </span>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <?php echo ($activeLang === 'th') ? 'ราย' : 'Persons'; ?>
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Bar Chart & Visual breakdown (Left Side) -->
                <div class="lg:col-span-6 space-y-6">
                    <h3 class="text-sm font-semibold uppercase text-slate-400 tracking-wider">
                        <?php echo ($activeLang === 'th') ? 'สัดส่วนวิทยฐานะบุคลากร' : 'Personnel Ranks Ratio'; ?>
                    </h3>
                    <div class="space-y-4">
                        <?php 
                        $ranksList = [
                            ['key' => 'rank_assistant', 'count' => $teacherStats['assistant'], 'color' => 'bg-teal-400'],
                            ['key' => 'rank_teacher1', 'count' => $teacherStats['teacher1'], 'color' => 'bg-emerald-500'],
                            ['key' => 'rank_level2', 'count' => $teacherStats['level2'], 'color' => 'bg-cyan-500'],
                            ['key' => 'rank_level3', 'count' => $teacherStats['level3'], 'color' => 'bg-indigo-500'],
                            ['key' => 'rank_other', 'count' => $teacherStats['other'], 'color' => 'bg-slate-400']
                        ];
                        
                        foreach ($ranksList as $r):
                            $percent = $totalTeachers > 0 ? ($r['count'] / $totalTeachers) * 100 : 0;
                        ?>
                            <div>
                                <div class="flex justify-between items-center mb-1 text-xs md:text-sm font-semibold">
                                    <span class="text-slate-600 dark:text-slate-300"><?php echo __($r['key']); ?></span>
                                    <span class="text-slate-800 dark:text-white">
                                        <?php echo $r['count']; ?> <?php echo ($activeLang === 'th') ? 'ราย' : 'Persons'; ?> 
                                        <span class="text-slate-400 font-normal">(<?php echo number_format($percent, 1); ?>%)</span>
                                    </span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-slate-700 rounded-full h-2.5 overflow-hidden">
                                    <div class="<?php echo $r['color']; ?> h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: <?php echo $percent; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Numerical Table breakdown (Right Side) -->
                <div class="lg:col-span-6">
                    <div class="overflow-hidden border border-slate-100 dark:border-slate-700/60 rounded-2xl">
                        <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-700/60">
                            <thead class="bg-slate-50 dark:bg-slate-700/30">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        <?php echo __('academic_rank'); ?>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        <?php echo __('personnel_count'); ?>
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        <?php echo __('percentage'); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60 bg-white dark:bg-slate-800/40">
                                <?php foreach ($ranksList as $r): 
                                    $percent = $totalTeachers > 0 ? ($r['count'] / $totalTeachers) * 100 : 0;
                                ?>
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/10 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800 dark:text-slate-200">
                                            <?php echo __($r['key']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold text-slate-900 dark:text-white">
                                            <?php echo number_format($r['count']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-slate-500 dark:text-slate-400">
                                            <?php echo number_format($percent, 1); ?>%
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="bg-slate-50/50 dark:bg-slate-700/20 font-bold">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-800 dark:text-slate-200">
                                        <?php echo __('total_personnel'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-emerald-600 dark:text-emerald-400 font-extrabold">
                                        <?php echo number_format($totalTeachers); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-slate-900 dark:text-white">
                                        100.0%
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Student Statistics (Enrollment Numbers) -->
    <section class="mb-12">
        <div class="bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/60 rounded-3xl p-6 md:p-8 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-slate-100 dark:border-slate-700/60 pb-6 mb-8">
                <div>
                    <h2 class="text-xl md:text-2xl font-extrabold text-slate-800 dark:text-white flex items-center">
                        <span class="inline-block w-2.5 h-6 bg-emerald-500 rounded-full mr-3"></span>
                        <?php echo __('student_stats_title'); ?>
                    </h2>
                    <p class="text-xs md:text-sm text-slate-400 dark:text-slate-500 mt-1">
                        <?php echo ($activeLang === 'th') 
                            ? 'จำแนกชั้นเรียนตามหลักสูตรวิทยาศาตร์คณิตศาสตร์เข้มข้น (ESC) และกลุ่มภาคการศึกษาปกติ' 
                            : 'Statistics of student groups in special curriculum ESC and regular classes.'; ?>
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex items-baseline space-x-2">
                    <span class="text-3xl md:text-4xl font-black text-emerald-600 dark:text-emerald-400">
                        <?php echo number_format($totalStudents); ?>
                    </span>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <?php echo ($activeLang === 'th') ? 'คน' : 'Students'; ?>
                    </span>
                </div>
            </div>

            <!-- Dashboard student grids (M.1 - M.6) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php 
                for ($g = 1; $g <= 6; $g++): 
                    $stat = $studentStats[$g] ?? ['special' => 0, 'regular' => 0, 'total' => 0];
                ?>
                    <div class="relative overflow-hidden bg-slate-50 dark:bg-slate-900/35 border border-slate-100 dark:border-slate-800/80 rounded-2xl p-5 hover:border-emerald-300 dark:hover:border-emerald-700/40 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 text-xs font-bold rounded-lg">
                                <?php echo ($activeLang === 'th') ? "มัธยมศึกษาปีที่ $g" : "Mathayom $g"; ?>
                            </span>
                            <div class="text-slate-400 dark:text-slate-500 text-xs font-semibold">
                                <?php echo ($activeLang === 'th') ? 'รวม' : 'Total'; ?>: 
                                <span class="text-sm font-bold text-slate-800 dark:text-slate-200"><?php echo number_format($stat['total']); ?></span>
                            </div>
                        </div>

                        <!-- Data Breakdown Rows -->
                        <div class="space-y-3">
                            <!-- Special (ESC) -->
                            <div class="flex justify-between items-center text-xs md:text-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2.5 h-2.5 bg-teal-400 rounded-full"></span>
                                    <span class="text-slate-600 dark:text-slate-300"><?php echo __('special_esc'); ?></span>
                                </div>
                                <span class="font-bold text-slate-800 dark:text-white">
                                    <?php echo number_format($stat['special']); ?> <?php echo ($activeLang === 'th') ? 'คน' : 'Students'; ?>
                                </span>
                            </div>

                            <!-- Regular -->
                            <div class="flex justify-between items-center text-xs md:text-sm">
                                <div class="flex items-center space-x-2">
                                    <span class="w-2.5 h-2.5 bg-slate-400 rounded-full"></span>
                                    <span class="text-slate-600 dark:text-slate-300"><?php echo __('regular_program'); ?></span>
                                </div>
                                <span class="font-bold text-slate-800 dark:text-white">
                                    <?php echo number_format($stat['regular']); ?> <?php echo ($activeLang === 'th') ? 'คน' : 'Students'; ?>
                                </span>
                            </div>
                        </div>

                        <!-- Mini progress representation -->
                        <?php 
                        $pctSpecial = $stat['total'] > 0 ? ($stat['special'] / $stat['total']) * 100 : 0;
                        ?>
                        <div class="mt-4 w-full bg-slate-200/50 dark:bg-slate-700/60 rounded-full h-1.5 overflow-hidden flex">
                            <div class="bg-teal-400 h-full" style="width: <?php echo $pctSpecial; ?>%"></div>
                            <div class="bg-slate-400 h-full flex-grow"></div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            
            <!-- Summary Footnote -->
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-around bg-slate-50 dark:bg-slate-700/20 border border-slate-100 dark:border-slate-700/60 p-5 rounded-2xl text-center sm:text-left gap-4">
                <div class="flex items-center space-x-3">
                    <div class="p-2.5 bg-teal-500/10 text-teal-600 dark:text-teal-400 rounded-xl">
                        <i class="fa-solid fa-users-viewfinder text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wider"><?php echo ($activeLang === 'th') ? 'ยอดรวมพิเศษ ESC ทั้งประเทศ' : 'Total Special Program (ESC)'; ?></div>
                        <div class="text-lg font-bold text-slate-800 dark:text-slate-200"><?php echo number_format($totalSpecial); ?> <?php echo ($activeLang === 'th') ? 'คน' : 'Students'; ?></div>
                    </div>
                </div>
                
                <div class="hidden sm:block h-8 w-px bg-slate-200 dark:bg-slate-700"></div>

                <div class="flex items-center space-x-3">
                    <div class="p-2.5 bg-slate-500/10 text-slate-600 dark:text-slate-400 rounded-xl">
                        <i class="fa-solid fa-users text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wider"><?php echo ($activeLang === 'th') ? 'ยอดรวมห้องเรียนปกติ' : 'Total Regular Program'; ?></div>
                        <div class="text-lg font-bold text-slate-800 dark:text-slate-200"><?php echo number_format($totalRegular); ?> <?php echo ($activeLang === 'th') ? 'คน' : 'Students'; ?></div>
                    </div>
                </div>

                <div class="hidden sm:block h-8 w-px bg-slate-200 dark:bg-slate-700"></div>

                <div class="flex items-center space-x-3">
                    <div class="p-2.5 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl">
                        <i class="fa-solid fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <div class="text-xs text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-wider"><?php echo __('total_students_overall'); ?></div>
                        <div class="text-lg font-bold text-emerald-600 dark:text-emerald-400"><?php echo number_format($totalStudents); ?> <?php echo ($activeLang === 'th') ? 'คน' : 'Students'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Contact & Coordinator Bar -->
    <section>
        <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white rounded-3xl p-6 md:p-8 shadow-md">
            <h2 class="text-lg md:text-xl font-bold mb-6 flex items-center">
                <i class="fa-solid fa-address-book mr-3"></i>
                <?php echo __('contact_coordinator'); ?>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Telephone -->
                <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/15 transition-all">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-white">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <span class="block text-xs text-emerald-200 font-semibold uppercase tracking-wide">
                            <?php echo __('phone_number'); ?>
                        </span>
                        <a href="tel:<?php echo htmlspecialchars($phone); ?>" class="text-sm md:text-base font-bold hover:underline">
                            <?php echo htmlspecialchars($phone); ?>
                        </a>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/15 transition-all">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-white">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <span class="block text-xs text-emerald-200 font-semibold uppercase tracking-wide">
                            <?php echo __('email_address'); ?>
                        </span>
                        <a href="mailto:<?php echo htmlspecialchars($email); ?>" class="text-sm md:text-base font-bold hover:underline">
                            <?php echo htmlspecialchars($email); ?>
                        </a>
                    </div>
                </div>

                <!-- Coordinator -->
                <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-sm p-4 rounded-2xl border border-white/10 hover:bg-white/15 transition-all">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center flex-shrink-0 text-white">
                        <i class="fa-solid fa-circle-user"></i>
                    </div>
                    <div>
                        <span class="block text-xs text-emerald-200 font-semibold uppercase tracking-wide">
                            <?php echo __('coordinator_name'); ?>
                        </span>
                        <span class="text-sm md:text-base font-bold">
                            <?php echo htmlspecialchars($coordinator); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
