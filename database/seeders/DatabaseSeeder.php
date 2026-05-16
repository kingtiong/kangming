<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Charge;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@kangming.local'],
            [
                'name' => 'Admin',
                'phone' => '+60 11-6769 3193',
                'role' => User::ROLE_ADMIN,
                'password' => 'kangming123',
                'is_active' => true,
            ]
        );

        $drTan = User::updateOrCreate(
            ['email' => 'tanteikee@kangming.local'],
            [
                'name' => 'Prof. Dr. Tan Teik Ee 陳世益',
                'phone' => '+60 11-6769 3193',
                'role' => User::ROLE_TEACHER,
                'notes' => '中醫博士教授 · Professor Doctor of Traditional Chinese Medicine. Lineage holder of Tung\'s Acupuncture (董氏針灸).',
                'password' => 'kangming123',
                'is_active' => true,
            ]
        );

        $teacherChan = User::updateOrCreate(
            ['email' => 'chan@kangming.local'],
            [
                'name' => 'Master Chan',
                'phone' => '+60 12-345 6701',
                'role' => User::ROLE_TEACHER,
                'notes' => 'Senior practitioner — pain management and tuina specialist.',
                'password' => 'kangming123',
                'is_active' => true,
            ]
        );

        $teacherWong = User::updateOrCreate(
            ['email' => 'wong@kangming.local'],
            [
                'name' => 'Dr. Wong',
                'phone' => '+60 12-345 6702',
                'role' => User::ROLE_TEACHER,
                'notes' => 'Tung\'s acupuncture instructor; women\'s health and fertility focus.',
                'password' => 'kangming123',
                'is_active' => true,
            ]
        );

        $kamunting = Branch::updateOrCreate(
            ['code' => 'KMG'],
            [
                'name' => 'Kamunting (HQ)',
                'name_zh_CN' => '甘文丁(总院)',
                'name_zh_TW' => '甘文丁(總院)',
                'address' => 'No. 45, Jalan Medan Saujana 1, Medan Saujana, 34600 Kamunting, Perak',
                'phone' => '+60 11-6769 3193',
                'email' => 'tanteikee@gmail.com',
                'teacher_in_charge_id' => $drTan->id,
                'is_active' => true,
            ]
        );

        $ipoh = Branch::updateOrCreate(
            ['code' => 'IPH'],
            [
                'name' => 'Ipoh',
                'name_zh_CN' => '怡保',
                'name_zh_TW' => '怡保',
                'address' => 'Jalan Sultan Idris Shah, 30000 Ipoh, Perak',
                'phone' => '+60 12-345 6701',
                'email' => 'ipoh@kangming.local',
                'teacher_in_charge_id' => $teacherChan->id,
                'is_active' => true,
            ]
        );

        $pg = Branch::updateOrCreate(
            ['code' => 'PG'],
            [
                'name' => 'Penang',
                'name_zh_CN' => '槟城',
                'name_zh_TW' => '檳城',
                'address' => 'Lebuh Chulia, 10200 George Town, Penang',
                'phone' => '+60 12-345 6702',
                'email' => 'penang@kangming.local',
                'teacher_in_charge_id' => $teacherWong->id,
                'is_active' => true,
            ]
        );

        $services = [
            ['Tung\'s Acupuncture Treatment', '董氏针灸疗程', '董氏針灸療程', 'treatment', 'client', 60, 120.00,
                'The signature Tung\'s system (董氏針灸) — fast-acting, lineage-based acupuncture for pain relief, internal medicine, and chronic conditions.',
                '穅洺招牌的董氏针灸 — 师徒亲传体系,起效迅速,适用于疼痛、内科与慢性病。',
                '穅洺招牌的董氏針灸 — 師徒親傳體系,起效迅速,適用於疼痛、內科與慢性病。'],
            ['General Acupuncture', '一般针灸', '一般針灸', 'treatment', 'client', 45, 90.00,
                'Traditional TCM acupuncture for everyday wellness, stress, sleep, and minor pain.',
                '传统中医针灸,适用于日常调理、压力、睡眠及轻度疼痛。',
                '傳統中醫針灸,適用於日常調理、壓力、睡眠及輕度疼痛。'],
            ['Tuina Therapeutic Massage', '推拿疗法', '推拿療法', 'treatment', 'client', 60, 100.00,
                'Hands-on Chinese medical massage along meridians to release stagnation and restore flow.',
                '依经络施作的中医手法疗法,化解阻滞、恢复气血畅通。',
                '依經絡施作的中醫手法療法,化解阻滯、恢復氣血暢通。'],
            ['Cupping Therapy', '拔罐疗法', '拔罐療法', 'treatment', 'client', 30, 80.00,
                'Traditional fire and silicone cupping for muscle recovery and toxin release.',
                '传统火罐与硅胶拔罐,促进肌肉恢复与排毒。',
                '傳統火罐與矽膠拔罐,促進肌肉恢復與排毒。'],
            ['Medical Aesthetics (醫美)', '医美护理', '醫美護理', 'treatment', 'client', 60, 180.00,
                'Facial acupuncture and aesthetic protocols for natural rejuvenation and skin health.',
                '面部针灸与中医美容方案,自然焕肤、改善肌肤健康。',
                '面部針灸與中醫美容方案,自然煥膚、改善肌膚健康。'],
            ['Beauty Care & Nursing (醫護)', '美容护理', '美容護理', 'treatment', 'client', 60, 150.00,
                'Integrated TCM beauty and post-treatment care by certified practitioners.',
                '由认证医师执行的中医美容与术后护理综合方案。',
                '由認證醫師執行的中醫美容與術後護理綜合方案。'],
            ['Initial Consultation', '初次问诊', '初次問診', 'consultation', 'both', 30, 50.00,
                'Pulse and tongue diagnosis, full case review, and a personalised wellness plan.',
                '把脉、观舌、完整病史复盘,以及量身定制的调理方案。',
                '把脈、觀舌、完整病史複盤,以及量身定制的調理方案。'],
            ['Tung\'s Acupuncture — Foundation Course', '董氏针灸 — 基础课程', '董氏針灸 — 基礎課程', 'class', 'student', 120, 280.00,
                'Step into the Tung\'s lineage. Master the points, channels, and clinical reasoning of董氏針灸 from a transmission holder.',
                '入门董氏门派。由传承人亲授穴位、经络与临床思路。',
                '入門董氏門派。由傳承人親授穴位、經絡與臨床思路。'],
            ['Tung\'s Acupuncture — Advanced Clinic', '董氏针灸 — 进阶临床', '董氏針灸 — 進階臨床', 'class', 'student', 180, 420.00,
                'For practising clinicians. Advanced needling, supervised live cases, and lineage transmission rituals (拜師).',
                '面向执业医师。进阶下针、临床实操督导,及正式拜师礼。',
                '面向執業醫師。進階下針、臨床實操督導,及正式拜師禮。'],
        ];

        foreach ($services as [$name, $nameCN, $nameTW, $cat, $aud, $dur, $price, $desc, $descCN, $descTW]) {
            $svc = Service::updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'name_zh_CN' => $nameCN,
                    'name_zh_TW' => $nameTW,
                    'category' => $cat,
                    'audience' => $aud,
                    'duration_minutes' => $dur,
                    'default_price' => $price,
                    'description' => $desc,
                    'description_zh_CN' => $descCN,
                    'description_zh_TW' => $descTW,
                    'is_active' => true,
                ]
            );

            $audience = $svc->audience === 'both' ? 'both' : ($svc->audience === 'student' ? 'student' : 'client');

            Charge::updateOrCreate(
                ['service_id' => $svc->id, 'label' => 'Single session'],
                [
                    'label_zh_CN' => '单次',
                    'label_zh_TW' => '單次',
                    'audience' => $audience,
                    'amount' => $price,
                    'currency' => 'MYR',
                    'session_count' => 1,
                    'is_active' => true,
                ]
            );

            Charge::updateOrCreate(
                ['service_id' => $svc->id, 'label' => '10-session package'],
                [
                    'label_zh_CN' => '10 次套票',
                    'label_zh_TW' => '10 次套票',
                    'audience' => $audience,
                    'amount' => round($price * 9, 2),
                    'currency' => 'MYR',
                    'session_count' => 10,
                    'is_active' => true,
                    'notes' => 'Save 10% — equivalent of 1 session free',
                ]
            );
        }

        $foundationSvc = Service::where('slug', 'tungs-acupuncture-foundation-course')->first();
        $tungTreatSvc = Service::where('slug', 'tungs-acupuncture-treatment')->first();

        $foundationSection = Section::updateOrCreate(
            ['code' => 'TUNG-FOUND-2026'],
            [
                'name' => 'Tung\'s Acupuncture Foundation — May 2026 Cohort',
                'name_zh_CN' => '董氏针灸基础 — 2026 年 5 月期',
                'name_zh_TW' => '董氏針灸基礎 — 2026 年 5 月期',
                'service_id' => $foundationSvc->id,
                'branch_id' => $kamunting->id,
                'teacher_id' => $drTan->id,
                'audience' => 'student',
                'capacity' => 15,
                'starts_on' => Carbon::today()->addDays(7),
                'ends_on' => Carbon::today()->addMonths(3),
                'status' => 'open',
                'description' => 'Twice-weekly evening classes at the Kamunting HQ — meridians, point location, needling safety, and live case discussion. Concludes with the formal 拜師 transmission ceremony.',
                'description_zh_CN' => '甘文丁总院,每周两晚授课 — 经络、取穴、针刺安全与临床实例讨论,结业时举行正式拜师礼。',
                'description_zh_TW' => '甘文丁總院,每週兩晚授課 — 經絡、取穴、針刺安全與臨床實例討論,結業時舉行正式拜師禮。',
            ]
        );

        $kmgTreatSection = Section::updateOrCreate(
            ['code' => 'TRT-KMG'],
            [
                'name' => 'Kamunting HQ — Daily Treatments',
                'name_zh_CN' => '甘文丁总院 — 每日疗程',
                'name_zh_TW' => '甘文丁總院 — 每日療程',
                'service_id' => $tungTreatSvc->id,
                'branch_id' => $kamunting->id,
                'teacher_id' => $drTan->id,
                'audience' => 'client',
                'capacity' => 1,
                'status' => 'open',
                'description' => 'One-on-one treatment slots with Prof. Dr. Tan Teik Ee at the Kamunting HQ.',
                'description_zh_CN' => '甘文丁总院,陈世益博士教授一对一诊疗时段。',
                'description_zh_TW' => '甘文丁總院,陳世益博士教授一對一診療時段。',
            ]
        );

        $iphTreatSection = Section::updateOrCreate(
            ['code' => 'TRT-IPH'],
            [
                'name' => 'Ipoh — Daily Treatments',
                'name_zh_CN' => '怡保 — 每日疗程',
                'name_zh_TW' => '怡保 — 每日療程',
                'service_id' => $tungTreatSvc->id,
                'branch_id' => $ipoh->id,
                'teacher_id' => $teacherChan->id,
                'audience' => 'client',
                'capacity' => 1,
                'status' => 'open',
            ]
        );

        $pgTreatSection = Section::updateOrCreate(
            ['code' => 'TRT-PG'],
            [
                'name' => 'Penang — Daily Treatments',
                'name_zh_CN' => '槟城 — 每日疗程',
                'name_zh_TW' => '檳城 — 每日療程',
                'service_id' => $tungTreatSvc->id,
                'branch_id' => $pg->id,
                'teacher_id' => $teacherWong->id,
                'audience' => 'client',
                'capacity' => 1,
                'status' => 'open',
            ]
        );

        $start = Carbon::today()->addDays(7)->setHour(19)->setMinute(0);
        for ($i = 0; $i < 8; $i++) {
            $when = (clone $start)->addDays($i * 3);
            Schedule::updateOrCreate(
                ['section_id' => $foundationSection->id, 'starts_at' => $when],
                [
                    'teacher_id' => $drTan->id,
                    'ends_at' => (clone $when)->addHours(2),
                    'room' => 'Studio A',
                    'capacity' => 15,
                    'status' => 'scheduled',
                ]
            );
        }

        foreach ([$kmgTreatSection, $iphTreatSection, $pgTreatSection] as $section) {
            $teacher = $section->teacher_id;
            for ($d = 1; $d <= 7; $d++) {
                foreach ([10, 11, 14, 15, 16] as $hour) {
                    $when = Carbon::today()->addDays($d)->setHour($hour)->setMinute(0);
                    Schedule::updateOrCreate(
                        ['section_id' => $section->id, 'starts_at' => $when],
                        [
                            'teacher_id' => $teacher,
                            'ends_at' => (clone $when)->addMinutes(60),
                            'room' => 'Treatment Room 1',
                            'capacity' => 1,
                            'status' => 'scheduled',
                        ]
                    );
                }
            }
        }

        User::updateOrCreate(
            ['email' => 'student@kangming.local'],
            [
                'name' => 'Sample Student',
                'role' => User::ROLE_STUDENT,
                'branch_id' => $kamunting->id,
                'password' => 'kangming123',
                'is_active' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'client@kangming.local'],
            [
                'name' => 'Sample Client',
                'role' => User::ROLE_CLIENT,
                'branch_id' => $kamunting->id,
                'password' => 'kangming123',
                'is_active' => true,
            ]
        );
    }
}
