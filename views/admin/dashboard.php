<!-- views/admin/dashboard.php -->
<!-- Administrative Control Panel View -->

<!-- views/admin/dashboard.php -->
<!-- Administrative Control Panel View -->

<!DOCTYPE html>
<html lang="th" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบหลังบ้านแอดมิน | <?php echo SCHOOL_NAME; ?></title>
    
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Sarabun', 'sans-serif'],
                        english: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>css/style.css">

    <!-- Dynamic Favicon Integration -->
    <?php if (!empty(SCHOOL_FAVICON)): ?>
        <link rel="shortcut icon" href="<?php echo UPLOAD_URL . SCHOOL_FAVICON; ?>" type="image/x-icon">
    <?php endif; ?>

    <!-- Immediate Theme Init Script to prevent screen flashing -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('school_theme') || 'dark';
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="bg-gradient-mesh min-h-screen text-slate-800 dark:text-slate-100 font-sans flex flex-col transition-colors duration-300">

    <!-- Admin Top Navbar -->
    <nav class="sticky top-0 z-50 glass-nav shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Branding -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center border border-indigo-400/20 shadow-md">
                        <span class="text-white font-english font-black text-sm"><?php echo SCHOOL_SHORT_NAME; ?></span>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-slate-900 dark:text-white tracking-wide leading-tight">ระบบบริหารจัดการหลังบ้าน</span>
                        <span class="text-[9px] text-slate-500 dark:text-slate-400 font-english mt-0.5"><?php echo SCHOOL_NAME_EN; ?></span>
                    </div>
                </div>

                <!-- Navigation Portal links -->
                <div class="flex items-center gap-3">
                    <a href="<?php echo BASE_URL; ?>admin/settings" class="px-4 py-2 bg-indigo-600/10 hover:bg-indigo-600/20 border border-indigo-500/20 rounded-xl text-xs font-semibold text-indigo-600 dark:text-indigo-300 transition-all duration-300">
                        <i class="fa-solid fa-cog mr-1.5"></i>ตั้งค่าระบบ
                    </a>
                    <a href="<?php echo BASE_URL; ?>" target="_blank" class="px-4 py-2 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 hover:border-slate-400 dark:hover:border-white/20 rounded-xl text-xs font-semibold text-slate-700 dark:text-white transition-all duration-300">
                        <i class="fa-solid fa-globe mr-1.5"></i>ดูหน้าเว็บหลัก
                    </a>
                    
                    <!-- Dark/Light Theme Switcher Button -->
                    <button onclick="toggleDarkMode()" class="p-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 rounded-xl text-xs font-semibold text-slate-700 dark:text-white transition-all duration-300 flex items-center justify-center" title="สลับโหมด สีสว่าง/สีมืด">
                        <i id="theme-icon" class="fa-solid fa-moon"></i>
                    </button>
                    
                    <span class="text-xs text-slate-400 dark:text-slate-600 font-english">|</span>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-slate-700 dark:text-slate-300 font-semibold bg-slate-100 dark:bg-white/5 border border-slate-300 dark:border-white/10 px-3 py-1.5 rounded-xl">
                            <i class="fa-solid fa-user text-indigo-500 dark:text-indigo-400 mr-1.5"></i><?php echo htmlspecialchars($_SESSION['fullname']); ?>
                        </span>
                        <a href="<?php echo BASE_URL; ?>logout" class="px-4 py-2 bg-red-600/10 dark:bg-red-600/20 border border-red-500/20 dark:border-red-500/30 text-red-600 dark:text-red-300 hover:bg-red-600/20 dark:hover:bg-red-600/30 rounded-xl text-xs font-semibold transition-all duration-300">
                            <i class="fa-solid fa-sign-out-alt mr-1.5"></i>ออกจากระบบ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 flex-grow w-full space-y-8">
        
        <!-- Alerts Display (Success/Error) -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="p-4 bg-emerald-500/10 dark:bg-emerald-900/30 border border-emerald-500/20 dark:border-emerald-500/30 rounded-2xl text-emerald-600 dark:text-emerald-300 text-xs flex items-center gap-2.5 shadow-xl animate-fade-in-up">
                <i class="fa-solid fa-circle-check text-base"></i>
                <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['success']); ?></span>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="p-4 bg-red-500/10 dark:bg-red-900/30 border border-red-500/20 dark:border-red-500/30 rounded-2xl text-red-600 dark:text-red-300 text-xs flex items-center gap-2.5 shadow-xl animate-fade-in-up">
                <i class="fa-solid fa-circle-exclamation text-base"></i>
                <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['error']); ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Welcome Banner & Summary Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Summary 1: Welcome -->
            <div class="col-span-1 md:col-span-2 glass-card p-6 rounded-3xl flex flex-col justify-between shadow-lg">
                <div class="space-y-1">
                    <span class="text-[10px] text-indigo-600 dark:text-indigo-400 font-bold uppercase tracking-wider">Control Center</span>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">สวัสดี, ครู <?php echo htmlspecialchars($_SESSION['fullname']); ?></h1>
                    <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed max-w-sm">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลหลังบ้าน คุณสามารถโพสต์ข่าวสารอัปเดต และดำเนินการอัปโหลดไฟล์/แก้ไขลิงก์ตัวชี้วัด ITA ได้จากที่นี่</p>
                </div>
                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <div class="mt-4 pt-2">
                    <a href="<?php echo BASE_URL; ?>admin/settings" class="inline-flex items-center gap-1.5 px-4.5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white rounded-xl text-xs font-bold shadow-md hover:shadow-indigo-500/20 transition-all duration-200">
                        <i class="fa-solid fa-cog"></i> ตั้งค่าเว็บไซต์พื้นฐาน (Site Settings)
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Summary 2: News Metrics -->
            <div class="glass-card p-6 rounded-3xl flex flex-col justify-between shadow-lg">
                <span class="text-slate-500 dark:text-slate-400 text-[10px] uppercase font-bold tracking-wider">News Count</span>
                <div class="mt-4">
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white font-english"><?php echo count($allNews); ?> <span class="text-xs text-slate-500 dark:text-slate-400 font-normal font-sans">โพสต์</span></h2>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-1">จำนวนข้อมูลข่าวสารและกิจกรรมทั้งหมด</p>
                </div>
            </div>

            <!-- Summary 3: ITA Completion Metrics -->
            <div class="glass-card p-6 rounded-3xl flex flex-col justify-between shadow-lg">
                <span class="text-slate-500 dark:text-slate-400 text-[10px] uppercase font-bold tracking-wider">ITA Progress</span>
                <div class="mt-4">
                    <?php 
                    $completed = $itaMetrics['completed'] ?? 0;
                    $total = $itaMetrics['total'] ?? 43;
                    $percent = $total > 0 ? round(($completed / $total) * 100, 1) : 0;
                    ?>
                    <h2 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 font-english"><?php echo $percent; ?>%</h2>
                    <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-1">เผยแพร่แล้ว <?php echo $completed; ?> จาก <?php echo $total; ?> ตัวชี้วัด</p>
                </div>
            </div>
        </div>

        <!-- System Tab Navigation -->
        <?php
        $activeTab = $_GET['tab'] ?? 'news';
        ?>
        <div class="flex border-b border-slate-200 dark:border-white/5 gap-2 overflow-x-auto">
            <a href="?tab=news" class="px-6 py-3.5 text-xs font-semibold border-b-2 transition-all duration-300 shrink-0 <?php echo $activeTab === 'news' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400 bg-slate-100 dark:bg-white/5 rounded-t-xl' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white'; ?>">
                <i class="fa-regular fa-newspaper mr-2"></i>ระบบจัดการข่าวสารและกิจกรรม
            </a>
            <a href="?tab=ita" class="px-6 py-3.5 text-xs font-semibold border-b-2 transition-all duration-300 shrink-0 <?php echo $activeTab === 'ita' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400 bg-slate-100 dark:bg-white/5 rounded-t-xl' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white'; ?>">
                <i class="fa-solid fa-chart-bar mr-2"></i>ระบบประเมิน ITA Online (O1 - O43)
            </a>
            <a href="?tab=hero" class="px-6 py-3.5 text-xs font-semibold border-b-2 transition-all duration-300 shrink-0 <?php echo $activeTab === 'hero' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400 bg-slate-100 dark:bg-white/5 rounded-t-xl' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white'; ?>">
                <i class="fa-regular fa-images mr-2"></i>ระบบจัดการรูปภาพสไลด์หน้าแรก (Hero Carousel)
            </a>
            <a href="?tab=ticker" class="px-6 py-3.5 text-xs font-semibold border-b-2 transition-all duration-300 shrink-0 <?php echo $activeTab === 'ticker' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400 bg-slate-100 dark:bg-white/5 rounded-t-xl' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white'; ?>">
                <i class="fa-solid fa-bullhorn mr-2"></i>ข่าวด่วนวิ่งใต้แถบเมนู (Scrolling Ticker)
            </a>
            <a href="?tab=about" class="px-6 py-3.5 text-xs font-semibold border-b-2 transition-all duration-300 shrink-0 <?php echo $activeTab === 'about' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400 bg-slate-100 dark:bg-white/5 rounded-t-xl' : 'border-transparent text-slate-500 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white'; ?>">
                <i class="fa-solid fa-info-circle mr-2"></i>จัดการข้อมูลแนะนำโรงเรียน (About)
            </a>
        </div>

        <!-- Tab 1 Panel: News Management -->
        <?php if ($activeTab === 'news'): ?>
            <div class="space-y-6">
                <!-- Action Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">ตารางข้อมูลข่าวสารและกิจกรรม</h2>
                        <p class="text-slate-500 dark:text-slate-400 text-xs">คุณสามารถ ค้นหา เพิ่ม แก้ไข หรือลบข้อมูลการประชาสัมพันธ์ของโรงเรียนได้</p>
                    </div>
                    <button onclick="openCreateNewsModal()" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white text-xs font-bold rounded-xl shadow-lg hover:shadow-indigo-500/20 transition-all duration-200">
                        <i class="fa-solid fa-plus mr-1.5"></i> เพิ่มข่าวสารประชาสัมพันธ์
                    </button>
                </div>

                <!-- News Grid / Table List -->
                <div class="glass-card rounded-3xl overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-950/60 border-b border-slate-200 dark:border-white/10 text-[11px] font-semibold text-slate-600 dark:text-slate-300 tracking-wider">
                                    <th class="py-4 px-6 text-center w-24">รูปภาพ</th>
                                    <th class="py-4 px-6">หัวข้อข่าว</th>
                                    <th class="py-4 px-6 text-center w-36">ประเภทข่าว</th>
                                    <th class="py-4 px-6 text-center w-40">วันที่บันทึก</th>
                                    <th class="py-4 px-6 text-center w-36">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/5 text-xs text-slate-600 dark:text-slate-300">
                                <?php if (empty($allNews)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-16">
                                            <i class="fa-regular fa-folder-open text-3xl text-slate-400 mb-3"></i>
                                            <p class="text-slate-500 dark:text-slate-400">ยังไม่มีรายการข่าวสารที่สร้างไว้ในระบบ</p>
                                        </td>
                                    </tr>
                                <?php else: 
                                    foreach ($allNews as $news): 
                                        $catLabel = 'ทั่วไป';
                                        $catColor = 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20';
                                        if ($news['category'] === 'announcement') {
                                            $catLabel = 'ประกาศ';
                                            $catColor = 'bg-red-500/10 text-red-600 dark:text-red-400 border-red-500/20';
                                        } elseif ($news['category'] === 'activity') {
                                            $catLabel = 'กิจกรรม';
                                            $catColor = 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20';
                                        }
                                ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                                        <!-- Image Thumbnail -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="w-12 h-12 rounded-lg bg-slate-200 dark:bg-slate-950 border border-slate-300 dark:border-white/10 overflow-hidden mx-auto flex items-center justify-center shadow-inner">
                                                <?php if (!empty($news['image_url'])): ?>
                                                    <img src="<?php echo htmlspecialchars($news['image_url']); ?>" alt="thumbnail" class="w-full h-full object-cover">
                                                <?php else: ?>
                                                    <i class="fa-regular fa-image text-slate-400 dark:text-slate-600"></i>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <!-- Title -->
                                        <td class="py-3 px-6 font-semibold text-slate-800 dark:text-white max-w-sm truncate">
                                            <?php echo htmlspecialchars($news['title']); ?>
                                        </td>
                                        <!-- Category -->
                                        <td class="py-3 px-6 text-center">
                                            <span class="px-2.5 py-1 rounded-md text-[10px] font-semibold border <?php echo $catColor; ?>">
                                                <?php echo $catLabel; ?>
                                            </span>
                                        </td>
                                        <!-- Created At -->
                                        <td class="py-3 px-6 text-center text-slate-500 dark:text-slate-400 font-english">
                                            <?php echo date('d/m/Y H:i', strtotime($news['created_at'])); ?>
                                        </td>
                                        <!-- Actions -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="openEditNewsModal(<?php echo htmlspecialchars(json_encode($news)); ?>)" class="p-2 bg-indigo-600/10 hover:bg-indigo-600/30 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-xl hover:text-indigo-700 dark:hover:text-indigo-300 transition-all duration-200" title="แก้ไข">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                                <a href="<?php echo BASE_URL; ?>admin/news/delete?id=<?php echo $news['id']; ?>" onclick="return confirm('คุณต้องการลบข่าวสารนี้ใช่หรือไม่?')" class="p-2 bg-red-600/10 hover:bg-red-600/30 text-red-600 dark:text-red-400 border border-red-500/20 rounded-xl hover:text-red-700 dark:hover:text-red-300 transition-all duration-200" title="ลบ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
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
            </div>
        <?php endif; ?>

        <!-- Tab 2 Panel: ITA Management -->
        <?php if ($activeTab === 'ita'): ?>
            <div class="space-y-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">ระบบจัดการตัวชี้วัดความโปร่งใส ITA (O1 - O43)</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-xs">ระบุคำอธิบาย รายละเอียดลิงก์ภายนอก หรืออัปโหลดไฟล์เอกสารประกอบตามตัวชี้วัด OIT แต่ละข้อ</p>
                </div>

                <div class="glass-card rounded-3xl overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-950/60 border-b border-slate-200 dark:border-white/10 text-[11px] font-semibold text-slate-600 dark:text-slate-300 tracking-wider">
                                    <th class="py-4 px-6 text-center w-24">รหัส OIT</th>
                                    <th class="py-4 px-6">ชื่อตัวชี้วัด / หัวข้อประเมิน</th>
                                    <th class="py-4 px-6">ข้อมูลที่เผยแพร่</th>
                                    <th class="py-4 px-6 text-center w-24">สถานะ</th>
                                    <th class="py-4 px-6 text-center w-24">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/5 text-xs text-slate-600 dark:text-slate-300">
                                <?php foreach ($itaItems as $item): ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                                        <!-- Code -->
                                        <td class="py-3.5 px-6 text-center font-english font-bold text-indigo-600 dark:text-indigo-400">
                                            <span class="bg-indigo-500/10 px-2.5 py-1.5 rounded-lg border border-indigo-500/20">
                                                <?php echo htmlspecialchars($item['code']); ?>
                                            </span>
                                        </td>
                                        <!-- Name -->
                                        <td class="py-3.5 px-6 font-semibold text-slate-800 dark:text-white max-w-sm truncate">
                                            <?php echo htmlspecialchars($item['name']); ?>
                                        </td>
                                        <!-- Published Info status -->
                                        <td class="py-3.5 px-6 space-y-1">
                                            <?php if (!empty($item['file_path'])): ?>
                                                <div class="flex items-center gap-1.5 text-[11px] text-red-500 dark:text-red-400">
                                                    <i class="fa-regular fa-file-pdf shrink-0"></i>
                                                    <span class="truncate max-w-[200px]"><?php echo basename($item['file_path']); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if (!empty($item['link_url'])): ?>
                                                <div class="flex items-center gap-1.5 text-[11px] text-indigo-600 dark:text-indigo-400">
                                                    <i class="fa-solid fa-link shrink-0"></i>
                                                    <span class="truncate max-w-[200px]"><?php echo htmlspecialchars($item['link_url']); ?></span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (empty($item['file_path']) && empty($item['link_url'])): ?>
                                                <span class="text-slate-400 dark:text-slate-500 italic text-[10px]">ยังไม่ได้อัปโหลดข้อมูล</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Status Badge -->
                                        <td class="py-3.5 px-6 text-center">
                                            <?php if ($item['status'] === 'published'): ?>
                                                <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 text-[10px] font-semibold">เผยแพร่</span>
                                            <?php else: ?>
                                                <span class="px-2 py-0.5 rounded bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 text-[10px] font-semibold">ฉบับร่าง</span>
                                            <?php endif; ?>
                                        </td>
                                        <!-- Action -->
                                        <td class="py-3.5 px-6 text-center">
                                            <button onclick="openEditItaModal(<?php echo htmlspecialchars(json_encode($item)); ?>)" class="p-2 bg-indigo-600/10 hover:bg-indigo-600/30 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-xl hover:text-indigo-700 dark:hover:text-indigo-300 transition-all duration-200">
                                                <i class="fa-solid fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Tab 3 Panel: Hero Carousel Management -->
        <?php if ($activeTab === 'hero'): ?>
            <div class="space-y-6">
                <!-- Action Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">ตารางข้อมูลสไลด์หน้าแรก (Hero Carousel)</h2>
                        <p class="text-slate-500 dark:text-slate-400 text-xs">คุณสามารถ เพิ่ม ลบ แก้ไข หรือเปิด/ปิดการแสดงผลรูปภาพสไลด์แนะนำของโรงเรียนได้จากตารางนี้</p>
                    </div>
                    <button onclick="openCreateHeroModal()" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white text-xs font-bold rounded-xl shadow-lg hover:shadow-indigo-500/20 transition-all duration-200">
                        <i class="fa-solid fa-plus mr-1.5"></i> เพิ่มรูปภาพสไลด์
                    </button>
                </div>

                <!-- Hero Grid / Table List -->
                <div class="glass-card rounded-3xl overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-950/60 border-b border-slate-200 dark:border-white/10 text-[11px] font-semibold text-slate-600 dark:text-slate-300 tracking-wider">
                                    <th class="py-4 px-6 text-center w-24">รูปภาพ</th>
                                    <th class="py-4 px-6">ชื่ออ้างอิงสไลด์</th>
                                    <th class="py-4 px-6 text-center w-32">ลำดับการแสดงผล</th>
                                    <th class="py-4 px-6 text-center w-36">สถานะการแสดงผล</th>
                                    <th class="py-4 px-6 text-center w-36">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/5 text-xs text-slate-600 dark:text-slate-300">
                                <?php if (empty($allHeroes)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-16">
                                            <i class="fa-regular fa-images text-3xl text-slate-400 mb-3"></i>
                                            <p class="text-slate-500 dark:text-slate-400">ยังไม่มีข้อมูลรูปภาพสไลด์ในระบบ</p>
                                        </td>
                                    </tr>
                                <?php else: 
                                    foreach ($allHeroes as $hero): 
                                ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                                        <!-- Slide Image Thumbnail -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="w-20 h-10 rounded-lg bg-slate-200 dark:bg-slate-950 border border-slate-300 dark:border-white/10 overflow-hidden mx-auto flex items-center justify-center shadow-inner">
                                                <img src="<?php echo htmlspecialchars($hero['image_url']); ?>" alt="slide thumbnail" class="w-full h-full object-cover">
                                            </div>
                                        </td>
                                        <!-- Slide Title -->
                                        <td class="py-3 px-6 font-semibold text-slate-800 dark:text-white max-w-sm truncate">
                                            <?php echo !empty($hero['title']) ? htmlspecialchars($hero['title']) : '<span class="text-slate-400 italic">ไม่ระบุชื่อสไลด์</span>'; ?>
                                        </td>
                                        <!-- Display Order -->
                                        <td class="py-3 px-6 text-center font-english font-semibold">
                                            <?php echo (int)$hero['display_order']; ?>
                                        </td>
                                        <!-- Display Status Badge / Toggle Link -->
                                        <td class="py-3 px-6 text-center">
                                            <a href="<?php echo BASE_URL; ?>admin/hero/toggle?id=<?php echo $hero['id']; ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-[10px] font-semibold border transition-all duration-300 <?php echo $hero['status'] === 'active' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20 hover:bg-emerald-500/20' : 'bg-slate-500/10 text-slate-500 dark:text-slate-400 border-slate-500/20 hover:bg-slate-500/20'; ?>" title="คลิกเพื่อเปิด/ปิดการแสดงผลสไลด์">
                                                <span class="flex h-1.5 w-1.5 relative">
                                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 <?php echo $hero['status'] === 'active' ? 'bg-emerald-500' : 'bg-slate-400'; ?>"></span>
                                                </span>
                                                <?php echo $hero['status'] === 'active' ? 'แสดงผล (Active)' : 'ซ่อนไว้ (Inactive)'; ?>
                                            </a>
                                        </td>
                                        <!-- Actions -->
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="openEditHeroModal(<?php echo htmlspecialchars(json_encode($hero)); ?>)" class="p-2 bg-indigo-600/10 hover:bg-indigo-600/30 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-xl hover:text-indigo-700 dark:hover:text-indigo-300 transition-all duration-200" title="แก้ไข">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                                <a href="<?php echo BASE_URL; ?>admin/hero/delete?id=<?php echo $hero['id']; ?>" onclick="return confirm('คุณต้องการลบรูปภาพสไลด์นี้ใช่หรือไม่?')" class="p-2 bg-red-600/10 hover:bg-red-600/30 text-red-600 dark:text-red-400 border border-red-500/20 rounded-xl hover:text-red-700 dark:hover:text-red-300 transition-all duration-200" title="ลบ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
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
            </div>
        <?php endif; ?>

        <!-- Tab 4 Panel: Urgent News Ticker Management -->
        <?php if ($activeTab === 'ticker'): ?>
            <div class="space-y-6 animate-fade-in-up">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">ข่าวด่วนวิ่งใต้แถบเมนู (Scrolling Ticker)</h2>
                        <p class="text-slate-500 dark:text-slate-400 text-xs">คุณสามารถ เพิ่ม ลบ แก้ไข ข้อมูลที่เป็นข้อความวิ่งข่าวด่วนแสดงใต้เมนูเพื่อแจ้งเตือนเรื่องสำคัญ</p>
                    </div>
                    <button onclick="openCreateTickerModal()" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white text-xs font-bold rounded-xl shadow-lg hover:shadow-indigo-500/20 transition-all duration-200">
                        <i class="fa-solid fa-plus mr-1.5"></i> เพิ่มข่าวด่วนวิ่ง
                    </button>
                </div>

                <div class="glass-card rounded-3xl overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-950/60 border-b border-slate-200 dark:border-white/10 text-[11px] font-semibold text-slate-600 dark:text-slate-300 tracking-wider">
                                    <th class="py-4 px-6">ข้อความข่าววิ่ง</th>
                                    <th class="py-4 px-6">ลิงก์คลิกไปหน้าอื่น (ถ้ามี)</th>
                                    <th class="py-4 px-6 text-center w-36">สถานะการแสดงผล</th>
                                    <th class="py-4 px-6 text-center w-36">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-white/5 text-xs text-slate-600 dark:text-slate-300">
                                <?php if (empty($allTickers)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-16">
                                            <i class="fa-solid fa-bullhorn text-3xl text-slate-400 mb-3"></i>
                                            <p class="text-slate-500 dark:text-slate-400">ยังไม่มีข้อมูลข้อความข่าวด่วนในระบบ</p>
                                        </td>
                                    </tr>
                                <?php else: 
                                    foreach ($allTickers as $ticker): 
                                ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                                        <td class="py-3 px-6 font-semibold text-slate-800 dark:text-white max-w-md truncate">
                                            <?php echo htmlspecialchars($ticker['message']); ?>
                                        </td>
                                        <td class="py-3 px-6 text-slate-500 dark:text-slate-400 truncate max-w-xs">
                                            <?php echo !empty($ticker['link_url']) ? '<a href="'.htmlspecialchars($ticker['link_url']).'" target="_blank" class="text-indigo-500 hover:underline">'.htmlspecialchars($ticker['link_url']).'</a>' : '<span class="text-slate-400 italic">ไม่มีลิงก์</span>'; ?>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <a href="<?php echo BASE_URL; ?>admin/ticker/toggle?id=<?php echo $ticker['id']; ?>" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-[10px] font-semibold border transition-all duration-300 <?php echo (int)$ticker['is_active'] === 1 ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20 hover:bg-emerald-500/20' : 'bg-slate-500/10 text-slate-500 dark:text-slate-400 border-slate-500/20 hover:bg-slate-500/20'; ?>" title="คลิกเพื่อสลับแสดง/ซ่อน">
                                                <span class="flex h-1.5 w-1.5 relative">
                                                    <span class="relative inline-flex rounded-full h-1.5 w-1.5 <?php echo (int)$ticker['is_active'] === 1 ? 'bg-emerald-500' : 'bg-slate-400'; ?>"></span>
                                                </span>
                                                <?php echo (int)$ticker['is_active'] === 1 ? 'แสดงผล (Active)' : 'ซ่อนไว้ (Inactive)'; ?>
                                            </a>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button onclick="openEditTickerModal(<?php echo htmlspecialchars(json_encode($ticker)); ?>)" class="p-2 bg-indigo-600/10 hover:bg-indigo-600/30 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-xl hover:text-indigo-700 dark:hover:text-indigo-300 transition-all duration-200" title="แก้ไข">
                                                    <i class="fa-solid fa-edit"></i>
                                                </button>
                                                <a href="<?php echo BASE_URL; ?>admin/ticker/delete?id=<?php echo $ticker['id']; ?>" onclick="return confirm('คุณต้องการลบข้อความข่าวด่วนนี้ใช่หรือไม่?')" class="p-2 bg-red-600/10 hover:bg-red-600/30 text-red-600 dark:text-red-400 border border-red-500/20 rounded-xl hover:text-red-700 dark:hover:text-red-300 transition-all duration-200" title="ลบ">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
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
            </div>
        <?php endif; ?>

        <!-- Tab 5 Panel: About School Management -->
        <?php if ($activeTab === 'about'): ?>
            <div class="space-y-6">
                <!-- Action Header -->
                <div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">ระบบจัดการข้อมูลแนะนำโรงเรียน (About School)</h2>
                    <p class="text-slate-500 dark:text-slate-400 text-xs">แก้ไขข้อมูลประวัติความเป็นมา วิสัยทัศน์/พันธกิจ เพลงประจำโรงเรียน และโครงสร้างที่แสดงบนหน้าหลักและเมนูแนะนำโรงเรียน</p>
                </div>

                <!-- About Info Table List -->
                <div class="glass-card rounded-3xl overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-950/60 border-b border-slate-200 dark:border-white/10 text-[11px] font-semibold text-slate-600 dark:text-slate-300 tracking-wider">
                                    <th class="py-4 px-6 w-1/4">หัวข้อข้อมูลแนะนำ</th>
                                    <th class="py-4 px-6">ตัวอย่างเนื้อหา (Preview)</th>
                                    <th class="py-4 px-6 text-center w-40">แก้ไขล่าสุด</th>
                                    <th class="py-4 px-6 text-center w-40">การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sectionNames = [
                                    'history' => 'ประวัติความเป็นมา (History)',
                                    'vision_mission' => 'วิสัยทัศน์และพันธกิจ (Vision & Mission)',
                                    'symbol' => 'ตราสัญลักษณ์โรงเรียน (School Symbol)',
                                    'colors' => 'สีประจำโรงเรียน (School Colors)',
                                    'song' => 'เพลงประจำโรงเรียน (School Song)',
                                    'structure' => 'โครงสร้างองค์กร (School Structure)'
                                ];

                                if (!empty($aboutSections)):
                                    foreach ($aboutSections as $section):
                                        $key = $section['section_key'];
                                        $title = $sectionNames[$key] ?? $key;
                                ?>
                                    <!-- Store original values safely in hidden textareas to prevent JS injection/quoting issues -->
                                    <textarea id="about-content-th-<?php echo htmlspecialchars($key); ?>" class="hidden"><?php echo htmlspecialchars($section['content_th']); ?></textarea>
                                    <textarea id="about-content-en-<?php echo htmlspecialchars($key); ?>" class="hidden"><?php echo htmlspecialchars($section['content_en']); ?></textarea>

                                    <tr class="border-b border-slate-200 dark:border-white/10 hover:bg-slate-100/50 dark:hover:bg-white/5 transition-colors">
                                        <td class="py-4 px-6 font-semibold text-xs text-slate-900 dark:text-white">
                                            <?php echo htmlspecialchars($title); ?>
                                            <div class="text-[9px] text-slate-400 dark:text-slate-500 font-mono mt-0.5"><?php echo htmlspecialchars($key); ?></div>
                                        </td>
                                        <td class="py-4 px-6 text-xs text-slate-600 dark:text-slate-300">
                                            <div class="line-clamp-2 max-w-xl">
                                                <span class="text-indigo-600 dark:text-indigo-400 font-semibold mr-1">TH:</span><?php echo htmlspecialchars(mb_strimwidth(strip_tags($section['content_th']), 0, 120, '...')); ?>
                                            </div>
                                            <div class="line-clamp-2 max-w-xl mt-1 text-slate-400">
                                                <span class="text-indigo-400/80 font-semibold mr-1">EN:</span><?php echo htmlspecialchars(mb_strimwidth(strip_tags($section['content_en']), 0, 120, '...')); ?>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-center text-xs font-mono text-slate-500 dark:text-slate-400">
                                            <?php echo date('d/m/Y H:i', strtotime($section['updated_at'])); ?>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <button onclick="openEditAboutModal(<?php echo htmlspecialchars(json_encode([
                                                'key' => $key,
                                                'title' => $title
                                            ])); ?>)" class="px-3 py-2 bg-indigo-600/10 hover:bg-indigo-600/30 text-indigo-600 dark:text-indigo-400 border border-indigo-500/20 rounded-xl hover:text-indigo-700 dark:hover:text-indigo-300 transition-all duration-200" title="แก้ไขข้อมูล">
                                                <i class="fa-solid fa-edit mr-1"></i> แก้ไข
                                            </button>
                                        </td>
                                    </tr>
                                <?php 
                                    endforeach;
                                else:
                                ?>
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-xs text-slate-400 dark:text-slate-500">
                                            ไม่พบข้อมูลในตาราง school_info
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-100/50 dark:bg-slate-950/40 text-slate-500 dark:text-slate-400 border-t border-slate-200 dark:border-white/5 mt-auto py-6 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-500 text-xs">
            <p>&copy; <?php echo date('Y'); ?> <?php echo SCHOOL_NAME_EN; ?>. Admin Portal System.</p>
        </div>
    </footer>

    <!-- MODAL: Create Ticker -->
    <div id="create-ticker-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-slate-900 dark:text-white"><i class="fa-solid fa-plus text-indigo-500 dark:text-indigo-400 mr-1.5"></i>เพิ่มข้อความข่าวด่วนใหม่</h3>
                <button onclick="closeCreateTickerModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/ticker/create" method="POST" class="space-y-4">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ข้อความข่าววิ่ง (จำเป็น)</label>
                    <textarea name="message" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="เช่น ขอเชิญชวนร่วมงานวันสถาปนาโรงเรียนประจำปี 2569 ณ หอประชุมใหญ่..."></textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ลิงก์ภายนอก URL (ไม่บังคับ)</label>
                    <input type="url" name="link_url" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="https://example.com/details">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">สถานะการแสดงผล</label>
                    <select name="is_active" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="1">แสดงผล (Active)</option>
                        <option value="0">ซ่อนไว้ (Inactive)</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeCreateTickerModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Edit Ticker -->
    <div id="edit-ticker-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-slate-900 dark:text-white"><i class="fa-solid fa-edit text-indigo-500 dark:text-indigo-400 mr-1.5"></i>แก้ไขข้อมูลข่าวด่วน</h3>
                <button onclick="closeEditTickerModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/ticker/edit" method="POST" class="space-y-4">
                <input type="hidden" name="id" id="edit-ticker-id">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ข้อความข่าววิ่ง (จำเป็น)</label>
                    <textarea name="message" id="edit-ticker-message" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"></textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ลิงก์ภายนอก URL (ไม่บังคับ)</label>
                    <input type="url" name="link_url" id="edit-ticker-link" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">สถานะการแสดงผล</label>
                    <select name="is_active" id="edit-ticker-is-active" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="1">แสดงผล (Active)</option>
                        <option value="0">ซ่อนไว้ (Inactive)</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeEditTickerModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Create News -->
    <div id="create-news-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-slate-900 dark:text-white"><i class="fa-solid fa-plus text-indigo-500 dark:text-indigo-400 mr-1.5"></i>เพิ่มข่าวสารประชาสัมพันธ์ใหม่</h3>
                <button onclick="closeCreateNewsModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/news/create" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">หัวข้อข่าวสาร</label>
                    <input type="text" name="title" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ประเภทข่าวสาร</label>
                    <select name="category" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="general">ทั่วไป / ประชาสัมพันธ์</option>
                        <option value="activity">ภาพข่าวกิจกรรม</option>
                        <option value="announcement">ประกาศจัดซื้อจัดจ้าง</option>
                        <option value="award">ผลงานและรางวัล (Award)</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 hidden" id="create-news-procurement-fields">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เลขที่เอกสาร (เช่น 12/2569)</label>
                        <input type="text" name="doc_number" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 transition-all" placeholder="เช่น 12/2569">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">งบประมาณ (บาท)</label>
                        <input type="number" name="budget" step="0.01" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 transition-all" placeholder="เช่น 50000">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เนื้อหาข่าวประชาสัมพันธ์</label>
                    <textarea name="content" rows="5" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"></textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">รูปภาพหน้าปกข่าว (ไม่บังคับ)</label>
                    <input type="file" name="cover_image" accept="image/*" class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">รองรับสกุลไฟล์ .jpg, .png, .webp ขนาดสูงสุดไม่เกิน 5MB</p>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ไฟล์เอกสารแนบ PDF (ไม่บังคับ)</label>
                    <input type="file" name="attachment_pdf" accept="application/pdf" class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">รองรับสกุลไฟล์ .pdf ขนาดสูงสุดไม่เกิน 15MB</p>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">วันที่/เวลาเผยแพร่ข่าวสาร (วันลงข่าว)</label>
                    <input type="datetime-local" name="created_at" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">ไม่บังคับ หากไม่ระบุระบบจะใช้วันที่และเวลาปัจจุบัน</p>
                </div>
                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeCreateNewsModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Edit News -->
    <div id="edit-news-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-slate-900 dark:text-white"><i class="fa-solid fa-edit text-indigo-500 dark:text-indigo-400 mr-1.5"></i>แก้ไขข้อมูลข่าวประชาสัมพันธ์</h3>
                <button onclick="closeEditNewsModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/news/edit" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="id" id="edit-news-id">
                
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">หัวข้อข่าวสาร</label>
                    <input type="text" name="title" id="edit-news-title" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ประเภทข่าวสาร</label>
                    <select name="category" id="edit-news-category" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="general">ทั่วไป / ประชาสัมพันธ์</option>
                        <option value="activity">ภาพข่าวกิจกรรม</option>
                        <option value="announcement">ประกาศจัดซื้อจัดจ้าง</option>
                        <option value="award">ผลงานและรางวัล (Award)</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4 hidden" id="edit-news-procurement-fields">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เลขที่เอกสาร (เช่น 12/2569)</label>
                        <input type="text" name="doc_number" id="edit-news-doc-number" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 transition-all" placeholder="เช่น 12/2569">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">งบประมาณ (บาท)</label>
                        <input type="number" name="budget" id="edit-news-budget" step="0.01" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 transition-all" placeholder="เช่น 50000">
                    </div>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เนื้อหาข่าวประชาสัมพันธ์</label>
                    <textarea name="content" id="edit-news-content" rows="5" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"></textarea>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เปลี่ยนรูปภาพหน้าปกข่าว (ไม่บังคับ)</label>
                    <input type="file" name="cover_image" accept="image/*" class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">เลือกไฟล์ใหม่หากต้องการเปลี่ยนรูปหน้าปกเดิม ขนาดสูงสุด 5MB</p>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เปลี่ยนไฟล์เอกสารแนบ PDF (ไม่บังคับ)</label>
                    <input type="file" name="attachment_pdf" accept="application/pdf" class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">เลือกไฟล์ใหม่หากต้องการเปลี่ยนไฟล์เอกสารแนบเดิม ขนาดสูงสุด 15MB</p>
                </div>
                <div class="flex items-center gap-2 py-1 hidden" id="edit-news-clear-pdf-container">
                    <input type="checkbox" name="clear_pdf" value="1" id="edit-news-clear-pdf" class="w-4 h-4 rounded border-slate-300 dark:border-white/10 text-indigo-600 focus:ring-indigo-500">
                    <label for="edit-news-clear-pdf" class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors cursor-pointer" id="edit-news-current-pdf-label">ลบไฟล์เอกสารเดิมออกจากระบบ</label>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">วันที่/เวลาเผยแพร่ข่าวสาร (วันลงข่าว)</label>
                    <input type="datetime-local" name="created_at" id="edit-news-created-at" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeEditNewsModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Edit ITA Item -->
    <div id="edit-ita-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <span class="bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-[10px] font-bold px-2 py-1 border border-indigo-400/20 rounded-md uppercase tracking-wider font-english mr-1.5" id="edit-ita-code-badge">O1</span>
                    <h3 class="text-md font-bold text-slate-900 dark:text-white inline-block">อัปเดตข้อมูลตัวชี้วัด ITA</h3>
                </div>
                <button onclick="closeEditItaModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            
            <form action="<?php echo BASE_URL; ?>admin/ita/update" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="code" id="edit-ita-code">

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ชื่อตัวชี้วัด (สามารถปรับแต่งได้)</label>
                    <input type="text" name="name" id="edit-ita-name" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ลิงก์ URL ข้อมูลภายนอก (ถ้ามี)</label>
                    <input type="url" name="link_url" id="edit-ita-link" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="https://example.com/some-page">
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">อัปโหลดไฟล์เอกสาร (PDF, Word, Excel, Zip)</label>
                    <input type="file" name="ita_file" class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">รองรับไฟล์ขนาดสูงสุดไม่เกิน 15MB</p>
                </div>

                <!-- Delete physical file toggle if exists -->
                <div class="flex items-center gap-2 py-2 hidden" id="clear-file-container">
                    <input type="checkbox" name="clear_file" value="1" id="clear-file-checkbox" class="w-4 h-4 rounded border-slate-300 dark:border-white/10 text-indigo-600 focus:ring-indigo-500">
                    <label for="clear-file-checkbox" class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors cursor-pointer">ต้องการลบไฟล์เอกสารเดิมออกจากระบบ (ใช้เฉพาะการเชื่อมโยงด้วยลิงก์ URL เท่านั้น)</label>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">สถานะการเผยแพร่</label>
                    <select name="status" id="edit-ita-status" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="published">เผยแพร่สาธารณะ (Published)</option>
                        <option value="draft">ฉบับร่างครูแอดมิน (Draft)</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeEditItaModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกตัวชี้วัด</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Create Hero Slide -->
    <div id="create-hero-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-slate-900 dark:text-white"><i class="fa-solid fa-plus text-indigo-500 dark:text-indigo-400 mr-1.5"></i>เพิ่มรูปภาพสไลด์ใหม่</h3>
                <button onclick="closeCreateHeroModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/hero/create" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ชื่ออ้างอิงสไลด์ (ไม่บังคับ)</label>
                    <input type="text" name="title" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all" placeholder="เช่น สไลด์แนะนำวิชาการ">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">รูปภาพสไลด์ (จำเป็น)</label>
                    <input type="file" name="slide_image" accept="image/*" required class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">รองรับสกุลไฟล์ .jpg, .png, .webp ขนาดสูงสุดไม่เกิน 5MB</p>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ลำดับการแสดงผล (ตัวเลข)</label>
                    <input type="number" name="display_order" value="1" min="1" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">สถานะการแสดงผล</label>
                    <select name="status" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="active">แสดงผล (Active)</option>
                        <option value="inactive">ซ่อนไว้ (Inactive)</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeCreateHeroModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Edit Hero Slide -->
    <div id="edit-hero-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-lg rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-md font-bold text-slate-900 dark:text-white"><i class="fa-solid fa-edit text-indigo-500 dark:text-indigo-400 mr-1.5"></i>แก้ไขข้อมูลสไลด์แนะนำ</h3>
                <button onclick="closeEditHeroModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <form action="<?php echo BASE_URL; ?>admin/hero/edit" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="id" id="edit-hero-id">
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ชื่ออ้างอิงสไลด์ (ไม่บังคับ)</label>
                    <input type="text" name="title" id="edit-hero-title" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เปลี่ยนรูปภาพสไลด์ (ไม่บังคับ)</label>
                    <input type="file" name="slide_image" accept="image/*" class="w-full glass-input rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-indigo-500 transition-all">
                    <p class="text-[9px] text-slate-400 dark:text-slate-500 leading-tight">เลือกไฟล์ใหม่หากต้องการเปลี่ยนรูปสไลด์เดิม ขนาดสูงสุด 5MB</p>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">ลำดับการแสดงผล (ตัวเลข)</label>
                    <input type="number" name="display_order" id="edit-hero-order" required class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">สถานะการแสดงผล</label>
                    <select name="status" id="edit-hero-status" class="w-full glass-input rounded-xl px-4 py-3 text-xs focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                        <option value="active">แสดงผล (Active)</option>
                        <option value="inactive">ซ่อนไว้ (Inactive)</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2.5 pt-4">
                    <button type="button" onclick="closeEditHeroModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: Edit About Section -->
    <div id="edit-about-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm opacity-0 pointer-events-none transition-all duration-300">
        <div class="w-full max-w-5xl rounded-3xl shadow-2xl glass-modal p-6 scale-95 transition-transform duration-300">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <span class="bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 text-[10px] font-bold px-2 py-1 border border-indigo-400/20 rounded-md uppercase tracking-wider font-english mr-1.5">ABOUT</span>
                    <h3 class="text-md font-bold text-slate-900 dark:text-white inline-block">แก้ไขข้อมูลแนะนำโรงเรียน: <span id="edit-about-title-display" class="text-indigo-600 dark:text-indigo-400"></span></h3>
                </div>
                <button onclick="closeEditAboutModal()" class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition-colors">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            
            <form action="<?php echo BASE_URL; ?>admin/about/update" method="POST" class="space-y-4">
                <input type="hidden" name="section_key" id="edit-about-key">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เนื้อหาภาษาไทย (รองรับ HTML)</label>
                        <textarea name="content_th" id="edit-about-content-th" rows="14" required class="w-full glass-input rounded-xl px-4 py-3 text-xs font-mono focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"></textarea>
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-semibold text-slate-700 dark:text-slate-300">เนื้อหาภาษาอังกฤษ (รองรับ HTML)</label>
                        <textarea name="content_en" id="edit-about-content-en" rows="14" required class="w-full glass-input rounded-xl px-4 py-3 text-xs font-mono focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all"></textarea>
                    </div>
                </div>

                <div class="p-3 bg-amber-500/10 border border-amber-500/20 rounded-xl text-amber-600 dark:text-amber-300 text-[10px] leading-relaxed flex gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-xs mt-0.5"></i>
                    <span><strong>คำแนะนำ:</strong> ข้อมูลแนะนำนี้เก็บโครงสร้างการแสดงผลด้วยรหัส HTML (เช่น <code>&lt;div class="space-y-6"&gt;</code>, <code>&lt;p&gt;</code>, <code>&lt;h3&gt;</code>) เพื่อรักษาดีไซน์ต้นฉบับ โปรดระมัดระวังในการเปลี่ยนแปลงรหัสเหล่านี้</span>
                </div>

                <div class="flex justify-end gap-2.5 pt-2">
                    <button type="button" onclick="closeEditAboutModal()" class="px-4 py-2.5 hover:bg-slate-100 dark:hover:bg-white/5 border border-slate-300 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-semibold rounded-xl transition-all">ยกเลิก</button>
                    <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-lg transition-all">บันทึกข้อมูลแนะนำโรงเรียน</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modals Script Logic -->
    <script>
        function openModalHelper(id) {
            const modal = document.getElementById(id);
            const modalInner = modal.querySelector('.scale-95');
            modal.classList.remove('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                modalInner.classList.remove('scale-95');
                modalInner.classList.add('scale-100');
            }, 50);
        }

        function closeModalHelper(id) {
            const modal = document.getElementById(id);
            const modalInner = modal.querySelector('.scale-100');
            if (modalInner) {
                modalInner.classList.remove('scale-100');
                modalInner.classList.add('scale-95');
            }
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 150);
        }

        // Create News Modal
        function openCreateNewsModal() {
            // Reset fields
            document.querySelector('#create-news-modal select[name="category"]').value = 'general';
            toggleProcurementFields('create', 'general');
            openModalHelper('create-news-modal');
        }
        function closeCreateNewsModal() {
            closeModalHelper('create-news-modal');
        }

        // Edit News Modal
        function openEditNewsModal(news) {
            document.getElementById('edit-news-id').value = news.id;
            document.getElementById('edit-news-title').value = news.title;
            document.getElementById('edit-news-category').value = news.category;
            document.getElementById('edit-news-content').value = news.content;
            
            // Format custom created_at date for datetime-local (YYYY-MM-DDTHH:MM)
            if (news.created_at) {
                const formattedDate = news.created_at.replace(' ', 'T').substring(0, 16);
                document.getElementById('edit-news-created-at').value = formattedDate;
            } else {
                document.getElementById('edit-news-created-at').value = '';
            }

            // Populate procurement fields
            document.getElementById('edit-news-doc-number').value = news.doc_number || '';
            document.getElementById('edit-news-budget').value = news.budget || '';
            toggleProcurementFields('edit', news.category);

            // PDF clear selection logic
            const clearPdfContainer = document.getElementById('edit-news-clear-pdf-container');
            const clearPdfCheckbox = document.getElementById('edit-news-clear-pdf');
            const currentPdfLabel = document.getElementById('edit-news-current-pdf-label');
            
            clearPdfCheckbox.checked = false;
            if (news.attachment_pdf && news.attachment_pdf.trim() !== '') {
                clearPdfContainer.classList.remove('hidden');
                const filename = news.attachment_pdf.split('/').pop();
                currentPdfLabel.innerHTML = `ลบไฟล์เอกสารแนบเดิม (${filename}) ออกจากระบบ`;
            } else {
                clearPdfContainer.classList.add('hidden');
            }

            openModalHelper('edit-news-modal');
        }
        function closeEditNewsModal() {
            closeModalHelper('edit-news-modal');
        }

        // Edit ITA Modal
        function openEditItaModal(item) {
            document.getElementById('edit-ita-code').value = item.code;
            document.getElementById('edit-ita-code-badge').innerText = item.code;
            document.getElementById('edit-ita-name').value = item.name;
            document.getElementById('edit-ita-link').value = item.link_url || '';
            document.getElementById('edit-ita-status').value = item.status;

            const clearContainer = document.getElementById('clear-file-container');
            const clearCheckbox = document.getElementById('clear-file-checkbox');
            clearCheckbox.checked = false;
            
            if (item.file_path && item.file_path.trim() !== '') {
                clearContainer.classList.remove('hidden');
            } else {
                clearContainer.classList.add('hidden');
            }

            openModalHelper('edit-ita-modal');
        }
        function closeEditItaModal() {
            closeModalHelper('edit-ita-modal');
        }

        // Create Hero Modal
        function openCreateHeroModal() {
            openModalHelper('create-hero-modal');
        }
        function closeCreateHeroModal() {
            closeModalHelper('create-hero-modal');
        }

        // Edit Hero Modal
        function openEditHeroModal(hero) {
            document.getElementById('edit-hero-id').value = hero.id;
            document.getElementById('edit-hero-title').value = hero.title || '';
            document.getElementById('edit-hero-order').value = hero.display_order;
            document.getElementById('edit-hero-status').value = hero.status;
            openModalHelper('edit-hero-modal');
        }
        function closeEditHeroModal() {
            closeModalHelper('edit-hero-modal');
        }

        // Ticker Modal Functions
        function openCreateTickerModal() {
            openModalHelper('create-ticker-modal');
        }
        function closeCreateTickerModal() {
            closeModalHelper('create-ticker-modal');
        }
        function openEditTickerModal(ticker) {
            document.getElementById('edit-ticker-id').value = ticker.id;
            document.getElementById('edit-ticker-message').value = ticker.message;
            document.getElementById('edit-ticker-link').value = ticker.link_url || '';
            document.getElementById('edit-ticker-is-active').value = ticker.is_active;
            openModalHelper('edit-ticker-modal');
        }
        function closeEditTickerModal() {
            closeModalHelper('edit-ticker-modal');
        }

        // About Modal Functions
        function openEditAboutModal(data) {
            const key = data.key;
            const title = data.title;
            
            document.getElementById('edit-about-key').value = key;
            document.getElementById('edit-about-title-display').innerText = title;
            
            const contentTh = document.getElementById('about-content-th-' + key).value;
            const contentEn = document.getElementById('about-content-en-' + key).value;
            
            document.getElementById('edit-about-content-th').value = contentTh;
            document.getElementById('edit-about-content-en').value = contentEn;
            
            openModalHelper('edit-about-modal');
        }
        function closeEditAboutModal() {
            closeModalHelper('edit-about-modal');
        }

        function toggleProcurementFields(prefix, category) {
            const container = document.getElementById(`${prefix}-news-procurement-fields`);
            if (container) {
                if (category === 'announcement') {
                    container.classList.remove('hidden');
                } else {
                    container.classList.add('hidden');
                }
            }
        }

        // Dark/Light Theme Switcher Handler
        const htmlDoc = document.documentElement;

        function toggleDarkMode() {
            const isDarkModeActive = htmlDoc.classList.toggle('dark');
            const targetTheme = isDarkModeActive ? 'dark' : 'light';
            localStorage.setItem('school_theme', targetTheme);
            updateThemeUI(targetTheme);
        }

        function updateThemeUI(theme) {
            const themeIconEl = document.getElementById('theme-icon');
            if (!themeIconEl) return;
            
            if (theme === 'dark') {
                themeIconEl.className = 'fa-solid fa-sun text-yellow-400';
            } else {
                themeIconEl.className = 'fa-solid fa-moon text-slate-600 dark:text-slate-300';
            }
        }

        // Initialize UI settings highlights on DOM load
        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = localStorage.getItem('school_theme') || 'dark';
            updateThemeUI(currentTheme);

            const createCategorySelect = document.querySelector('#create-news-modal select[name="category"]');
            if (createCategorySelect) {
                createCategorySelect.addEventListener('change', function(e) {
                    toggleProcurementFields('create', e.target.value);
                });
            }

            const editCategorySelect = document.getElementById('edit-news-category');
            if (editCategorySelect) {
                editCategorySelect.addEventListener('change', function(e) {
                    toggleProcurementFields('edit', e.target.value);
                });
            }
        });
    </script>
</body>
</html>
